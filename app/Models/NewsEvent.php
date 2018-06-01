<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsEvent extends Model
{
    //
    public $table = 'news_events';
    protected $fillable = [
    'user_id',
    'title',
    'content',
    'start',
    'end',
    'slug',
    'time',
    'type',
    'public',
    'brief',
    'image_id',
    'program_id'
    ];

    function image(){
      return $this->hasOne("App\Models\ImagesNew",'newsEvents_id');
    }

    function user(){
      return $this->belongsTo("App\User");
    }
}
