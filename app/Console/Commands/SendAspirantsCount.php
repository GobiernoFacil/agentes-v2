<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use Excel;
use App\Models\Aspirant;
use App\Models\AspirantsFile;
class SendAspirantsCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:aspirant-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia archivo excel con conteo de aspirantes que han o no subido archivos por entidad';

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
        $states = Aspirant::select('state')->distinct()->get();
        $aspirants_id = Aspirant::all()->pluck('id');
        $aspirantsFile_id = AspirantsFile::all()->pluck('aspirant_id');
        $headers    = ["Estado","Con Archivos","Sin Archivos","Total"];

        Excel::create('aspirants_count', function($excel)use($aspirants_id,$aspirantsFile_id,$states,$headers) {
          // Set the title
          $excel->setTitle('Cuenta de aspirantes por entidad');
          // Chain the setters
          $excel->setCreator('Gobierno Fácil')
                ->setCompany('Gobierno Fácil');
          // Call them separately
          $excel->setDescription('Cuenta de aspirantes por entidad');
          $excel->sheet('Aspirantes', function($sheet)use($aspirants_id,$aspirantsFile_id,$states,$headers){
            $sheet->row(1, $headers);
            $sheet->row(1, function($row) {
              $row->setBackground('#000000');
              $row->setFontColor('#ffffff');
            });
            $countC = 0;
            $countS = 0;
            $countT = 0;
            foreach ($states as $state) {
              $data  = Aspirant::where('state',$state->state)->whereIn('id',$aspirantsFile_id)->get();
              $countC = $countC + $data->count();
              $dataNot  = Aspirant::where('state',$state->state)->whereNotIn('id',$aspirantsFile_id)->get();
              $countS = $countS + $dataNot->count();
              $countT = $countT + ($data->count()+$dataNot->count());
              $arr = [$state->state,$data->count(),$dataNot->count(),($data->count()+$dataNot->count())];
              $sheet->appendRow($arr);
            }
            $arr = ['Total',$countC,$countS,$countT];
            $sheet->appendRow($arr);
          });

      })->store('xlsx','csv');
      $from    = "info@apertus.org.mx";
      $subject = "Conteo de aspirantes";
      Mail::send('emails.send_count', [], function($message) use ($from, $subject) {
              $message->from($from, 'no-reply');
              $message->to('carlos@gobiernofacil.com');
              $message->subject($from);
              $message->attach('csv/aspirants_count.xlsx');
      });
    }
}
