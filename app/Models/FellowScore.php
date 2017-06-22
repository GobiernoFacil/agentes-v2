<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FellowScore extends Model
{
    //
    public $table = 'fellow_scores';
    protected $fillable = [
        'user_id', 'questionInfo_id','score'
    ];
    function user(){
      return $this->belongsTo("App\User");
    }

    function quizInfo(){
      return $this->belongsTo("App\Models\quizInfo",'questionInfo_id');
    }

}
