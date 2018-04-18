<?php

use Illuminate\Database\Seeder;
use App\Models\Activity;
class ChangeTableActivities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //
      $activities = Activity::all();
      foreach ($activities as $activity) {

        $this->command->info($activity->name);
          if($activity->files === 'No'){
             $activity->files = 0;
          }elseif($activity->files === 'Sí'){
             $activity->files = 1;
          }

          if($activity->hasfiles === 'No'){
             $activity->hasfiles = 0;
          }elseif($activity->hasfiles === 'Sí'){
             $activity->hasfiles = 1;
          }


          if($activity->hasforum === 'No'){
             $activity->hasforum = 0;
          }elseif($activity->hasforum === 'Sí'){
             $activity->hasforum = 1;
          }

          $activity->save();
          $this->command->info($activity->name);
      }

    }
}
