<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Excel;
use PDF;
use App\Models\CustomQuestionnaire;
class CreateDiagnosticFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-diagnostic-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea archivos de descarga de cuestionario diagnóstico';

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
        $questionnaires  = CustomQuestionnaire::orderBy('created_at','desc')->get();
        $path            = base_path().'/csv/reports';
        $headers = ["Pregunta","Comentarios"];
        foreach ($questionnaires as $questionnaire) {
          Excel::create("cuestionario_diagnostico_".$questionnaire->id, function($excel)use($questionnaire,$headers) {
            // Set the title
            $excel->setTitle('Respuestas de diagnóstico');
            // Chain the setters
            $excel->setCreator('Gobierno Fácil')
                  ->setCompany('Gobierno Fácil');
            // Call them separately
            $excel->setDescription('Respuestas de diagnóstico'.$questionnaire->id);
            $excel->sheet('Respuestas', function($sheet)use($questionnaire,$headers){
              $sheet->setTitle('Respuestas');
              $sheet->row(1, ["Respuestas de cuestionario",$questionnaire->title]);
              $sheet->row(2, $headers);
              $sheet->row(1, function($row) {
                $row->setBackground('#000000');
                $row->setFontColor('#ffffff');
              });
              $sheet->row(2, function($row) {
                $row->setBackground('#000000');
                $row->setFontColor('#ffffff');
              });
              foreach ($questionnaire->questions as $question) {
                $values[]=$question->question;
                $sheet->appendRow($values);
                foreach ($question->answers_fellows as $s) {
                  $sheet->appendRow([" ",$s->answer]);
                }
                $values = [];
              }
            });
           })->store('xlsx',$path);
           $name            = 'cuestionario_diagnostico_'.$questionnaire->id.'.pdf';
           $path            = base_path().'/csv/reports/'.$name;
           $pdf             = PDF::loadView('facilitator.diagnostic.pdf.template', compact(['questionnaire']))->setPaper('a4', 'landscape')->save($path);
        }
        $this->info("Done");

    }
}
