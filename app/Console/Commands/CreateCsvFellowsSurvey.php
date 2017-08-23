<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use App\Models\FellowSurvey;


class CreateCsvFellowsSurvey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-csv-fellow-survey';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Guarda csv con los resultados de las encuestas';

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
        $surveys = FellowSurvey::orderBy('created_at')->first();
        if($surveys){
            $surveys->store_answers_survey($surveys);
           $this->info("All done");
          }
          
        
    }
}
