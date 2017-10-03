<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FellowData;
use App\User;
use App\Models\Aspirant;
use League\Csv\Reader;


class AddGenderToFellows extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:add-gender';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'adds gender to fellows and aspirants';

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

        $fellows = User::where('type','fellow')->where('enabled',1)->get();
        foreach ($fellows as $fellow) {
          if($fellow->name==='Denisse' || $fellow->name==='Célida Jazmín' || $fellow->name==='Célida Jazmín' || $fellow->name==='Mireya' || $fellow->name==='Flor Dessire' || $fellow->name=== 'Marisol Bárbara'
             || $fellow->name=== 'Carolina' || $fellow->name=== 'Nayeli Lucero'   || $fellow->name=== 'JAZMIN' || $fellow->name=== 'Tatiana Lizzeth' || $fellow->name=== 'JAZMIN' || $fellow->name=== 'Cynthia Dennis'){
               $fellow->fellowData->gender = 'Female';
               $fellow->fellowData->save();
              $this->info($fellow->fellowData->gender);
          }else{
            $fellow->fellowData->gender = 'Male';
            $fellow->fellowData->save();
            $this->info($fellow->fellowData->gender);
          }
        }

        $file_path  = base_path() . "/csv_2/gender.csv";
        $csv = Reader::createFromPath($file_path)
        ->setHeaderOffset(0);
        foreach ($csv as $record) {
          $aspirant   = Aspirant::where('email',$record['email'])->first();
          if($aspirant){
            $aspirant->gender = $record['gender'];
            $aspirant->save();
          }
        }




    }
}
