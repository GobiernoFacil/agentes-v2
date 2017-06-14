<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagesNew extends Model
{
    //

    public $table ="image_news";

    protected $fillable = [
      'newsEvents_id',
      'name',
      'type',
      'path',
      'size',
    ];

    function newsEvents(){
      return $this->belongsTo("App\Models\NewsEvent",'newsEvents_id');
    }
}
