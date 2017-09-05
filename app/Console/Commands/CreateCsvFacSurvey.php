<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FacilitatorSurvey;
use App\Models\ModuleSession;
use App\Models\Module;
use Excel;
class CreateCsvFacSurvey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-csv-fac-survey {mode}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea csv de los resultados de las encuestas para los facilitadores por sesión del modulo 1, se selecciona 1 para xlsx de estadistica por pregunta (para graficar) y 2 para generar xlsx de todas las respuestas';

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
        $option = $this->argument('mode');
        $module = Module::where('title','CURSO 1 - Gobierno Abierto y los ODS')->first();
        if($option==1){
            if($module){
              foreach ($module->sessions as $session) {
                $this->info('Sesion: '.$session->name);
                  foreach ($session->facilitators as $facilitator) {
                        $survey = FacilitatorSurvey::where('session_id',$session->id)->where('facilitator_id',$facilitator->user->id)->first();
                        if($survey){
                          $survey->store_answers_survey_sessions($session->id,$facilitator->user->id,$module->id);
                          $this->info('Facilitador: '.$facilitator->user->name." done");
                        }
                  }
              }
            }
       }elseif($option==2){
         $path = base_path().'/csv/survey_fac_answers';
         $index   = ['fa_1','fa_2','fa_3','fa_4','fa_5','fa_6', 'fa_9'];
         $q_ind   = ['fa_7','fa_8'];
         $options = ['0','1','2','3','4','5','6','7','8','9','10'];
         $headers = ["Pregunta","0","1","2","3","4","5","6","7","8","9","10"];
         $this->info("Survey's answers");
         if($module){
           foreach ($module->sessions as $session) {
             $this->info('Sesion: '.$session->name);
               foreach ($session->facilitators as $facilitator) {
                     $survey = FacilitatorSurvey::where('session_id',$session->id)->where('facilitator_id',$facilitator->user->id)->first();
                     if($survey){
                       Excel::create("mo_".$module->id."_sess_".$session->id."_fac_".$facilitator->id, function($excel)use($facilitator,$options,$headers,$session,$survey,$index,$q_ind) {
                         // Set the title
                         $excel->setTitle('Resultados de encuesta');
                         // Chain the setters
                         $excel->setCreator('Gobierno Fácil')
                               ->setCompany('Gobierno Fácil');
                         // Call them separately
                         $excel->setDescription('Resultado facilitador '.$facilitator->id.'_'.$session->id);
                         $excel->sheet('Resultados', function($sheet)use($options,$headers,$facilitator,$session,$survey,$index){
                           $sheet->setTitle('Respuestas');
                           $sheet->row(1, ["Respuestas de encuesta","Sesión ".$session->name]);
                           $sheet->row(2, ["Facilitador",$facilitator->user->name]);
                           $sheet->row(3, $headers);
                           $sheet->row(1, function($row) {
                             $row->setBackground('#000000');
                             $row->setFontColor('#ffffff');
                           });
                           $sheet->row(2, function($row) {
                             $row->setBackground('#000000');
                             $row->setFontColor('#ffffff');
                           });
                           $sheet->row(3, function($row) {
                             $row->setBackground('#000000');
                             $row->setFontColor('#ffffff');
                           });
                           foreach ($index as $i) {
                             $question = substr($i, -1, 1);
                             $values = [];
                             $values[]='Pregunta '.$question;
                             foreach ($options as $option) {
                               $count = FacilitatorSurvey::where($i,$option)->where('session_id',$session->id)->where('facilitator_id',$facilitator->user->id)->count();
                               $values[]=$count;
                             }
                             $sheet->appendRow($values);
                           }
                         });
                         $excel->sheet('Comentarios', function($sheet)use($options,$headers,$facilitator,$session,$survey,$q_ind){
                           $sheet->setTitle('Comentarios');
                           $sheet->row(1, ["Comentarios de encuesta","Sesión ".$session->name]);
                           $sheet->row(2, ["Facilitador",$facilitator->user->name]);
                           $sheet->row(1, function($row) {
                             $row->setBackground('#000000');
                             $row->setFontColor('#ffffff');
                           });
                           $sheet->row(2, function($row) {
                             $row->setBackground('#000000');
                             $row->setFontColor('#ffffff');
                           });
                           foreach ($q_ind as $i) {
                             $question = substr($i, -1, 1);
                             $values = [];
                             $values[]='Pregunta '.$question;
                             $sheet->appendRow($values);
                             $surveys = FacilitatorSurvey::where($i,'!=',null)->where('session_id',$session->id)->where('facilitator_id',$facilitator->user->id)->get();
                             foreach ($surveys as $s) {
                               $sheet->appendRow([" ",$s->{$i}]);
                             }
                           }
                         });
                       })->store('xlsx',$path);

                       $this->info('Facilitador: '.$facilitator->user->name." done");
                     }
               }
           }
         }
       }
    }
}
