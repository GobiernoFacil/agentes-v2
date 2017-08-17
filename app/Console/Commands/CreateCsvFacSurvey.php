<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FacilitatorSurvey;
use App\Models\ModuleSession;
use App\Models\Module;
class CreateCsvFacSurvey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-csv-fac-survey';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea csv de los resultados de las encuestas para los facilitadores por sesión del modulo 1';

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
        $module = Module::where('title','CURSO 1 - Gobierno Abierto y los ODS')->first();
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

    }
}
