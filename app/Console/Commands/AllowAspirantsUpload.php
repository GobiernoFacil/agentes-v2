<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notice;

class AllowAspirantsUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:allow-aspirant-upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permite habilitar carga de archivos sin salida al front ';

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
        $notices  = Notice::orderBy('start','asc')->get();
        $option   = $this->ask('Which action? '."\n"."1- Enabled"."\n"."2- Disabled");
        if(!(int)$option ||(int)$option > 2  ||(int)$option < 0 ){
          return $this->warn('Select a valid value' );
        }
        $message  = '';
        $count    = 1;
        $arr      = [];

        foreach ($notices as $notice) {
          $message = $message.' '.$count.'-'.$notice->title."\n";
          $arr[$count] = $notice->id;
          $count++;
        }
        $notice_id = $this->ask('Which notice? '."\n".$message);
        if((int)$notice_id > sizeof($arr) || !(int)$notice_id || (int)$notice_id < 0){
          return $this->warn('Select a valid value' );
        }

        $notice_id  = $arr[$notice_id];
        $notice = Notice::where('id',$notice_id)->first();
        if((int)$option==1){
            $value = 1;
        }elseif((int)$option==2){
            $value = 0;
        }
        if($notice){
          $notice->allow_upload =$value;
          $notice->save();
        }


        if($value){

          Notice::whereNotIn('id',[$notice->id])->update(['allow_upload'=>0]);
        }
        $this->info("Notice: "."'$notice->title' selected ");
        if((int)$option==1){
            $this->info("enabled");
        }elseif((int)$option==2){
            $this->info("disabled");
        }

    }
}
