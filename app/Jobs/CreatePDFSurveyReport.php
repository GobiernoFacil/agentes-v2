<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;;
use App\Models\FellowSurvey;
use PDF;
class CreatePDFSurveyReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        $all             = FellowSurvey::orderBy('created_at','desc')->get();
        $name            = 'encuesta_satisfaccion.pdf';
        $path            = base_path().'/csv/reports/'.$name;
        $pdf             = PDF::loadView('admin.indicators.pdf.fellow-survey-template', compact(['all']))->setPaper('a4', 'landscape')->save($path);
    }
}
