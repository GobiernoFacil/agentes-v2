<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\FacilitatorSurvey;
class CreateCsvFacilitators implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $survey_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($survey_id)
    {
        //
        $this->survey_id = $survey_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //crea csv por pregunta para graficar
        $survey = FacilitatorSurvey::where('id',$this->survey_id)->first();
        if($survey){
          $survey->store_answers_survey_sessions($survey->session->id,$survey->facilitator->id,$survey->session->module->id);
        }

    }
}
