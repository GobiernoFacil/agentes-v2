<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MyResetPassword;
use App\Models\FellowAnswer;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type','enabled','institution'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }

    function modules(){
      return $this->hasMany("App\Models\FacilitatorModule")->orderBy('order','asc');
    }

    function facilitatorSessions(){
      return $this->hasMany("App\Models\FacilitatorModule");
    }
    function conversation(){
      return $this->hasMany("App\Models\Conversation");
    }
    function facilitatorData(){
      return $this->hasOne("App\Models\FacilitatorData");
    }
    function image(){
      return $this->hasOne("App\Models\Image");
    }

    function fellowData(){
      return $this->hasOne("App\Models\FellowData");
    }

    function log(){
      return $this->hasMany("App\Models\Log");
    }

    function conversations(){
      return $this->hasMany("App\Models\Conversation");
    }

    function store_conversations(){
      return $this->hasMany("App\Models\StoreConversation");
    }

    function diagnostic(){
      return $this->hasOne("App\Models\DiagnosticAnswer");
    }

    function diagnosticEvaluation(){
      return $this->hasOne("App\Models\DiagnosticEvaluation");
    }

    function fellowFiles(){
      return $this->hasMany("App\Models\FellowFile");
    }

    function fellowAnswers(){
      return $this->hasMany("App\Models\FellowAnswer");
    }

    function fellowScore(){
      return $this->hasMany("App\Models\FellowScore");
    }

    function fileScore(){
      return $this->hasMany("App\Models\FilesEvaluation",'fellow_id');
    }

    function fellowAnswer($question_id,$user_id){
      $answer = fellowAnswer::where('question_id',$question_id)->where('user_id',$user_id)->first();
      return $answer ;
    }

}
