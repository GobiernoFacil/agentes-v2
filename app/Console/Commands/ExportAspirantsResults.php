<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use Excel;
use App\Models\Aspirant;
use App\Models\AspirantEvaluation;
use App\Models\Notice;
class ExportAspirantsResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:export-aspirants-results';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea excel con resultados de evaluaciones por estado';

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
          $headers      = ["Nombre","Apellidos","Correo","Estado","Ciudad","Número de evaluaciones", "Calificación"];
          Excel::create('aspirants_results', function($excel)use($headers,$notice,$states) {
            // Set the title
            $excel->setTitle('Resultado de aspirantes - concocatoria "'.$notice->title.'"');
            // Chain the setters
            $excel->setCreator('Gobierno Fácil')
                  ->setCompany('Gobierno Fácil');
            // Call them separately
            $excel->setDescription('Resultado de las evaluaciones para los aspirantes de la convocatoria "'.$notice->title.'" general y por estado');
            $excel->sheet('General', function($sheet)use($notice,$headers){
              $sheet->row(1, $headers);
              $sheet->row(1, function($row) {
                $row->setBackground('#000000');
                $row->setFontColor('#ffffff');
              });
              $aspirants = $notice->aspirants_app_already_evaluated()->get();
              foreach ($aspirants as $aspirant) {
                $arr = [$aspirant->name,$aspirant->surname.' '.$aspirant->lastname,$aspirant->email,$aspirant->state,$aspirant->city,AspirantEvaluation::where('aspirant_id',$aspirant->id)->whereNotNull('grade')->count(),number_format($aspirant->global_grade->grade,2)];
                $sheet->appendRow($arr);
              }

            });

            foreach ($states as $state) {
              $excel->sheet($state->state, function($sheet)use($notice,$headers,$state){
                $sheet->row(1, $headers);
                $sheet->row(1, function($row) {
                  $row->setBackground('#000000');
                  $row->setFontColor('#ffffff');
                });
                $aspirants =  $notice->aspirants_app_already_evaluated_by_state($state->state)->get();
                foreach ($aspirants as $aspirant) {
                  $arr = [$aspirant->name,$aspirant->surname.' '.$aspirant->lastname,$aspirant->email,$aspirant->state,$aspirant->city,AspirantEvaluation::where('aspirant_id',$aspirant->id)->whereNotNull('grade')->count(),number_format($aspirant->global_grade->grade,2)];
                  $sheet->appendRow($arr);
                }
               });
            }

          })->store('xlsx','csv');
          $from    = "info@apertus.org.mx";
          $subject = "Conteo de aspirantes - convocatoria".$notice->title;
          $emails = [  "hugo@gobiernofacil.com",
                       'carlos@gobiernofacil.com'];
          foreach ($emails as $email) {
                Mail::send('emails.send_results', [], function($message) use ($from, $subject,$email) {
                                 $message->from($from, 'no-reply');
                                 $message->to($email);
                                 $message->subject($from);
                                 $message->attach('csv/aspirants_results.xlsx');
                });
                $this->info('Correo: '.$email.' enviado.');
          }

        }else{
          $this->info("No data");
        }
    }
}