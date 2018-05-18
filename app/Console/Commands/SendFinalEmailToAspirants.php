<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notice;
use App\Notifications\SendAcceptedNotification;
use App\Notifications\SendAspirantFinalNotification;
use Illuminate\Notifications\Notifiable;
class SendFinalEmailToAspirants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send-final-email-to-aspirants';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía correo de aceptación a los aspirantes seleccionados y correo general a los aspirantes ';

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

          $acceptedAspirants = $notice->fellows;
          $allAspirants      = $notice->all_aspirants_data()->whereNotIn('id',$acceptedAspirants->pluck('aspirant_id')->toArray())->get();
          foreach ($allAspirants as $aspirant) {
          }
          foreach ($acceptedAspirants as $aspirant) {
          }
          $this->info($allAspirants->count().' aspirants notified');
          $this->info($acceptedAspirants->count().' aspirants accepted notified');

        }


    }
}
