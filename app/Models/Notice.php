<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\AspirantEvaluation;
use Auth;
use App\User;
use DB;
class Notice extends Model
{
    //
    protected $fillable = [
    'title',
    'description',
    'objective',
    'modality_results',
    'profile',
    'profile_eligibility_general',
    'profile_eligibility_particular',
    'profile_eligibility_description',
    'term_process',
    'unforeseen_cases',
    'contact',
    'start',
    'end',
    'public',
    'slug',
    'allow_upload'
    ];

    function program(){
      return $this->hasOne("App\Models\Program",'notice_id');
    }

    function files(){
      return $this->hasMany("App\Models\NoticeFile");
    }

    function get_last_notice(){
      $today  = date('Y-m-d');
      $notice = $this::where('start','<=',$today)->where('end','>=',$today)->where('public',1)->first();
      return $notice;

    }

    function get_closed(){
      $today  = date('Y-m-d');
      $notice = $this::where('end','<',$today)->where('public',1)->get();
      return $notice;

    }

    function files_front(){
      $files  = NoticeFile::where('notice_id',$this->id)->limit(2)->get();
      return $files;
    }

    function aspirant_institution(){
      return $this->hasMany("App\Models\AspirantInstitution",'notice_id');
    }

    //aspirantes que tienen validacion de correo, solo id's
    function aspirants(){

      return $this->hasMany("App\Models\AspirantNotice",'notice_id');

    }

    function aspirants_without_data(){
       $aspirants    =  $this->all_aspirants_data()->pluck('id');
       $with_all     =  $this->get_aspirants_with_full_data()->pluck('id');
       if($with_all){
         $aspirants = array_diff($aspirants->toArray(),$with_all->toArray());
       }

       return Aspirant::where('is_activated',1)->whereIn('id',$aspirants);
    }

    function aspirants_without_proof_evaluation(){
      $aspirants_id = AspirantEvaluation::whereNotNull('address_proof')->where('notice_id',$this->id)->pluck('aspirant_id')->toArray();
      $all_ids      = $this->get_aspirants_with_full_data()->pluck('id')->toArray();
      if($aspirants_id){
        $all_ids = array_diff($all_ids,$aspirants_id);
      }

      return Aspirant::where('is_activated',1)->whereIn('id',$all_ids);
    }

    function aspirants_rejected_proof(){
      $aspirants_id = AspirantEvaluation::where('address_proof',0)->where('notice_id',$this->id)->pluck('aspirant_id')->toArray();
      return Aspirant::where('is_activated',1)->whereIn('id',$aspirants_id);
    }

    function all_aspirants_data(){
      $aspirants = $this->aspirants->pluck('aspirant_id')->toArray();
      return Aspirant::where('is_activated',1)->whereIn('id',$aspirants);
    }

    function aspirants_already_evaluated_by_state($state){
      $aspirants = AspirantEvaluation::whereNotNull('address_proof')->where('notice_id',$this->id)->pluck('aspirant_id')->toArray();
      return Aspirant::where('state',$state)->where('is_activated',1)->whereIn('id',$aspirants);
    }

    function aspirants_already_evaluated(){
      $aspirants_id = AspirantEvaluation::whereNotNull('address_proof')->where('notice_id',$this->id)->pluck('aspirant_id')->toArray();
      return Aspirant::where('is_activated',1)->whereIn('id',$aspirants_id);
    }

    function aspirants_approved_proof(){
      $aspirants_id = AspirantEvaluation::where('address_proof',1)->where('notice_id',$this->id)->pluck('aspirant_id')->toArray();
      return Aspirant::where('is_activated',1)->whereIn('id',$aspirants_id);
    }

    function aspirants_per_institution_to_evaluate(){
      $user      = Auth::user();
      $aspirant_already   = $this->aspirants_app_already_evaluated_by_institution($user->institution)->pluck('id')->toArray();
      $aspirants = $this->aspirant_institution()->where('institution',$user->institution)->whereNotIn('aspirant_id',$aspirant_already)->pluck('aspirant_id')->toArray();
      return Aspirant::where('is_activated',1)->whereIn('id',$aspirants);
    }

    function aspirants_app_already_evaluated(){
      $aspirants = $this->aspirants_approved_proof()->pluck('id')->toArray();
      $aspirants = AspirantGlobalGrade::where('notice_id',$this->id)->whereIn('aspirant_id',$aspirants)->orderBy('grade','desc')->pluck('aspirant_id')->toArray();
      $im_aspi   = implode(',', $aspirants);
      if($im_aspi != ''){
        return Aspirant::where('is_activated',1)->whereIn('id',$aspirants)->orderByRaw(DB::raw("FIELD(id, $im_aspi)"));
      }else{
        return Aspirant::where('is_activated',1)->whereIn('id',$aspirants);
      }


    }


    function aspirants_app_already_evaluated_by_institution($institution){
      $aspirants = $this->aspirants_approved_proof()->pluck('id')->toArray();
      $aspirants = AspirantEvaluation::where('institution',$institution)->whereNotNull('grade')->whereIn('aspirant_id',$aspirants)->orderBy('grade','desc')->pluck('aspirant_id')->toArray();
      $im_aspi   = implode(',', $aspirants);
      if($im_aspi != ''){
        return Aspirant::where('is_activated',1)->whereIn('id',$aspirants)->orderByRaw(DB::raw("FIELD(id, $im_aspi)"));
      }else{
        return Aspirant::where('is_activated',1)->whereIn('id',$aspirants);
      }


    }

    function aspirants_app_already_evaluated_by_state($state){
      $aspirants = $this->aspirants_approved_proof()->pluck('id')->toArray();
      $aspirants = AspirantEvaluation::whereNotNull('grade')->whereIn('aspirant_id',$aspirants)->orderBy('grade','desc')->pluck('aspirant_id')->toArray();
      $im_aspi   = implode(',', $aspirants);
      if($im_aspi != ''){
              return Aspirant::where('state',$state)->where('is_activated',1)->whereIn('id',$aspirants)->orderByRaw(DB::raw("FIELD(id, $im_aspi)"));
      }else{
            return Aspirant::where('state',$state)->where('is_activated',1)->whereIn('id',$aspirants);
      }

    }

    function aspirants_per_institution_evaluated(){
      $user      = Auth::user();
      $aspirants = $this->aspirants_approved_proof()->pluck('id')->toArray();
      $aspirants = AspirantEvaluation::whereNotNull('grade')->whereIn('aspirant_id',$aspirants)->where('institution',$user->institution)->orderBy('grade','desc')->pluck('aspirant_id')->toArray();
      $im_aspi   = implode(',', $aspirants);
      if($im_aspi != ''){
        return Aspirant::where('is_activated',1)->whereIn('id',$aspirants)->orderByRaw(DB::raw("FIELD(id, $im_aspi)"));
      }else{
        return Aspirant::where('is_activated',1)->whereIn('id',$aspirants);
      }
    }

    function get_aspirants_with_full_data(){
      $aspirants  = $this->all_aspirants_data()->get();
      $temp_array = [];
      foreach ($aspirants as $aspirant) {
        if($aspirant->AspirantsFile){
          if($aspirant->AspirantsFile->video && $aspirant->AspirantsFile->proof && $aspirant->AspirantsFile->privacy_policies && $aspirant->AspirantsFile->motives){
            if($aspirant->cv){
               if($aspirant->cv->experiences()->count()>0 && $aspirant->cv->academic_trainings()->count()>0){
                 array_push($temp_array,$aspirant->id);
               }
            }
          }
        }
      }
      return Aspirant::where('is_activated',1)->whereIn('id',$temp_array);
    }


}
