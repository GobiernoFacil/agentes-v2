<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Excel;
class FellowSurvey extends Model
{
    //
    public $table = 'survey_satisfaction';
    protected $fillable = [
      'user_id',
      'sur_1',
      'sur_j1',
      'sur_2',
      'sur_j2',
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
      'sur_j8',
      'sur_9',
      'sur_j9',
      'sur_10',
      'sur_j10',
      'sur_11',
      'sur_j12',
      'sur_13_1',
      'sur_13_2',
      'sur_13_3',
      'sur_13_4',
      'sur_13_5',
      'sur_14_1',
      'sur_14_2',
      'sur_14_3',
      'sur_14_4',
      'sur_14_5',
      'sur_15_1',
      'sur_15_2',
      'sur_15_3',
      'sur_15_4',
      'sur_15_5',
      'sur_16_1',
      'sur_16_2',
      'sur_16_3',
      'sur_16_4',
      'sur_16_5',
    ];

    function user(){
      return $this->belongsTo("App\User");
    }

    function store_answers_survey($survey){
        $path = base_path();
        $index = [
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
                      'sur_13_5',
                      'sur_14_1',
                      'sur_14_2',
                      'sur_14_3',
                      'sur_14_4',
                      'sur_14_5',
                      'sur_15_1',
                      'sur_15_2',
                      'sur_15_3',
                      'sur_15_4',
                      'sur_15_5',
                      'sur_16_1',
                      'sur_16_2',
                      'sur_16_3',
                      'sur_16_4',
                      'sur_16_5',
                    ];
          $options = ['0','1','2','3','4','5','6','7','8','9','10'];
          $headers = ["options","values"];
          foreach ($index as $i) {
            $values = [];
            foreach ($options as $option) {
              if($i !== 'sur_6_1' && $i !== 'sur_6_2' && $i !== 'sur_6_3' && $i !== 'sur_7_1' && $i !== 'sur_7_2' && $i !== 'sur_7_3' && $i !== 'sur_8'){
                $count = FellowSurvey::where($i,$option)->count();
                $values[$option]=$count;
              }elseif($i === 'sur_6_1' || $i === 'sur_6_2'|| $i === 'sur_6_3'|| $i === 'sur_7_1' || $i === 'sur_7_2' || $i === 'sur_7_3') {

                if($option === '1' || $option ==='2' || $option ==='3' ){
                  $count = FellowSurvey::where($i,$option)->count();
                  $values[$option]=$count;
                }
              }else{

                         if($option === '0' || $option ==='1'){
                            $count = FellowSurvey::where($i,$option)->count();
                            $values[$option]=$count;
                          }
              }
            }
            Excel::create("su_".$i, function($excel)use($i,$options,$values,$headers) {
              // Set the title
              $excel->setTitle('Resultados de pregunta '.$i);
              // Chain the setters
              $excel->setCreator('Gobierno Fácil')
                    ->setCompany('Gobierno Fácil');
              // Call them separately
              $excel->setDescription('Resultado encuesta satisfacción');
              $excel->sheet('Resultados', function($sheet)use($options,$values,$headers,$i){
                $sheet->row(1, $headers);
                $sheet->row(1, function($row) {
                  $row->setBackground('#000000');
                  $row->setFontColor('#ffffff');
                });
                foreach ($options as $option) {

                    if($i !== 'sur_6_1' && $i !== 'sur_6_2'&& $i !== 'sur_6_3'&& $i !== 'sur_7_1' && $i !== 'sur_7_2' && $i !== 'sur_7_3' && $i !== 'sur_8'){
                       $arr = [$option,$values[$option]];
                       $sheet->appendRow($arr);
                    }elseif($i === 'sur_6_1' || $i === 'sur_6_2'|| $i === 'sur_6_3'|| $i === 'sur_7_1' || $i === 'sur_7_2' || $i === 'sur_7_3') {
                      if($option === '1' || $option ==='2' || $option ==='3' ){
                         if($option === '1'){
                                      $arr = ['Mayor uso',$values[$option]];
                         }elseif($option==='2'){
                                      $arr = ['Medio',$values[$option]];
                         }else{
                                      $arr = ['Menor uso',$values[$option]];
                         }
                         $sheet->appendRow($arr);
                      }
                    }elseif($i === 'sur_8'){
                               if($option === '0' || $option ==='1'){
                                  if($option === '0'){
                                      $arr = ['No',$values[$option]];
                                    }else{
                                      $arr = ['Sí',$values[$option]];
                                    }
                                    $sheet->appendRow($arr);
                                }
                    }
                }
              });
            })->store('csv',$path.'/csv/survey_fellow_results');
      }
    }

}
