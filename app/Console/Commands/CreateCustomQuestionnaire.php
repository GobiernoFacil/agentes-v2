<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Excel;
use File;
use App\Models\CustomQuestion;
use App\Models\CustomQuestionnaire;
use App\Models\CustomAnswer;
use App\User;
class CreateCustomQuestionnaire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-questionnaire {file_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Carga un cuestionario, se requiere el nombre del archivo';

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
        $file_name =  $this->argument('file_name');
        $path_file = base_path().'/csv_2/'.$file_name;
        $user      =  User::where('institution','Gobierno Fácil')->where('enabled',1)->first();
        if(File::exists($path_file) && $user){
          Excel::load($path_file, function($reader)use($user){
            $results = $reader->get(array('questions', 'title','description','type',
            'observations','required','min_label','max_label','options_columns_number','options_rows_number','answer','value','order'));
            if($results->first()->title && $results->first()->description){
              $slug  = str_slug($results->first()->title);
              $check = CustomQuestionnaire::where('slug',$slug)->first();
              if(!$check){
                  $questionnaire  = new CustomQuestionnaire(
                    ['user_id'=>$user->id,
                     'title'=>$results->first()->title,
                     'description'=>$results->first()->description,
                     'slug'=>$slug
                     ]);
                  $questionnaire->save();
                  foreach($results as $result){
                     $question = new CustomQuestion(
                       ['questionnaire_id'=>$questionnaire->id,
                        'question'=>$result->questions,
                        'type'=>$result->type,
                        'observations'=>$result->observations,
                        'required'=>$result->required,
                        'min_label'=>$result->min_label,
                        'max_label'=>$result->max_label,
                        'options_columns_number'=>$result->options_columns_number,
                        'options_rows_number'=>$result->options_rows_number,
                      ]);
                    $question->save();
                    //agrega opciones multiple filas y columnas (table)
                    if($result->options_rows_number>1){
                      $answers = explode(',', $result->answer);
                      $count  = 1;
                      foreach ($answers as $answer) {
                            $this->info($answer);
                            $saveAnswer = new CustomAnswer(
                              ['question_id'=>$question->id,
                               'answer'=>$answer,
                               'value'=>$count,
                               'order'=>$count,
                             ]);
                            $count++;
                            $saveAnswer->save();
                      }
                    }
                  }
                  $this->info('Saved');
              }else{
                $this->info('Title already exists, change it');
              }
            }else{
              $this->info('No title or description provided');
            }

          })->first();
        }else{
          $this->info('No xlsx file');
        }
    }
}
