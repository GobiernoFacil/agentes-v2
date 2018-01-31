<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //
    protected $fillable = [
      'notice_id',
      'title',
      'description',
      'slug',
      'start',
      'end',
      'public'
    ];


    function modules(){
      return $this->hasMany("App\Models\Module")->orderBy('order','asc');
    }

    function notice(){
      return $this->hasOne("App\Models\NoticeProgram");
    }
}
