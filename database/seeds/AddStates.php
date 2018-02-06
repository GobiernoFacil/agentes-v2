<?php

use Illuminate\Database\Seeder;
use App\Models\State;
class AddStates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        $table      = "states";
        $file_path  = base_path() . "/csv/states.json";
        DB::table($table)->delete();
        $contents = File::get($file_path);
        $jsonIterator = new RecursiveIteratorIterator(
                        new RecursiveArrayIterator(json_decode($contents, TRUE)),
                            RecursiveIteratorIterator::SELF_FIRST);
        $temp = [];
        foreach ($jsonIterator as $key => $val) {
          if($key==='name'){
            $state = new State(['name'=>$val]);
            $state->save();
          }
        }


        $this->command->info('States table seeded!');
    }
}
