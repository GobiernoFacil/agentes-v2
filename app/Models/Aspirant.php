<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\MassiveEmail;
use App\Models\AspirantInstitution;
use App\User;

class Aspirant extends Model
{
  use Notifiable;
    //
    protected $fillable = [
        'name', 'surname', 'lastname','email','city','state','degree','origin','gender'
    ];

    //modelos relacionados
  function AspirantsFile(){
    return $this->hasOne("App\Models\AspirantsFile");
  }

  function notices(){
    return $this->hasMany("App\Models\AspirantNotice")->orderBy('created_at','asc');;
  }

  function notice(){
    return $this->hasOne("App\Models\AspirantNotice");
  }

  function AspirantEvaluation(){
    return $this->hasMany("App\Models\AspirantEvaluation");
  }

  function AspirantInterviews(){
    return $this->hasMany("App\Models\AspirantInterview",'aspirant_id');
  }

  function check_address_proof(){
    return $this->AspirantEvaluation()->where('address_proof','!=',null);
  }

  function code(){
    return $this->hasOne("App\Models\AspirantActivation");
  }

  public function sendEmail($token)
  {
      $this->notify(new MassiveEmail($token));
  }

  function cv(){
    return $this->hasOne("App\Models\Cv");
  }

  function global_grade(){
    return $this->hasOne("App\Models\AspirantGlobalGrade");
  }

  function global_interview_grade(){
    return $this->hasOne("App\Models\InterviewGlobalScore");
  }

  function has_proof_evaluated($notice){
    return AspirantEvaluation::where('address_proof','!=',null)->where('notice_id',$notice->id)->where('aspirant_id',$this->id)->first();
  }


  function check_aplication_data(){
    if($this->AspirantsFile){
      if($this->AspirantsFile->video && $this->AspirantsFile->proof && $this->AspirantsFile->privacy_policies && $this->AspirantsFile->motives){
        if($this->cv){
            if($this->cv->experiences()->count()>0 && $this->cv->academic_trainings()->count()>0){
              return true;
            }else{
              return false;
            }
        }else{
          return false;
        }

      }else{
        return false;
      }

    }else{
      return false;
    }
  }

  function verifyInstitution($institution,$notice){
    return AspirantInstitution::where('institution',$institution)->where('aspirant_id',$this->id)->where('notice_id',$notice->id)->first();
  }

  function verifyInstitutionInterview($institution,$notice){
    return Interview::where('institution',$institution)->where('aspirant_id',$this->id)->where('notice_id',$notice->id)->first();
  }

  function verifyGrade($institution,$notice){
    return AspirantInterview::where('institution',$institution)->where('aspirant_id',$this->id)->where('notice_id',$notice->id)->whereNotNull('score')->first();
  }



  function user(){
    return User::where('email',$this->email)->first();
  }




}
