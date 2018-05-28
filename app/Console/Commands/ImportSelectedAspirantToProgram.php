<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Excel;
use File;
use App\Models\Aspirant;
use App\Models\FellowProgram;
use App\Models\FellowData;
use App\Models\Notice;
use App\User;
class ImportSelectedAspirantToProgram extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:import-selected-aspirants {file_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Guarda aspirantes seleccionados para un programa a través de un archivo XLSX';

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

          $file_name =  $this->argument('file_name');
          $path_file = base_path().'/csv/'.$file_name;
          if(File::exists($path_file)){
            Excel::load($path_file, function($reader){
              $results = $reader->get(array('emails'));
              $count = 0;
                  foreach($results as $result){
                    if($aspirant = Aspirant::where('email',$result->emails)->where('is_activated',1)->first()){
                      $this->info($result->emails);
                        FellowProgram::firstOrCreate([
                          'user_id'     => $aspirant->user()->id,
                          'program_id'  => $aspirant->notice->notice->program->id,
                          'notice_id'   => $aspirant->notice->notice_id,
                          'aspirant_id' => $aspirant->id
                        ]);
                        if($user = User::where('id',$aspirant->user()->id)->where('enabled',1)->first()){
                          $user->type = 'fellow';
                          $user->save();
                          $data = FellowData::firstOrCreate(['user_id'=>$user->id]);
                          $data->surname   = '';
                          $data->lastname  = '';
                          $data->state     = $aspirant->state;
                          $data->city      = $aspirant->city;
                          $data->degree    = $aspirant->degree;
                          $data->origin    = $aspirant->origin;
                          $data->save();
                        }

                      $count++;
                    }
                  }
                  $this->info($count." aspirants saved!");
            })->first();

          }else{
            $this->info("Files does not exists");
          }

    }
}
