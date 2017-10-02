<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FacilitatorSurvey;
use App\User;
class FacilitatorModule extends Model
{
    //
    protected $fillable = [
        'user_id', 'module_id','session_id'
    ];

    //modelos relacionados
    function user(){
      return $this->belongsTo("App\User");
    }

    //modelos relacionados
    function session(){
      return $this->belongsTo("App\Models\ModuleSession",'session_id');
    }

    function count_answers($session_id,$facilitator_id){
      return FacilitatorSurvey::where('session_id',$session_id)->where('facilitator_id',$facilitator_id)->count();

    }

    function get_perception($session_id,$facilitator_id){
      $index = [    'fa_1',
                    'fa_2',
                    'fa_3',
                    'fa_4',
                    'fa_5',
                    'fa_6',
                         ];
      $answers = FacilitatorSurvey::where('session_id',$session_id)->where('facilitator_id',$facilitator_id)->get();
          $average_total = 0;
          $count_positive = 0;
          foreach ($answers as $answer) {
            $temp_average = 0;
            foreach($index as $i){
                $temp_average = $temp_average + $answer->{$i};
            }
            $average_total = ($temp_average/6) + $average_total;
            if(($temp_average/6)>8){
              $count_positive = $count_positive+1;
            }
          }


          //average survey
          //var_dump($average_total/$answers->count());
          return round(($count_positive*100)/$answers->count()).'%';


    }



}
