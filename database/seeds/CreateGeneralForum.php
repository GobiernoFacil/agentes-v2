<?php

use Illuminate\Database\Seeder;
use App\Models\Forum;
use App\User;
class CreateGeneralForum extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $states = ["General"];
        $user   = User::where('institution','Gobierno Fácil')->first();
        foreach($states as $state){
          $forum = new Forum();
          $forum->state_name = $state;
          $forum->user_id    = $user->id;
          $name = "Foro ". $state;
          $forum->topic      = $name;
          $forum->slug       = str_slug($name);
          $forum->description = "En este foro prodrás comunicarte con todos los usuarios de la plataforma.";
          $forum->save();
        }
        $this->command->info('forum created!');
    }
}
