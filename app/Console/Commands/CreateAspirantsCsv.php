<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Aspirant;
use App\Models\Notice;
use App\User;
use Excel;
class CreateAspirantsCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-aspirant-csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $notices  = Notice::where('public',1)->orderBy('start','asc')->get();
        $path = base_path().'/csv';
        $headers = ["Institución","Aspirante","Apellidos","Estado","Municipio"];
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

        if($notice){
          $aspirants_id = $notice->aspirants()->pluck('aspirant_id');
          $active  = Aspirant::where('is_activated',1)->whereIn('id',$aspirants_id->toArray())->get();
          $aspirant_allow_ids  = [];
          foreach ($active as $aspirant) {
            if($aspirant->check_aplication_data()){
                array_push($aspirant_allow_ids,$aspirant->id);
            }
          }
          if(sizeof($aspirant_allow_ids) > 0){
            $users_in  = User::select('institution')->where('type','admin')->where('enabled',1)->distinct('institution')->orderBy('institution','asc')->get();
            if($users_in->count() > 0 ){
              $max_number_to_assing = ceil(sizeof($aspirant_allow_ids)/$users_in->count());
              $institutions = $users_in->pluck('institution')->toArray();
              //ordena aleatoriamente a los aspirantes e instituciones
              shuffle($institutions);
              shuffle($aspirant_allow_ids);
              Excel::create("aspirants_proof", function($excel)use($institutions,$aspirant_allow_ids,$headers,$max_number_to_assing){
                // Set the title
                $excel->setTitle('Aspirantes con comprobante');
                // Chain the setters
                $excel->setCreator('Gobierno Fácil')
                      ->setCompany('Gobierno Fácil');
                // Call them separately
                $excel->setDescription('Aspirantes con comprobante de domicilio para evaluar');
                $excel->sheet('Aspirantes', function($sheet)use($institutions,$aspirant_allow_ids,$headers,$max_number_to_assing){
                  $sheet->setTitle('Aspirantes');
                  $sheet->row(1, $headers);
                  $sheet->row(1, function($row) {
                    $row->setBackground('#000000');
                    $row->setFontColor('#ffffff');
                  });
                  $single  = array_rand($institutions, 1);
                  $last_iteration = 0;
                      for ($i=0; $i < sizeof($institutions); $i++) {
                        $control = 1;
                        for ($j=0; $j < sizeof($aspirant_allow_ids) ; $j++) {
                          if($control > $max_number_to_assing || !isset($aspirant_allow_ids[$last_iteration])){
                            break;
                          }
                          $aspirant = Aspirant::where('id',$aspirant_allow_ids[$last_iteration])->first();
                          $sheet->appendRow([$institutions[$i],$aspirant->name,$aspirant->surname.' '.$aspirant->lastname,$aspirant->state,$aspirant->city]);
                          $control++;
                          $last_iteration++;

                        }

                    }
                });

              })->store('xlsx',$path);
            }
          }




        }else{
          $this->info('Sin convocatoria habilitada');
        }
    }
}
