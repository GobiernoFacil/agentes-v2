<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Aspirant;
use App\Models\FileEvaluation;
use App\User;
use Excel;
class AddAspirants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:aspirant-list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Agrega evaluación de archivos';

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
        $this->readExcel();
    }

    public function readExcel()
    {
      $file = 'csv_2/list.csv';
      $institutions = ['Gobierno Fácil','Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales','Gestión Social Y Cooperación','Programa de las Naciones Unidas para el Desarrollo','PROSOCIEDAD'];
      Excel::load($file, function($reader)use($institutions){
        $reader->each(function($row)use($institutions){
            if(!empty($row->email)){
              $aspirant = Aspirant::where('email',$row->email)->first();
              if($aspirant){
                foreach ($institutions as $institution) {
                  $user = User::where('institution',$institution)->first();
                  if($user){
                    $fileRegister = FileEvaluation::firstOrCreate(['user_id'=>$user->id,'aspirant_id'=>$aspirant->id,'institution'=>$institution]);
                    $fileRegister->hasVideo =1;
                    $fileRegister->hasLetter =1;
                    $fileRegister->hasEssay =1;
                    $fileRegister->hasCv =1;
                    $fileRegister->hasPrivacy =1;
                    $fileRegister->hasProof =1;
                    $fileRegister->save();
                  }
                }
                $this->info($aspirant->email.': Saved!');
              }
            }
        });
      })->first();

    }
}
