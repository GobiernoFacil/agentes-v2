<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Excel;
use File;
use App\Models\CustomQuestion;
use App\Models\CustomQuestionnaire;
use App\Models\Customanswer;
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
    protected $description = 'Command description';

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
            $results = $reader->get(array('questions', 'title','description'));
            if($results->first()->title && $results->first()->description){
              $slug  = str_slug($results->first()->title);
              $check = CustomQuestionnaire::where('slug',$slug)->first();
              if(!$check){
                  $questionnaire  = new CustomQuestionnaire(['user_id'=>$user->id,'title'=>$results->first()->title,'description'=>$results->first()->description,'slug'=>$slug]);
                  $questionnaire->save();
                  foreach($results as $result){
                    $question = new CustomQuestion(['questionnaire_id'=>$questionnaire->id,'question'=>$result->questions,'type'=>'open']);
                    $question->save();
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
          $this->info('No csv file');
        }
    }
}
