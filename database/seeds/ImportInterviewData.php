<?php

use Illuminate\Database\Seeder;
use App\Models\Aspirant;
use App\Models\Interview;
use App\Models\Notice;
class ImportInterviewData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
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
          $file_name =  'inter_data.xlsx';
          $path_file = base_path().'/csv/'.$file_name;
          if(File::exists($path_file)){
                Interview::where('notice_id',$notice->id)->delete();
                Excel::load($path_file, function($reader)use($notice){
                  $results = $reader->get(array('emails','face','audio'));
                  foreach($results as $result){
                    if($aspirant = Aspirant::where('is_activated',1)->where('email',$result->emails)->first()){
                      $face      = $this->get_institution_name($result->face);
                      $audio     = $this->get_institution_name($result->audio);
                      Interview::firstOrCreate([
                        'aspirant_id' => $aspirant->id,
                        'notice_id'   => $notice->id,
                        'type'        => 'face',
                        'institution' => $face
                      ]);
                      Interview::firstOrCreate([
                        'aspirant_id' => $aspirant->id,
                        'notice_id'   => $notice->id,
                        'type'        => 'audio',
                        'institution' => $audio
                      ]);
                    }
                   }
                   $this->command->info(Interview::where('notice_id',$notice->id)->count().' saved ');
                })->first();

            }else{
              $this->info("Files does not exists");
            }

          }else{
            $this->info("No data");
          }
    }


    function get_institution_name($name){
      switch ($name) {
        case 'GF':
            $name = 'Gobierno Fácil';
            return $name;
        break;
        case 'GESOC':
            $name = 'Gestión Social Y Cooperación';
            return $name;
        break;
        case 'INAI':
            $name = 'Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales';
            return $name;
        break;
        case 'PNUD':
            $name = 'Programa de las Naciones Unidas para el Desarrollo';
            return $name;
        break;
        case 'PRO':
            $name = 'PROSOCIEDAD';
            return $name;
        break;

        default:
          // code...
        break;

        return $name;
      }

    }
}
