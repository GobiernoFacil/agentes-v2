<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
require_once base_path().'/vendor/amenadiel/jpgraph/src/includes/jpgraph.php';
use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;
use Amenadiel\JpGraph\Themes;
use Excel;
use File;
use App\Models\FacilitatorModule;
use App\Models\Module;
use App\User;
class CreateFacGraphs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-fac-graphs';

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
        $path_facilitator = base_path().'/csv/survey_fac_results';
        $index_facilitator = [
        'fa_1',
        'fa_2',
        'fa_3',
        'fa_4',
        'fa_5',
        'fa_6',
        'fa_7',
        'fa_8',
        'fa_9'];
        //encuestas
        $module_survey  = Module::where('title','CURSO 1 - Gobierno Abierto y los ODS')->first();
        $non_email_list = ['contacto@prosociedad.org'];
        $non_user_sur   = User::whereIn('email',$non_email_list)->pluck('id');
        $facilitators   = FacilitatorModule::where('module_id',$module_survey->id)->whereNotIn('user_id',$non_user_sur->toArray())->get();
        if($facilitators->count() > 0){
          foreach($facilitators as $facilitator){
                    foreach ($index_facilitator as $index) {
                      $path_file = $path_facilitator.'/mo_'.$facilitator->session->module->id.'_sess_'.$facilitator->session->id.'_fac_'.$facilitator->user->id.'_'.$index.'.csv';
                      $image_path = base_path().'/csv/survey_images_facilitator/mo_'.$facilitator->session->module->id.'_sess_'.$facilitator->session->id.'_fac_'.$facilitator->user->id.'_'.$index.'.jpg';
                      if(File::exists($image_path)){
                        File::delete($image_path);
                      }
                      echo($index.'
                      ');
                      if(file_exists($path_file)){
                        Excel::load($path_file, function($reader) use($index,$image_path){
                          $values  = [];
                          $options = [];
                          $results = $reader->get(array('options', 'values'));
                          foreach($results as $result){
                              $options[] = $result->options;
                              $values[] = $result->values;
                          }
                            // Create the graph. These two calls are always required
                            $graph = new Graph\Graph(1000,500,'auto');
                            $graph->SetScale("textlin");

                            $theme_class=new Themes\UniversalTheme;
                            $graph->SetTheme($theme_class);

                            $graph->yaxis->SetTickPositions($values);
                            $graph->SetBox(false);

                            $graph->ygrid->SetFill(false);
                            $graph->xaxis->SetTickLabels($options);
                            $graph->yaxis->HideLine(false);
                            $graph->yaxis->HideTicks(false,false);

                            // Create the bar plots
                            $b1plot = new Plot\BarPlot($values);

                            // Create the grouped bar plot
                            $gbplot = new Plot\GroupBarPlot(array($b1plot));
                            // ...and add it to the graPH
                            $graph->Add($gbplot);


                            $b1plot->SetColor("white");
                            $b1plot->SetFillColor("#187fad");
                            $b1plot->value->Show();
                            $b1plot->value->SetColor("black","darkred");
                            $b1plot->value->HideZero();
                            $b1plot->value->SetFormat('%01.1f');
                            $graph->Stroke($image_path);



                        })->first();
                      }else{
                        echo('No file
                        ');
                      }
                    }
      }
    }
    }
}
