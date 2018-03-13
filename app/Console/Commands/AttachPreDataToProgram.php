<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Aspirant;
use App\Models\AspirantNotice;
use App\Models\FellowProgram;
use App\Models\Module;
use App\Models\Notice;
use App\Models\Program;
use App\User;


class AttachPreDataToProgram extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:attach-to-first-program';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Agrega módulos, aspirantes y fellows (iniciales) a programa 2017 y convocatoria 2017 respectivamente';

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
        $aspirants_attached = AspirantNotice::pluck('aspirant_id')->toArray();
        $aspirants_to_attach = Aspirant::whereNotIn('id',$aspirants_attached)->get();
        $notice   = Notice::where('title','Convocatoria 2017')->first();
        $all = Aspirant::all();
        foreach ($aspirants_to_attach as $aspirant) {
          AspirantNotice::firstOrCreate([
            'aspirant_id' => $aspirant->id,
            'notice_id'   => $notice->id
          ]);
        }

        $program = $notice->program;
        $modules = Module::whereNull('program_id')->pluck('id')->toArray();
        Module::whereIn('id', $modules)
          ->update(['program_id' => $program->id]);
        $fellows_assi = FellowProgram::pluck('user_id')->toArray();
        $fellows = User::where('type','fellow')->whereNotIn('id',$fellows_assi)->get();
        foreach ($fellows as $fellow){
           FellowProgram::firstOrCreate([
             'user_id' => $fellow->id,
             'program_id'=> $program->id
           ]);
           }
        
        $this->info('Attached');




    }
}
