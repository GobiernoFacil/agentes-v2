<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notice;
use App\Models\Aspirant;
use App\Models\AspirantInstitution;
use Carbon\Carbon;
use App\User;
class AssignAspirants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:assign-aspirant-to {type} {notice_id=false}';

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
        if($this->argument('type') == 0){
          //automatico
          $daysAgo = $today->subDays(3)->format('Y-m-d');
          $notice = Notice::where('end',$daysAgo)->where('public',1)->first();
        }elseif($this->argument('type') == 1){
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

        }elseif($this->argument('type') == 2){
          //llamada desde código
          $notice = Notice::where('id',$this->argument('notice_id'))->first();
        }else{
          //none
          $notice = false;
        }
        if($notice){
          $aspirants = $notice->aspirants_approved_proof()->get();
          $users_in  = User::select('institution')->where('type','admin')->where('enabled',1)->distinct('institution')->orderBy('institution','asc')->get();
          if($aspirants->count()>0 && $users_in->count()>0){
            $max_number_to_assing = ceil(($aspirants->count()*3)/$users_in->count());
            $institutions = $users_in->pluck('institution')->toArray();
            $aspirants_id = $aspirants->pluck('id')->toArray();
            //ordena aleatoriamente a los aspirantes e instituciones
            shuffle($institutions);
            shuffle($aspirants_id);
            $single  = array_rand($institutions, 1);
            if(AspirantInstitution::where('institution',$institutions[$single])->where('notice_id',$notice->id)->count() <=0){
                for ($i=0; $i < sizeof($aspirants_id); $i++) {
                    $control = 0;
                    //just in case
                    $max_number_of_iterations = 0;
                    while($control < 3){
                      $single  = array_rand($institutions, 1);
                      $check = AspirantInstitution::where('institution',$institutions[$single])->where('aspirant_id',$aspirants_id[$i])->where('notice_id',$notice->id)->first();
                      $count =  AspirantInstitution::where('institution',$institutions[$single])->where('notice_id',$notice->id)->count();
                      if(!$check && $count < $max_number_to_assing){
                        AspirantInstitution::firstOrCreate(['aspirant_id'=>$aspirants_id[$i],'notice_id'=>$notice->id,'institution'=>$institutions[$single]]);
                        $control++;
                      }

                      if($max_number_of_iterations == ($max_number_to_assing*($aspirants->count()*9))){
                        break;
                      }
                      $max_number_of_iterations++;
                    }
                }
              }

            //debug on server delete after first notice
            $this->info('Total number of aspirants to assign: '.$aspirants->count());
            $this->info('Max number to assign: '.$max_number_to_assing);
            foreach ($institutions as $institution) {
              $count = AspirantInstitution::where('institution',$institution)->where('notice_id',$notice->id)->count();
              $this->info('Institution: '.$institution.' assigned: '.$count);
            }

          }
        }
    }
}
