<?php

use Illuminate\Database\Seeder;
use App\User;
class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Limpia tabla de usuarios
      User::truncate();
      // Crea el super admin principal. Si no se define en el .env, toma los valores de default
        $admin = new User();
        $admin->name     =  env('ADMIN_NAME', "Carlos");
        $admin->email    =  env('ADMIN_EMAIL', "carlos@gobiernofacil.com");
        $admin->password =  Hash::make(env('ADMIN_PASSWORD', "12345678Ab"));
        $admin->type     = "superAdmin";
        $admin->enabled  = 1;
        $admin->save();
      // Crea usuario admin para pruebas
        $admin = new User();
        $admin->name     =  env('ADMIN_NAME', "Arturo Córdova");
        $admin->email    =  env('ADMIN_EMAIL', "howdy@gobiernofacil.com");
        $admin->password =  Hash::make(env('ADMIN_PASSWORD', "12345678Ab"));
        $admin->type     = "admin";
        $admin->enabled  = 1;
        $admin->save();

      $this->command->info('users created!');
    }
}
