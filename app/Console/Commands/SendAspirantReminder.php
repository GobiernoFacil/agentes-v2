<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Aspirant;
use App\Models\Notice;
use App\Notifications\SendReminder;
use Illuminate\Notifications\Notifiable;
class SendAspirantReminder extends Command
{
  use Notifiable;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send-aspirants-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía correo a los aspirantes verificados para recordarles que aún no completan todos sus datos en la plataforma';

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
        if(!$notice){
            $notice = Notice::where('allow_upload',1)->where('public',1)->first();
        }

        if($notice){
          $aspirants_id = $notice->aspirants()->pluck('aspirant_id');
          $active  = Aspirant::where('is_activated',1)->whereIn('id',$aspirants_id->toArray())->get();
          foreach ($active as $aspirant) {
            if(!$aspirant->check_aplication_data() && $aspirant->email != 'tlliterartes@gmail.com'){
            if($notice->allow_upload){
                $aspirant->notify(new SendReminder($aspirant,$notice,1));
            }else{
                $aspirant->notify(new SendReminder($aspirant,$notice,0));
            }
             $this->info("Aspirante: ".$aspirant->name.' '.$aspirant->surname.' '.$aspirant->lastname.' - Correo: '.$aspirant->email.' notified');
            }
          }
        }else{
          $this->info('Sin convocatoria habilitada');
        }

    }
}
