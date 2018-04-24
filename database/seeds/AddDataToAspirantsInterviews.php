<?php

use Illuminate\Database\Seeder;
use App\Models\Aspirant;
use App\Models\AspirantEvaluation;
use App\Models\Interview;
use App\Models\Notice;
use App\User;
class AddDataToAspirantsInterviews extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //desde cmd
        $notices  = Notice::orderBy('start','asc')->get();
        $message  = '';
        $count    = 1;
        $arr      = [];
        foreach ($notices as $notice) {
          $message = $message.' '.$count.'-'.$notice->title."\n";
          $arr[$count] = $notice->id;
          $count++;
        }
        $notice_id = $this->command->ask('Which notice? '."\n".$message);
        if((int)$notice_id > sizeof($arr) || !(int)$notice_id){
          return $this->command->warn('Selecciona un valor válido' );
        }

        $notice_id  = $arr[$notice_id];
        $notice = Notice::where('id',$notice_id)->first();
        if($notice){
          /**********************************************************************/
          // Variables de control, asignación por consenso de instituciones.
          // Se carga a través de archivo csv
          /**********************************************************************/
          $path =  base_path().'/csv/control_variables.csv';
          $file = fopen($path, "r");
          $institutions_face_max = [];
          $institutions_audio_max = [];
          while ( ($data = fgetcsv($file, 1000, ";")) !==FALSE )
             {
                  $institutions_face_max[$data[0]]  = $data[1];
                  $institutions_audio_max[$data[0]] = $data[2];
             }
           fclose($file);

           /**********************************************************************/
           // Aspirantes seleccionados por consenso de instituciones.
           // Se carga a través de archivo csv
           /**********************************************************************/
           $path =  base_path().'/csv/selected.csv';
           $file = fopen($path, "r");
           $emails = [];
           while ( ($data = fgetcsv($file, 2000, ",")) !==FALSE )
              {
                   $email = $data[0];
                   array_push($emails, $email);
              }
            fclose($file);

           if(sizeof($emails)>0 && sizeof($institutions_face_max)>0 && sizeof($institutions_audio_max)>0){
             $aspirants = Aspirant::where('is_activated',1)->whereIn('email',$emails)->get();
             $users_in  = User::select('institution')->where('type','admin')->where('enabled',1)->distinct('institution')->orderBy('institution','asc')->get();
             $max_number_to_assing = $aspirants->count()*2;
             $institutions_t = $users_in->pluck('institution')->toArray();
             $aspirants_id   = $aspirants->pluck('id')->toArray();
             $rejected = [];
             $start = true;
             $i = 0;
             while($start){
               Interview::where('notice_id',$notice->id)->delete();
               //ordena aleatoriamente a los aspirantes
               shuffle($aspirants_id);
               $rejected  = [];
               foreach ($aspirants_id as $aspirant_id) {
                  if(!$this->save_in($aspirant_id,$institutions_face_max,$institutions_audio_max,$institutions_t,$notice)){
                    $rejected[] = $aspirant_id;
                  }
               }
               if(sizeof($rejected)== 0 ){
                 $start = false;
               }
               $this->command->info('Attempt: '.$i);
               $this->command->info('Unassigned: '.sizeof($rejected));
               $this->command->info('Total attempt assigned: '. Interview::where('notice_id',$notice->id)->count());
               $i++;
              }

             //debug on server delete after first notice
             $this->command->info('----------------------------------------------------------------------------------------');
             $this->command->info('Total number of aspirants to assign: '.sizeof($aspirants_id));
             $this->command->info('Max number to assign: '.$max_number_to_assing);
             $total = 0;
             foreach ($institutions_t as $institution) {
               $count   = Interview::where('institution',$institution)->where('notice_id',$notice->id)->where('type','face')->count();
               $count_2 = Interview::where('institution',$institution)->where('notice_id',$notice->id)->where('type','audio')->count();
               $this->command->info('Institution: '.$institution.' assigned: '.$count.' Audios: '.$count_2);
               $total = $total +$count;
             }

             $this->command->info('Total assigned: '. Interview::where('notice_id',$notice->id)->count());
             $this->command->info('Total to assign: '.sizeof($aspirants_id)*2);

           }else{
             $this->command->info("No data");
           }

         }else{
           $this->command->info("No data");
         }

    }

    function min_in($institutions, $notice){
      if(sizeof($institutions)>0){
        $institutions = array_values($institutions);
        $temp = [];
        $count = 0;
        for ($k=0; $k < sizeof($institutions) ; $k++) {
          $temp[$institutions[$k]] =  Interview::where('type','face')->where('institution',$institutions[$k])->where('notice_id',$notice->id)->count();
        }
       }
       $key = array_keys($temp, min($temp));
       if($key){
         return $key[0];
       }else{
         return false;
       }
    }

    function min_au($institutions, $notice){
      if(sizeof($institutions)>0){
        $institutions = array_values($institutions);
        $temp = [];
        $count = 0;
        for ($k=0; $k < sizeof($institutions) ; $k++) {
          $temp[$institutions[$k]] =  Interview::where('type','audio')->where('institution',$institutions[$k])->where('notice_id',$notice->id)->count();
        }
       }
       $key = array_keys($temp, min($temp));
       if($key){
         return $key[0];
       }else{
         return false;
       }
    }

  function save_in($aspirant_id,$institutions_face_max,$institutions_audio_max,$institutions_t,$notice){
      $ev_inst = AspirantEvaluation::select('institution')->where('aspirant_id',$aspirant_id)
                                        ->where('notice_id',$notice->id)
                                        ->whereNotNull('grade')
                                        ->distinct('institution')
                                        ->orderBy('institution','asc')
                                        ->pluck('institution')
                                        ->toArray();
      if(sizeof($ev_inst)>0){
          $institutions = array_diff($institutions_t,$ev_inst);
           while(sizeof($institutions)>0){
             $key  = $this->min_in($institutions, $notice);
             if(Interview::where('type','face')->where('institution',$key)->where('notice_id',$notice->id)->count() < intval($institutions_face_max["$key"])){
                Interview::firstOrCreate(['aspirant_id'=>$aspirant_id,'notice_id'=>$notice->id,'type'=>'face','institution'=>$key]);
                if (($key_t = array_search($key, $institutions)) !== false) {
                    unset($institutions[$key_t]);
                }
                $institutions = array_values($institutions);
                if(Interview::where('type','audio')->where('institution',$institutions[0])->where('notice_id',$notice->id)->count() < intval($institutions_audio_max["$institutions[0]"])){
                  Interview::firstOrCreate(['aspirant_id'=>$aspirant_id,'notice_id'=>$notice->id,'type'=>'audio','institution'=>$institutions[0]]);
                  return true;
                }else{
                  return false;
                }
             }elseif(Interview::where('type','audio')->where('institution',$key)->where('notice_id',$notice->id)->count() < intval($institutions_audio_max["$key"])){
               Interview::firstOrCreate(['aspirant_id'=>$aspirant_id,'notice_id'=>$notice->id,'type'=>'audio','institution'=>$key]);
               if (($key_t = array_search($key, $institutions)) !== false) {
                   unset($institutions[$key_t]);
               }
               $institutions = array_values($institutions);
               if(Interview::where('type','face')->where('institution',$institutions[0])->where('notice_id',$notice->id)->count() < intval($institutions_face_max["$institutions[0]"])){
                 Interview::firstOrCreate(['aspirant_id'=>$aspirant_id,'notice_id'=>$notice->id,'type'=>'face','institution'=>$institutions[0]]);
                 return true;
               }else{
                 return false;
               }

             }else{
               return false;
             }
           }


      }else{
        return false;
      }

      return false;
  }




}
