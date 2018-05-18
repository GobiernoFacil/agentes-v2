<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notice;
use App\Notifications\SendAcceptedNotification;
use App\Notifications\SendAspirantFinalNotification;
use Illuminate\Notifications\Notifiable;
use App\User;
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
          $allAspirants      = $notice->all_aspirants_data()->whereNotIn('id',$acceptedAspirants->pluck('aspirant_id')->toArray())->orderBy('name','asc')->get();
          $this->info('||------------------------------------------------------------------------------------------------------||');
          $this->info('Aspirants not selected: ');
          $count = 1;
          foreach ($allAspirants as $aspirant) {
            $this->info($count.' '.$aspirant->name.' '.$aspirant->surname.' '.$aspirant->lastname);
            $count++;
          }
          $aspirant = User::where('email','carlos@gobiernofacil.com')->first();
          $aspirant->notify(new SendAspirantFinalNotification($aspirant,$notice));
          $count = 1;
          $this->info('||------------------------------------------------------------------------------------------------------||');
          $this->info('Aspirants selected: ');
          foreach ($acceptedAspirants as $aspirantP) {
            $this->info($count.' '.$aspirantP->aspirant->name.' '.$aspirantP->aspirant->surname.' '.$aspirantP->aspirant->lastname);
            $count++;
          }
          $aspirant = User::where('email','carlos@gobiernofacil.com')->first();
          $aspirant->notify(new SendAcceptedNotification($aspirant,$notice));
          $this->info('||------------------------------------------------------------------------------------------------------||');
          $this->info($allAspirants->count().' aspirants notified');
          $this->info($acceptedAspirants->count().' aspirants accepted notified');

        }


    }
}
