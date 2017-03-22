<?php

use Illuminate\Database\Seeder;
use App\Models\Institution;
class InstitutionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      // Limpia tabla de instituciones
      Institution::truncate();
      // Crea las instituciones
        $institution = new Institution();
        $institution->name     =  'Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales';
        $institution->save();
        $institution = new Institution();
        $institution->name     =  'Gestión Social Y Cooperación';
        $institution->save();
        $institution = new Institution();
        $institution->name     =  'Gobierno Fácil';
        $institution->save();
        $institution = new Institution();
        $institution->name     =  'Programa de las Naciones Unidas para el Desarrollo';
        $institution->save();
        $institution = new Institution();
        $institution->name     =  'PROSOCIEDAD';
        $institution->save();
        $this->command->info('institutions created!');
    }
    
}
