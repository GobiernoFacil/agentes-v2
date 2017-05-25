<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\FellowData;
class FellowTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Crea fellow de prueba
          $fellow = new User();
          $fellow->name     =  "Andre";
          $fellow->email    =  "andre@fcb.com";
          $fellow->password =  Hash::make('andreesdelMadrid89');
          $fellow->type     =  "fellow";
          $fellow->enabled  = 1;
          $fellow->save();
          $fellowData = new FellowData();
          $fellowData->surname  = "Tavares";
          $fellowData->lastname = "Gomes";
          $fellowData->state    = "Morelos";
          $fellowData->city     = "Cuernavaca";
          $fellowData->degree   = "Maestro";
          $fellowData->origin   = "Gobierno";
          $fellowData->user_id  = $fellow->id;
          $fellowData->save();

          $this->command->info('fellow created!');



    }
}
