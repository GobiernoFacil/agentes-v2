<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AspirantInstitution extends Model
{
    //
    public $table = 'aspirants_institutions';
    protected $fillable = [
    'aspirant_id',
    'notice_id',
    'institution'
  ];

    //modelos relacionados
    function aspirants(){
      return $this->hasMany("App\Models\Aspirant");
    }

    function notice(){
      return $this->hasOne("App\Models\Notice");
    }
}
