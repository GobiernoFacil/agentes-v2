<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use Excel;
use App\Models\Aspirant;
use App\Models\AspirantEvaluation;
use App\Models\AspirantInterview;
use App\Models\Notice;
class ExportAspirantsResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:export-aspirants-results {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea excel con resultados de evaluaciones por estado, 0 para evaluaciones, 1 para entrevistas';

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
          $aspirants_id = $notice->aspirants()->pluck('aspirant_id');
          $states       = Aspirant::select('state')->whereIn('id',$aspirants_id->toArray())->distinct()->orderBy('state','asc')->get();
          $type         = $this->argument('type');
          if(!$type){
            $name = 'aspirants_results';
            $headers      = ["Nombre","Apellidos","Correo","Estado","Ciudad","Género","Sector","No. evaluaciones","","","Instituciones","","","Calificación Global"];

          }else{
            $name = 'aspirants_interview_results';
            $headers      = ["Nombre","Apellidos","Correo","Estado","Ciudad","Género","Sector","No. evaluaciones","","","Instituciones","","", "Calificación entrevista","Primera calificación","Calificación Global"];
          }
          $headers_2    = ["","","","","","","","","GESOC","GF","INAI","PNUD","PROSOCIEDAD"," "];
          $institutions = ["Gestión Social Y Cooperación","Gobierno Fácil","Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales","Programa de las Naciones Unidas para el Desarrollo","PROSOCIEDAD"];
          Excel::create($name, function($excel)use($headers,$notice,$states,$institutions,$headers_2,$type) {
            // Set the title
            $excel->setTitle('Resultado de aspirantes - concocatoria "'.$notice->title.'"');
            // Chain the setters
            $excel->setCreator('Gobierno Fácil')
                  ->setCompany('Gobierno Fácil');
            // Call them separately
            $excel->setDescription('Resultado de las evaluaciones para los aspirantes de la convocatoria "'.$notice->title.'" general y por estado');
            $excel->sheet('General', function($sheet)use($notice,$headers,$headers_2,$institutions,$type){
              $sheet->row(1, $headers);
              $sheet->row(1, function($row) {
                $row->setBackground('#000000');
                $row->setFontColor('#ffffff');
              });
              $sheet->row(2, $headers_2);
              $sheet->row(2, function($row) {
                $row->setBackground('#000000');
                $row->setFontColor('#ffffff');
              });
              if(!$type){
                $aspirants = $notice->aspirants_app_already_evaluated()->get();
              }else{
                $aspirants = $notice->aspirants_inter_already_evaluated()->get();
              }

              $temOrder = [];

              foreach ($aspirants as $aspirant) {
                $temOrder[$aspirant->id] = number_format((($aspirant->global_grade->grade + $aspirant->global_interview_grade->score)/2),2);
              }
              arsort($temOrder);

              foreach ($temOrder as $key => $value) {
                $aspirant = Aspirant::find($key);
                if(!$type){
                  $arr = [$aspirant->name,
                          $aspirant->surname.' '.$aspirant->lastname,
                          $aspirant->email,
                          $aspirant->state,
                          $aspirant->city,
                          $aspirant->gender=== 'female' ? "Femenino" : "Masculino",
                          $aspirant->origin,
                          AspirantEvaluation::where('aspirant_id',$aspirant->id)->whereNotNull('grade')->count(),
                          AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[0])->whereNotNull('grade')->first() ?   number_format(AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[0])->whereNotNull('grade')->first()->grade,2) : " ",
                          AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[1])->whereNotNull('grade')->first() ?   number_format(AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[1])->whereNotNull('grade')->first()->grade,2) : " ",
                          AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[2])->whereNotNull('grade')->first() ?   number_format(AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[2])->whereNotNull('grade')->first()->grade,2) : " ",
                          AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[3])->whereNotNull('grade')->first() ?   number_format(AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[3])->whereNotNull('grade')->first()->grade,2) : " ",
                          AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[4])->whereNotNull('grade')->first() ?   number_format(AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[4])->whereNotNull('grade')->first()->grade,2) : " ",
                          number_format($aspirant->global_grade->grade,2)];
                }else{
                  $arr = [$aspirant->name,
                          $aspirant->surname.' '.$aspirant->lastname,
                          $aspirant->email,
                          $aspirant->state,
                          $aspirant->city,
                          $aspirant->gender=== 'female' ? "Femenino" : "Masculino",
                          $aspirant->origin,
                          AspirantInterview::where('aspirant_id',$aspirant->id)->whereNotNull('score')->count(),
                          AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[0])->whereNotNull('score')->first() ?   number_format(AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[0])->whereNotNull('score')->first()->score,2) : " ",
                          AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[1])->whereNotNull('score')->first() ?   number_format(AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[1])->whereNotNull('score')->first()->score,2) : " ",
                          AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[2])->whereNotNull('score')->first() ?   number_format(AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[2])->whereNotNull('score')->first()->score,2) : " ",
                          AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[3])->whereNotNull('score')->first() ?   number_format(AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[3])->whereNotNull('score')->first()->score,2) : " ",
                          AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[4])->whereNotNull('score')->first() ?   number_format(AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[4])->whereNotNull('score')->first()->score,2) : " ",
                          number_format($aspirant->global_interview_grade->score,2),
                          number_format($aspirant->global_grade->grade,2),
                          number_format((($aspirant->global_grade->grade + $aspirant->global_interview_grade->score)/2),2)
                        ];
                }

                $sheet->appendRow($arr);
              }

            });

            foreach ($states as $state) {
              $excel->sheet($state->state, function($sheet)use($notice,$headers,$state,$institutions,$headers_2,$type){
                $sheet->row(1, $headers);
                $sheet->row(1, function($row) {
                  $row->setBackground('#000000');
                  $row->setFontColor('#ffffff');
                });
                $sheet->row(2, $headers_2);
                $sheet->row(2, function($row) {
                  $row->setBackground('#000000');
                  $row->setFontColor('#ffffff');
                });
                if(!$type){
                    $aspirants =  $notice->aspirants_app_already_evaluated_by_state($state->state)->get();
                }else{
                    $aspirants =  $notice->aspirants_inter_already_evaluated_by_state($state->state)->get();
                }
                $temOrder = [];

                foreach ($aspirants as $aspirant) {
                  $temOrder[$aspirant->id] = number_format((($aspirant->global_grade->grade + $aspirant->global_interview_grade->score)/2),2);
                }
                arsort($temOrder);
                foreach ($temOrder as $key => $value) {
                  $aspirant = Aspirant::find($key);
                  if(!$type){
                    $arr = [$aspirant->name,
                            $aspirant->surname.' '.$aspirant->lastname,
                            $aspirant->email,
                            $aspirant->state,
                            $aspirant->city,
                            $aspirant->gender=== 'female' ? "Femenino" : "Masculino",
                            $aspirant->origin,
                            AspirantEvaluation::where('aspirant_id',$aspirant->id)->whereNotNull('grade')->count(),
                            AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[0])->whereNotNull('grade')->first() ?   number_format(AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[0])->whereNotNull('grade')->first()->grade,2) : " ",
                            AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[1])->whereNotNull('grade')->first() ?   number_format(AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[1])->whereNotNull('grade')->first()->grade,2) : " ",
                            AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[2])->whereNotNull('grade')->first() ?   number_format(AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[2])->whereNotNull('grade')->first()->grade,2) : " ",
                            AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[3])->whereNotNull('grade')->first() ?   number_format(AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[3])->whereNotNull('grade')->first()->grade,2) : " ",
                            AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[4])->whereNotNull('grade')->first() ?   number_format(AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$institutions[4])->whereNotNull('grade')->first()->grade,2) : " ",
                            number_format($aspirant->global_grade->grade,2)];
                  }else{
                    $arr = [$aspirant->name,
                            $aspirant->surname.' '.$aspirant->lastname,
                            $aspirant->email,
                            $aspirant->state,
                            $aspirant->city,
                            $aspirant->gender=== 'female' ? "Femenino" : "Masculino",
                            $aspirant->origin,
                            AspirantInterview::where('aspirant_id',$aspirant->id)->whereNotNull('score')->count(),
                            AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[0])->whereNotNull('score')->first() ?   number_format(AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[0])->whereNotNull('score')->first()->score,2) : " ",
                            AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[1])->whereNotNull('score')->first() ?   number_format(AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[1])->whereNotNull('score')->first()->score,2) : " ",
                            AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[2])->whereNotNull('score')->first() ?   number_format(AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[2])->whereNotNull('score')->first()->score,2) : " ",
                            AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[3])->whereNotNull('score')->first() ?   number_format(AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[3])->whereNotNull('score')->first()->score,2) : " ",
                            AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[4])->whereNotNull('score')->first() ?   number_format(AspirantInterview::where('aspirant_id',$aspirant->id)->where('institution',$institutions[4])->whereNotNull('score')->first()->score,2) : " ",
                            number_format($aspirant->global_interview_grade->score,2),
                            number_format($aspirant->global_grade->grade,2),
                            number_format((($aspirant->global_grade->grade + $aspirant->global_interview_grade->score)/2),2)];
                  }

                  $sheet->appendRow($arr);
                }
               });
            }

          })->store('xlsx','csv');
          $from    = "info@apertus.org.mx";
          $subject = "Conteo de aspirantes - convocatoria".$notice->title;
          $emails = [ //"hugo@gobiernofacil.com",
                       'carlos@gobiernofacil.com'];
          if(!$type){
              $attach = 'csv/aspirants_results.xlsx';
          }else{
              $attach = 'csv/aspirants_interview_results.xlsx';
          }
          foreach ($emails as $email) {
               Mail::send('emails.send_results', [], function($message) use ($from, $subject,$email,$attach) {
                                 $message->from($from, 'no-reply');
                                 $message->to($email);
                                 $message->subject($from);
                                 $message->attach($attach);
                });
                $this->info('Correo: '.$email.' enviado.');
          }

        }else{
          $this->info("No data");
        }
    }
}
