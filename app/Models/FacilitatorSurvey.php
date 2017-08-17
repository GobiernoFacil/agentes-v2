<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FacilitatorSurvey;
use Excel;
class FacilitatorSurvey extends Model
{
    //
    public $table = 'survey_facilitators';

protected $fillable = [
    'user_id',
    'session_id',
    'facilitator_id',
    'fa_1',
    'fa_2',
    'fa_3',
    'fa_4',
    'fa_5',
    'fa_6',
    'fa_7',
    'fa_8',
    'fa_9',
  ];

  function facilitator(){
    return $this->belongsTo("App\User",'facilitator_id');
  }

  function session(){
    return $this->belongsTo("App\Models\ModuleSession");
  }

  function store_answers_survey_sessions($session_id,$facilitator_id,$module_id){
    $index   = ['fa_1','fa_2','fa_3','fa_4','fa_5','fa_6', 'fa_9'];
    $options = ['0','1','2','3','4','5','6','7','8','9','10'];
    $headers = ["options","values"];
    $surveys = FacilitatorSurvey::where('session_id',$session_id)->where('facilitator_id',$facilitator_id)->get();
    if($surveys->count() > 0){
      foreach ($index as $i) {
        $values = [];
        foreach ($options as $option) {
          $count = FacilitatorSurvey::where($i,$option)->where('session_id',$session_id)->where('facilitator_id',$facilitator_id)->count();
          $values[$option]=$count;
        }
        Excel::create("mo_".$module_id."_sess_".$session_id."_fac_".$facilitator_id."_".$i, function($excel)use($facilitator_id,$i,$options,$values,$headers) {
          // Set the title
          $excel->setTitle('Resultados de pregunta '.$i);
          // Chain the setters
          $excel->setCreator('Gobierno Fácil')
                ->setCompany('Gobierno Fácil');
          // Call them separately
          $excel->setDescription('Resultado facilitador '.$facilitator_id);
          $excel->sheet('Resultados', function($sheet)use($options,$values,$headers){
            $sheet->row(1, $headers);
            $sheet->row(1, function($row) {
              $row->setBackground('#000000');
              $row->setFontColor('#ffffff');
            });
            foreach ($options as $option) {
              $arr = [$option,$values[$option]];
              $sheet->appendRow($arr);
            }
          });
        })->store('xlsx','csv/survey_fac_results');
      }
    }
  }

}
