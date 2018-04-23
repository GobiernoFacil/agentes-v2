<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Aspirant;
use App\Notifications\SendAspirantInterview;
use Illuminate\Notifications\Notifiable;
class SendAspirantInterviewNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send-aspirant-interview-message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        /**********************************************************************/
           // Aspirantes seleccionados por consenso de instituciones.
           // Se carga a través de archivo csv
           /**********************************************************************/
           $path =  base_path().'/csv/selected.csv';
           $file = fopen($path, "r");
           $emails = [];
           while ( ($data = fgetcsv($file, 1000, ",")) !==FALSE )
              {
                     $email = $data[0];
                     array_push($emails, $email);
              }
            fclose($file);

            foreach ($emails as $email) {
              if($aspirant =Aspirant::where('email',$email)->where('is_activated',1)->first()){
                $this->info($aspirant->name.' '.$aspirant->email);
                $aspirant->notify(new SendAspirantInterview($aspirant));
              }
            }

            $this->info('Aspirantes: '.sizeof($emails));

    }
}
