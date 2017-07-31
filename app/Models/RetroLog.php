<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FilesEvaluation;
class RetroLog extends Model
{
    //
    protected $fillable = [
         'user_id','status','activity_id'
    ];

    function activity_score($activity_id,$fellow_id){
      $score = FilesEvaluation::where('fellow_id',$fellow_id)->where('activity_id',$activity_id)->first();
      return $score;
    }

    function activity(){
      return $this->belongsTo("App\Models\Activity");
    }

}
