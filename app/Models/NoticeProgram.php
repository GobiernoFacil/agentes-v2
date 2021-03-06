<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticeProgram extends Model
{
    //

    public $table = 'notice_programs';
    protected $fillable = [
    'notice_id',
    'program_id',
    ];

    function notice_data(){
      return $this->belongsTo("App\Models\Notice",'notice_id');
    }
}
