<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Excel;
use File;
use App\Models\InterviewQuestionnaire;
use App\Models\InterviewQuestion;
use App\Models\Notice;
class ImportInterviewQuestionnaire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:import-questionnaire {file_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Carga entrevista, se requiere el nombre del archivo';

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
      if($notice){
        $file_name =  $this->argument('file_name');
        $path_file = base_path().'/csv/'.$file_name;
        if(File::exists($path_file)){
          Excel::load($path_file, function($reader)use($notice){
            $results = $reader->get(array('questions',
                                          'title','description','type',
                                          'required','min_label','max_label',
                                          'options_columns_number','options_rows_number'));
              if($results->first()->title && $results->first()->description){
                $questionnaire  = InterviewQuestionnaire::firstOrCreate([
                   'notice_id'  => $notice->id,
                   'title'      => $results->first()->title,
                   'description'=> $results->first()->description,
                   ]);
                foreach($results as $result){
                   $question = new InterviewQuestion([
                      'interview_questionnaire_id' => $questionnaire->id,
                      'question'                   => $result->questions,
                      'type'                       => $result->type,
                      'required'                   => $result->required,
                      'min_label'                  => $result->min_label,
                      'max_label'                  => $result->max_label,
                      'options_columns_number'     => $result->options_columns_number,
                      'options_rows_number'        => $result->options_rows_number,
                    ]);
                    $question->save();
                }
                $this->info('Saved');
              }
          })->first();

        }else{
          $this->info("Files does not exists");
        }

      }else{
        $this->info("No data");
      }
    }
}
