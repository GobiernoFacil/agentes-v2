<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notice;
use App\Models\Aspirant;
use App\Models\AspirantInstitution;
use Carbon\Carbon;
use App\User;
class AssignAspirants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:assign-aspirant-to {type} {notice_id=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Asigna aspirantes a las instituciones para su evaluación';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $today  = Carbon::now();
        if($this->argument('type') == 0){
          //automatico
          $daysAgo = $today->subDays(3)->format('Y-m-d');
          $notice = Notice::where('end',$daysAgo)->where('public',1)->first();
        }elseif($this->argument('type') == 1){
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
          $notice_id = $this->ask('Which notice? '."\n".$message);
          if((int)$notice_id > sizeof($arr) || !(int)$notice_id){
            return $this->warn('Selecciona un valor válido' );
          }

          $notice_id  = $arr[$notice_id];
          $notice = Notice::where('id',$notice_id)->first();

        }elseif($this->argument('type') == 2){
          //llamada desde código
          $notice = Notice::where('id',$this->argument('notice_id'))->first();
        }else{
          //none
          $notice = false;
        }
        if($notice){
          $aspirants = $notice->aspirants_approved_proof()->get();
          $users_in  = User::select('institution')->where('type','admin')->where('enabled',1)->distinct('institution')->orderBy('institution','asc')->get();
          AspirantInstitution::where('notice_id',$notice->id)->delete();
          if($aspirants->count()>0 && $users_in->count()>0){
            $max_number_to_assing = ceil(($aspirants->count()*3)/$users_in->count());
            $institutions_t = $users_in->pluck('institution')->toArray();
            $aspirants_id   = $aspirants->pluck('id')->toArray();
            //ordena aleatoriamente a los aspirantes
            shuffle($aspirants_id);
            for ($i=0; $i < sizeof($aspirants_id); $i++) {
                    $control = 0;
                    //just in case
                    $max_number_of_iterations = 0;
                    $institutions = $institutions_t;
                    while($control < 3){
                      if(sizeof($institutions) == 0){
                        break;
                      }
                      $key  = $this->average($institutions,$notice);
                      if($key){
                          $check = AspirantInstitution::where('institution',$key)->where('aspirant_id',$aspirants_id[$i])->where('notice_id',$notice->id)->first();
                          $count =  AspirantInstitution::where('institution',$key)->where('notice_id',$notice->id)->count();
                          if(!$check && $count < $max_number_to_assing){
                            AspirantInstitution::firstOrCreate(['aspirant_id'=>$aspirants_id[$i],'notice_id'=>$notice->id,'institution'=>$key]);
                            if (($key_t = array_search($key, $institutions)) !== false) {
                                unset($institutions[$key_t]);
                            }
                            $control++;
                          }else{
                            if (($key_t = array_search($key, $institutions)) !== false) {
                                unset($institutions[$key_t]);
                            }
                          }
                      }else{
                        break;
                      }

                      if($max_number_of_iterations == ($max_number_to_assing*($aspirants->count()))){
                        break;
                      }
                      $max_number_of_iterations++;
                    }
              }


            //debug on server delete after first notice
            $this->info('Total number of aspirants to assign: '.$aspirants->count());
            $this->info('Max number to assign: '.$max_number_to_assing);
            $total = 0;
            foreach ($institutions_t as $institution) {
              $count = AspirantInstitution::where('institution',$institution)->where('notice_id',$notice->id)->count();
              $this->info('Institution: '.$institution.' assigned: '.$count);
              $total = $total +$count;
            }

            $this->info('Total assigned: '. AspirantInstitution::where('notice_id',$notice->id)->count());
            $this->info('Total to assign: '.$aspirants->count()*3);

          }
        }

    }

    function average($institutions, $notice){
      if(sizeof($institutions)>0){
        $institutions = array_values($institutions);
        $temp = [];
        $count = 0;
        for ($k=0; $k < sizeof($institutions) ; $k++) {
          $temp[$institutions[$k]] =  AspirantInstitution::where('institution',$institutions[$k])->where('notice_id',$notice->id)->count();
        }
       }
       $key = array_keys($temp, min($temp));
       if($key){
         return $key[0];
       }else{
         return false;
       }
    }
}
