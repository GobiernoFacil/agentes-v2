<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use App\Models\FellowSurvey;
use App\Jobs\CreateCsvFacilitators;
use Excel;
class CreateCsvFellowsSurvey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-csv-fellow-survey {mode}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Guarda csv con los resultados de las encuestas, se selecciona 1 para xlsx de estadistica por pregunta (para graficar) y 2 para generar xlsx de todas las respuestas';

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
        $surveys = FellowSurvey::orderBy('created_at')->first();
        if($option==1){
          if($surveys){
              $surveys->store_answers_survey($surveys);
             $this->info("All done");
            }
        }elseif($option==2){
            $this->info("All answers");
            $path = base_path().'/csv/survey_fellow_answers';
            $index = [
                          'sur_1',
                          'sur_2',
                          'sur_3_1',
                          'sur_3_2',
                          'sur_3_3',
                          'sur_3_4',
                          'sur_3_5',
                          'sur_4',
                          'sur_5_1',
                          'sur_5_2',
                          'sur_5_3',
                          'sur_5_4',
                          'sur_6_1',
                          'sur_6_2',
                          'sur_6_3',
                          'sur_7_1',
                          'sur_7_2',
                          'sur_7_3',
                          'sur_8',
                          'sur_9',
                          'sur_10',
                          'sur_11',
                          'sur_13_1',
                          'sur_13_2',
                          'sur_13_3',
                          'sur_13_4',
                          'sur_14_1',
                          'sur_14_2',
                          'sur_14_3',
                          'sur_14_4',
                          'sur_15_1',
                          'sur_15_2',
                          'sur_15_3',
                          'sur_15_4',
                          'sur_16_1',
                          'sur_16_2',
                          'sur_16_3',
                          'sur_16_4',
                        ];
              $q_ind   = ['sur_j1','sur_j2','sur_j8','sur_j9','sur_j10','sur_j12'];
              $options = ['0','1','2','3','4','5','6','7','8','9','10'];
              $headers = ["Pregunta","0","1","2","3","4","5","6","7","8","9","10"];
              if($surveys->count()>0){
                Excel::create("satisfaction_survey", function($excel)use($options,$headers,$surveys,$index,$q_ind) {
                  // Set the title
                  $excel->setTitle('Resultados de encuesta de satisfaccion');
                  // Chain the setters
                  $excel->setCreator('Gobierno Fácil')
                        ->setCompany('Gobierno Fácil');
                  // Call them separately
                  $excel->setDescription('Resultado de encuesta de satisfaccion');
                  $excel->sheet('Resultados', function($sheet)use($options,$headers,$surveys,$index){
                    $sheet->setTitle('Respuestas');
                    $sheet->row(1, ["Respuestas de encuesta de satisfacción"]);
                    $sheet->row(2, $headers);
                    $sheet->row(1, function($row) {
                      $row->setBackground('#000000');
                      $row->setFontColor('#ffffff');
                    });
                    $sheet->row(2, function($row) {
                      $row->setBackground('#000000');
                      $row->setFontColor('#ffffff');
                    });
                    foreach ($index as $i) {
                      if(strlen($i)>6){
                        $display = explode('_', $i);
                        $question = $display[1].'_'.$display[2];
                      }else{
                        $display  = explode('_', $i);
                        $question = $display[1];
                        //$question = substr($i, -1, 1);
                      }
                      $values = [];
                      $values[]='Pregunta '.$question;
                      foreach ($options as $option) {
                        $count = FellowSurvey::where($i,$option)->count();
                        $values[]=$count;
                      }
                      $sheet->appendRow($values);
                    }
                  });

                  $excel->sheet('Comentarios', function($sheet)use($options,$headers,$surveys,$q_ind){
                    $sheet->setTitle('Comentarios');
                    $sheet->row(1, ["Comentarios de encuesta de satisfacción"]);
                    $sheet->row(1, function($row) {
                      $row->setBackground('#000000');
                      $row->setFontColor('#ffffff');
                    });
                    foreach ($q_ind as $i) {
                        $display  = explode('_j', $i);
                        $question = $display[1];
                        //$question = substr($i, -1, 1);

                      $values = [];
                      $values[]='Pregunta '.$question;
                      $sheet->appendRow($values);
                      $surveys = FellowSurvey::where($i,'!=',null)->get();
                      foreach ($surveys as $s) {
                        $sheet->appendRow([" ",$s->{$i}]);
                      }
                    }
                  });
                  })->store('xlsx',$path);
              }
        }


    }
}
