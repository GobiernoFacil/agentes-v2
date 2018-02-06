<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AspirantNotice extends Model
{
    //
    public $table = 'aspirant_notices';
    protected $fillable = [
        'aspirant_id', 'notice_id',
    ];

    //modelos relacionados
    function aspirant(){
      return $this->belongsTo("App\Models\Aspirant");
    }

    function notice(){
    	return $this->belongsTo("App\Models\Notice");
    }
}
