<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use Excel;
use App\Models\Aspirant;
use App\Models\Interview;
use App\Models\Notice;
use App\User;
class ExportAspirantInterviews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:export-interviews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea excel con resultados de asignacion de interview->aspirantes para entrevistas por institución';

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
          $headers      = ["Nombre","Apellidos","Correo","Estado","Ciudad","Género","Sector","Institución","Tipo","Solicitar audio a"];
          $headers_2    = ["Nombre","Apellidos","Correo","Estado","Ciudad","Género","Sector","Tipo","Solicitar audio a"];
          Excel::create('aspirants_interviews', function($excel)use($headers,$notice,$headers_2) {
            // Set the title
            $excel->setTitle('Resultado de interview->aspirantes - concocatoria "'.$notice->title.'"');
            // Chain the setters
            $excel->setCreator('Gobierno Fácil')
                  ->setCompany('Gobierno Fácil');
            // Call them separately
            $excel->setDescription('Asignación de interview->aspirantes para entrevista pertenecientes a la convocatoria "'.$notice->title.'" por institucións');
            $excel->sheet('General', function($sheet)use($notice,$headers){
              $sheet->row(1, $headers);
                $sheet->row(1, function($row) {
                  $row->setBackground('#000000');
                  $row->setFontColor('#ffffff');
                });
                $interviews       = Interview::where('notice_id',$notice->id)->orderBy('institution','asc')->get();
                foreach ($interviews as $interview) {
                  $arr = [$interview->aspirant->name,
                          $interview->aspirant->surname.' '.$interview->aspirant->lastname,
                          $interview->aspirant->email,
                          $interview->aspirant->state,
                          $interview->aspirant->city,
                          $interview->aspirant->gender=== 'female' ? "Femenino" : "Masculino",
                          $interview->aspirant->origin,
                          $interview->institution,
                          $interview->type === 'face' ? "Entrevistar" : "Escuchar audio",
                          $interview->type === 'audio' ? Interview::where('aspirant_id',$interview->aspirant->id)->where('type','face')->where('notice_id',$notice->id)->first()->institution : ""];
                  $sheet->appendRow($arr);
                }

              });
                $institutions  = User::select('institution')->where('type','admin')->where('enabled',1)->distinct('institution')->orderBy('institution','asc')->get();
                foreach ($institutions as $institution){

                  switch ($institution->institution) {
                    case 'Gobierno Fácil':
                          $name = 'GF';
                    break;

                    case 'Gestión Social Y Cooperación':
                          $name = 'GESOC';
                    break;
                    case 'Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales':
                          $name = 'INAI';
                    break;
                    case 'Programa de las Naciones Unidas para el Desarrollo':
                          $name = 'PNUD';
                    break;
                    case 'PROSOCIEDAD':
                          $name = 'PROSOCIEDAD';
                    break;

                    default:
                      $name = '';
                    break;
                  }
                  $excel->sheet($name, function($sheet)use($notice,$institution,$headers_2){
                    $sheet->row(1, $headers_2);
                    $sheet->row(1, function($row) {
                      $row->setBackground('#000000');
                      $row->setFontColor('#ffffff');
                    });
                    $interviews       = Interview::where('notice_id',$notice->id)->where('type','face')->where('institution',$institution->institution)->get();
                    foreach ($interviews as $interview) {
                      $arr = [$interview->aspirant->name,
                              $interview->aspirant->surname.' '.$interview->aspirant->lastname,
                              $interview->aspirant->email,
                              $interview->aspirant->state,
                              $interview->aspirant->city,
                              $interview->aspirant->gender=== 'female' ? "Femenino" : "Masculino",
                              $interview->aspirant->origin,
                              $interview->type === 'face' ? "Entrevistar" : "Escuchar audio",
                              $interview->type === 'audio' ? Interview::where('aspirant_id',$interview->aspirant->id)->where('type','face')->where('notice_id',$notice->id)->first()->institution : ""];
                      $sheet->appendRow($arr);
                    }
                    $interviews       = Interview::where('notice_id',$notice->id)->where('type','audio')->where('institution',$institution->institution)->get();
                    foreach ($interviews as $interview) {
                      $arr = [$interview->aspirant->name,
                              $interview->aspirant->surname.' '.$interview->aspirant->lastname,
                              $interview->aspirant->email,
                              $interview->aspirant->state,
                              $interview->aspirant->city,
                              $interview->aspirant->gender=== 'female' ? "Femenino" : "Masculino",
                              $interview->aspirant->origin,
                              $interview->type === 'face' ? "Entrevistar" : "Escuchar audio",
                              $interview->type === 'audio' ? Interview::where('aspirant_id',$interview->aspirant->id)->where('type','face')->where('notice_id',$notice->id)->first()->institution : ""];
                      $sheet->appendRow($arr);
                    }
                   });
                }
           $excel->setActiveSheetIndex(0);

           })->store('xlsx','csv');
           $from    = "info@apertus.org.mx";
           $subject = "Asignación entrevistas - convocatoria".$notice->title;
           $emails = [ "hugo@gobiernofacil.com",
                        'carlos@gobiernofacil.com'];
           foreach ($emails as $email) {
                 Mail::send('emails.send_interviews', [], function($message) use ($from, $subject,$email) {
                                  $message->from($from, 'no-reply');
                                  $message->to($email);
                                  $message->subject($from);
                                  $message->attach('csv/aspirants_interviews.xlsx');
                 });
                 $this->info('Correo: '.$email.' enviado.');
           }


    }
  }
}
