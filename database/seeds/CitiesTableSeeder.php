<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use League\Csv\Reader;
use App\Models\State;
use App\Models\City;
class CitiesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Model::unguard();

    /*  $this->call('CitiesTableSeederC');
      $this->command->info('cities table seeded!');

      Model::reguard();
      //*/
      $table      = "cities";
      $file_path  = base_path() . "/csv/ciudades.json";
      DB::table($table)->truncate();
      $contents = File::get($file_path);
      $jsonIterator = new RecursiveIteratorIterator(
                      new RecursiveArrayIterator(json_decode($contents, TRUE)),
                          RecursiveIteratorIterator::SELF_FIRST);

      $temp = [];
      $count = 0;
      foreach ($jsonIterator as $key => $val) {
          if(is_array($val)) {
                if($temp){
                       $city = new City($temp);
                       $city->save();
                       $temp = [];
                       $count++;
                  }
          }else {
                if($key==='name'){
                    $temp['city'] = $val;
                }elseif($key==='state'){
                    $state = $this->get_state($val);
                    $temp['state'] = $state;
                }
            }
        }

      $this->command->info($count.' registers - Cities table seeded!');
  }


  function get_state($id){
     $states = State::orderBy('name','asc')->pluck('name');
     return $states[$id-1];
  }


}
