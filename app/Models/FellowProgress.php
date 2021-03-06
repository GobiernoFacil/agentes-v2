<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FellowProgress extends Model
{
    //
    public $table = 'fellow_progress';
    protected $fillable = [
        'fellow_id', 'program_id','module_id','session_id','activity_id','status','type'
    ];

    function user(){
      return $this->belongsTo("App\User");
    }

    function program(){
      return $this->hasOne("App\Models\Program",'program_id');
    }

    function module(){
      return $this->hasOne("App\Models\Module",'module_id');
    }

    function session(){
      return $this->hasOne("App\Models\ModuleSession",'session_id');
    }

    function activity(){
      return $this->hasOne("App\Models\Activity",'activity_id');
    }
}
