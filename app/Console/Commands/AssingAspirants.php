<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notice;
use App\Models\Aspirant;
use App\Models\AspirantInstitution;
use Carbon\Carbon;
use App\User;
class AssingAspirants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:assing-aspirant-to';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Asigna aspirantes a las instituciones para su evaluación';

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
        $today  = Carbon::now();
        $daysAgo = $today->subDays(3)->format('Y-m-d');
        $notice = Notice::where('end',$daysAgo)->where('public',1)->first();
        if($notice){
          $aspirants = $notice->aspirants_approved_proof()->get();
          $users_in  = User::select('institution')->where('type','admin')->where('enabled',1)->distinct('institution')->orderBy('institution','asc')->get();
          if($aspirants->count()>0 && $users_in->count()>0){
            $aspirants_to_assing = ceil($aspirants->count()/$users_in->count());
            $institutions = $users_in->pluck('institution')->toArray();
            $control = 0;
            $index   = 0;
            foreach ($aspirants as $aspirant) {
              if($control == $aspirants_to_assing){
                $control=0;
                $index++;
                if($index > sizeof($institutions)-1){
                  $index--;
                }
              }
              $aspIns = AspirantInstitution::firstOrCreate(["aspirant_id"=>$aspirant->id,"notice_id"=>$notice->id]);
              $aspIns->institution = $institutions[$index];
              $aspIns->save();
              $control++;
            }
          }
        }
    }
}
