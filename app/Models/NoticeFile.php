<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticeFile extends Model
{
    //
    protected $fillable = [
    'notice_id',
    'name',
    'path',
    'comments',
    ];

    function notice(){
      return $this->belongsTo("App\Models\Notice");
    }
}
