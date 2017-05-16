<?php

use Illuminate\Database\Seeder;
use App\Models\Forum;
use App\User;
class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $states = ["Morelos","Sonora","Nuevo León","Oaxaca","Chihuahua"];
        $user   = User::where('institution','Gobierno Fácil')->first();
        foreach($states as $state){
          $forum = new Forum();
          $forum->state_name = $state;
          $forum->user_id    = $user->id;
          $name = "Foro del estado de ". $state;
          $forum->topic      = $name;
          $forum->slug       = str_slug($name);
          $forum->description = "En este foro prodrás comunicarte con personas de tu mismo estado.";
          $forum->save();
        }
        $this->command->info('forums created!');
    }
}
