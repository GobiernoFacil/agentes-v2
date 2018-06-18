<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Program;
use App\Models\FellowAverage;
use App\User;
class UpdateFellowProgress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update-fellow-progress';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza el progreso de cada fellow';

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
          foreach($program->fellows as $fellow){
            $count = 0;
            foreach ($program->fellow_modules()->where('end','<=',$today)->get() as $module) {
              // code...
              $fellow->user->update_forum_progress($module->id);
              if($fellow->user->update_module_progress($module->slug)){
                $count++;
              }else{
                break;
              }
            }

            foreach ($program->fellow_modules()->where('start','<=',$today) as $module) {
              if($module->get_all_evaluation_activity_and_forum()->count() > 0){
                foreach ($module->sessions as $session) {
                    if($session->activity_eval_and_forum()->count() > 0){
                        $fellowAverage = FellowAverage::firstOrCreate([
                                    'user_id'    => $fellow->user->id,
                                    'module_id'  => $session->module->id,
                                    'session_id' => $session->id,
                                    'type'       => 'session',
                                    'program_id' => $session->module->program->id
                                  ]);
                        $fellowAverage->scoreSession();
                    }
                }

              }
            }


            $this->info($fellow->user->name.' '.$count.' modules updated');
            foreach ($program->fellow_modules()->where('start','<=',$today)->get() as $module) {
              // code...
              $uset->update_forum_progress($module->id);
            }
          }

        }else{
          $this->info('No program');
        }

    }
}
