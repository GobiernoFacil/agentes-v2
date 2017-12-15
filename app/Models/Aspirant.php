<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\MassiveEmail;
class Aspirant extends Model
{
  use Notifiable;
    //
    protected $fillable = [
        'name', 'surname', 'lastname','email','city','state','degree','origin','gender','notice_id'
    ];

    //modelos relacionados
  function AspirantsFile(){
    return $this->hasOne("App\Models\AspirantsFile");
  }

  function AspirantEvaluation(){
    return $this->hasMany("App\Models\AspirantEvaluation");
  }

  function code(){
    return $this->hasOne("App\Models\AspirantActivation");
  }

  public function sendEmail($token)
  {
      $this->notify(new MassiveEmail($token));
  }


}
