<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Notifications\Notifiable;
use App\Models\Aspirant;
use App\Models\AspirantActivation;
use App\Notifications\MassiveEmail;
class SendMassiveEmails extends Command
{
  use Notifiable;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send-massive-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails to applicants';

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
        $this->sendEmails();
    }

    public function sendEmails()
    {
        $aspirants_id = AspirantActivation::all()->pluck('aspirant_id');
        $aspirants = Aspirant::whereIn('id',$aspirants_id->toArray())->get();
        foreach ($aspirants as $aspirant) {
          # code...
          $aspirant->sendEmail($aspirant->code->token);
        }

    }


}
