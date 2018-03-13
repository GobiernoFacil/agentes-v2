<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Aspirant;
use App\Models\AspirantNotice;
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
        
        $all = Aspirant::all();
        foreach ($aspirants_to_attach as $aspirant) {
          $this->info($aspirant->id);
          # code...
        }
        var_dump(sizeof($aspirants_attached));
        var_dump($aspirants_to_attach->count());
        var_dump($all->count());
    }
}
