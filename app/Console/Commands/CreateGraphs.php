<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
require_once base_path().'/vendor/amenadiel/jpgraph/src/includes/jpgraph.php';
use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;
use Amenadiel\JpGraph\Themes;
use Excel;
use File;
use PDF;
use App\Models\FellowSurvey;
use App\Jobs\CreatePDFSurveyReport;
class CreateGraphs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-graphs';

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
       //paths
        $path_fellow      = base_path().'/csv/survey_fellow_results';
        $index_fellows = [
                      'sur_1',
                      'sur_2',
                      'sur_3_1',
                      'sur_3_2',
                      'sur_3_3',
                      'sur_3_4',
                      'sur_3_5',
                      'sur_4',
                      'sur_5_1',
                      'sur_5_2',
                      'sur_5_3',
                      'sur_5_4',
                      'sur_6_1',
                      'sur_6_2',
                      'sur_6_3',
                      'sur_7_1',
                      'sur_7_2',
                      'sur_7_3',
                      'sur_8',
                      'sur_9',
                      'sur_10',
                      'sur_11',
                      'sur_13_1',
                      'sur_13_2',
                      'sur_13_3',
                      'sur_13_4',
                      'sur_14_1',
                      'sur_14_2',
                      'sur_14_3',
                      'sur_14_4',
                      'sur_15_1',
                      'sur_15_2',
                      'sur_15_3',
                      'sur_15_4',
                      'sur_16_1',
                      'sur_16_2',
                      'sur_16_3',
                      'sur_16_4',
                    ];
          foreach ($index_fellows as $index) {
            $path_file = $path_fellow.'/su_'.$index.'.csv';
            $image_path = base_path().'/csv/survey_images_fellow/su_'.$index.'.jpg';
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
                  $graph = new Graph\Graph(800,300,'auto');
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
            }
          }
          $all             = FellowSurvey::orderBy('created_at','desc')->get();
          $name            = 'encuesta_satisfaccion.pdf';
          $path            = base_path().'/csv/reports/'.$name;
          $pdf             = PDF::loadView('admin.indicators.pdf.fellow-survey-template', compact(['all']))->setPaper('a4', 'landscape')->save($path);
    }

}
