<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Notifications\Notifiable;
use App\Models\Aspirant;
use App\Models\FellowData;
use App\User;
use Excel;
use Hash;
use App\Notifications\FellowEmail;
class CreateFellows extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-fellows';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add fellows to database';

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
      $file = 'csv_2/news.csv';
        Excel::load($file, function($reader){
        $reader->each(function($row){
            if(!empty($row->email)){
              $aspirant = Aspirant::where('email',$row->email)->first();
              if($aspirant){
                $new_user   = new User();
                $new_user->name  = $aspirant->name;
                $new_user->email = $aspirant->email;
                $password        = str_random(8);
                $new_user->password = Hash::make($password);
                $new_user->type = 'fellow';
                $new_user->enabled = 1;
                $new_user->save();
                $fellowData = new FellowData();
                $fellowData->surname  = $aspirant->surname;
                $fellowData->lastname = $aspirant->lastname;
                $fellowData->state    = $aspirant->state;
                $fellowData->city     = $aspirant->city;
                $fellowData->degree   = $aspirant->degree;
                $fellowData->origin   = $aspirant->origin;
                $fellowData->user_id  = $new_user->id;
                $fellowData->save();
                $this->info($aspirant->email.': Created!');
                $new_user->notify(new FellowEmail($new_user,$password));
              }
            }
        });
      })->first();

    }
}
