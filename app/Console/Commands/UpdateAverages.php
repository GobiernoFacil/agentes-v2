<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FellowAverage;
use App\Models\Module;
use App\Models\ModuleSession;
use App\User;

class UpdateAverages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update-averages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza promedios de los fellows';

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
        $this->update();
    }

    public function update()
    {
      $fellows  = User::where('type','fellow')->where('enabled',1)->get();
      $today = date("Y-m-d");
      $sessions = ModuleSession::where('start','<=',$today)->get();
      foreach ($fellows as $fellow) {
        foreach ($sessions as $session) {
          //$this->info($session->name);
          $fellow_average = new FellowAverage();
            //$this->info($fellow_average->scoreSession(null,$fellow->id,$session->id));
          $fellow_average->scoreSession(null,$fellow->id,$session->id);
        }
        $this->info('Fellow: '.$fellow->name.' '.$fellow->fellowData->surname.' actualizado');
      }

    }
}
