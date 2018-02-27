<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use Excel;
use App\Models\Aspirant;
use App\Models\AspirantsFile;
use App\Models\Notice;
class SendAspirantsCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:aspirant-count {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia archivo excel con conteo de aspirantes para la convocatoria actual';

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
        $notice  = new Notice;
        $notice  = $notice->get_last_notice();
        $aspirants_id = $notice->aspirants()->pluck('aspirant_id');
        $states = Aspirant::select('state')->whereIn('id',$aspirants_id->toArray())->distinct()->orderBy('state','asc')->get();
        $headers    = ["Estado","Verificados","Sin verificar","Aplicación completada", "Aplicación sin completar"];

        Excel::create('aspirants_count', function($excel)use($aspirants_id,$notice,$states,$headers) {
          // Set the title
          $excel->setTitle('Cuenta de aspirantes por entidad');
          // Chain the setters
          $excel->setCreator('Gobierno Fácil')
                ->setCompany('Gobierno Fácil');
          // Call them separately
          $excel->setDescription('Cuenta de aspirantes por entidad');
          $excel->sheet('Aspirantes', function($sheet)use($aspirants_id,$states,$headers){
            $sheet->row(1, $headers);
            $sheet->row(1, function($row) {
              $row->setBackground('#000000');
              $row->setFontColor('#ffffff');
            });
            $totalCaW= 0;
            $totalCaWn = 0;
            foreach ($states as $state) {
              $active    = Aspirant::where('state',$state->state)->where('is_activated',1)->whereIn('id',$aspirants_id->toArray())->get();
              $noActive  = Aspirant::where('state',$state->state)->where('is_activated',0)->whereIn('id',$aspirants_id->toArray())->get();
              $count_aspirant_with_data = 0;
              $count_aspirant_without_data = 0;
              foreach ($active as $aspirant) {
                 if($aspirant->AspirantsFile){
                   if($aspirant->AspirantsFile->video && $aspirant->AspirantsFile->proof && $aspirant->AspirantsFile->privacy_policies && $aspirant->AspirantsFile->motives){
                     if($aspirant->cv){
                        if($aspirant->cv->open_experiences()->count()>0 && $aspirant->cv->experiences()->count()>0 && $aspirant->cv->academic_trainings()->count()>0){
                          $count_aspirant_with_data++;
                        }else{
                          $count_aspirant_without_data++;
                        }

                     }else{
                       $count_aspirant_without_data++;
                     }

                   }else{
                     $count_aspirant_without_data++;
                   }
                 }else{
                   $count_aspirant_without_data++;
                 }

              }
              $totalCaW = $totalCaW + $count_aspirant_with_data;
              $totalCaWn = $totalCaWn + $count_aspirant_without_data;
              $arr = [$state->state,$active->count(),$noActive->count(),$count_aspirant_with_data,$count_aspirant_without_data];
              $sheet->appendRow($arr);
            }
            $tActive = Aspirant::where('is_activated',1)->whereIn('id',$aspirants_id->toArray())->count();
            $tnActive = Aspirant::where('is_activated',0)->whereIn('id',$aspirants_id->toArray())->count();
            $arr = ['Total',$tActive,$tnActive,$totalCaW,$totalCaWn];
            $sheet->appendRow($arr);
            $arr=['','Total aspirantes',($tActive+$tnActive)];
            $sheet->appendRow($arr);
          });

      })->store('xlsx','csv');
      $from    = "info@apertus.org.mx";
      $subject = "Conteo de aspirantes - convocatoria".$notice->title;
      if(!$this->argument('type')){
        $emails = ["hugo@gobiernofacil.com"];

      }elseif($this->argument('type')){
        $emails  = ['maria.montiel@inai.org.mx',
                    'dionisio.zabaleta@inai.org.mx',
                    'alfredo.elizondo@gesoc.org.mx',
                    'adrian.santos@undp.org, magdalena.rodriguez@prosociedad.org',
                    'carlos.bauche@prosociedad.org',
                    'german@prosociedad.org',
                    'rmhender@gmail.com',
                    'ana.deltoro@undp.org',
                    'hugo@gobiernofacil.com',
                    'carlos@gobiernofacil.com',];

      }

    foreach ($emails as $email) {
      Mail::send('emails.send_count', [], function($message) use ($from, $subject,$email) {
              $message->from($from, 'no-reply');
              $message->to($email);
              $message->subject($from);
              $message->attach('csv/aspirants_count.xlsx');
      });
    }

    }
}
