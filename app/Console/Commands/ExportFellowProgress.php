<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Excel;
use Mail;
use App\Models\Program;
use App\User;
class ExportFellowProgress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:export-fellow-progress';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea excel con el progreso del fellow';

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
        $today = date('Y-m-d');
        if($program = Program::where('start','<=',$today)->orderBy('start','desc')->where('public',1)->first()){
          $this->info($program->title);
          $uset  = User::where('email','andre@fcb.com')->first();
          $name  = 'fellows_progress';
          $headers    = ["Nombre","Correo","Módulos completados","Módulo actual"];
          Excel::create($name, function($excel)use($headers,$program,$uset) {
            // Set the title
            $excel->setTitle('Progreso de fellows - programa "'.$program->title.'"');
            // Chain the setters
            $excel->setCreator('Gobierno Fácil')
                  ->setCompany('Gobierno Fácil');
            // Call them separately
            $excel->setDescription('Progreso de fellows - programa "'.$program->title.'"');
            $excel->sheet('General', function($sheet)use($program,$headers,$uset){
              $sheet->row(1, $headers);
              $sheet->row(1, function($row) {
                $row->setBackground('#000000');
                $row->setFontColor('#ffffff');
              });
              foreach($program->fellows as $fellow){
                if($uset->id != $fellow->id){
                  $arr = [$fellow->user->name,
                          $fellow->user->email,
                          $fellow->user->complete_modules($program->id)->count(),
                          $fellow->user->actual_module()->title,
                        ];
                  $sheet->appendRow($arr);
                }
              }
            });
          })->store('xlsx','csv');

          $from    = "info@apertus.org.mx";
          $subject = "Progreso fellows - programa".$program->title;
          $emails = [ 'carlos@gobiernofacil.com'];
          $attach = 'csv/fellows_progress.xlsx';
          foreach ($emails as $email) {
               Mail::send('emails.send_progress', [], function($message) use ($from, $subject,$email,$attach) {
                                 $message->from($from, 'no-reply');
                                 $message->to($email);
                                 $message->subject($from);
                                 $message->attach($attach);
                });
                $this->info('Correo: '.$email.' enviado.');
          }
        }else{
          $this->info('No program');
        }
    }
}
