<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\AspirantEvaluation;
use Auth;
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
    'slug'
    ];

    function files(){
      return $this->hasMany("App\Models\NoticeFile");
    }

    function get_last_notice(){
      $today  = date('Y-m-d');
      $notice = $this::where('start','<=',$today)->where('end','>=',$today)->where('public',1)->first();
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

    function aspirants_without_proof(){
       $aspirants_id            = AspirantsFile::where('notice_id',$this->id)->whereNull('proof')->pluck('aspirant_id')->toArray();
       $aspirants_without_pr    = AspirantsFile::where('notice_id',$this->id)->whereNull('privacy_policies')->
       orWhere(function($query){
         $query->where('privacy_policies',0)->where('notice_id',$this->id)->get();
       })->pluck('aspirant_id')->toArray();
       if($aspirants_id && $aspirants_without_pr){
         $aspirants = array_unique(array_merge($aspirants_id,$aspirants_without_pr));
       }elseif($aspirants_id){
         $aspirants = $aspirants_id;
       }elseif($aspirants_without_pr){
         $aspirants = $aspirants_without_pr;
       }else{
         $aspirants = [];
       }

       return Aspirant::where('is_activated',1)->whereIn('id',$aspirants);
    }

    function aspirants_without_proof_evaluation(){
      $aspirants_id = AspirantEvaluation::whereNotNull('address_proof')->where('notice_id',$this->id)->pluck('aspirant_id')->toArray();
      $aWp_ids      = $this->aspirants_without_proof()->pluck('id')->toArray();
      $all_ids      = $this->all_aspirants_data()->pluck('id')->toArray();

      if($aspirants_id){
        $all_ids = array_diff($all_ids,$aspirants_id);
      }
      if($aWp_ids){
        $all_ids = array_diff($all_ids,$aWp_ids);
      }
      var_dump($all_ids);
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
      $aspirant_already   = $this->aspirants_app_already_evaluated()->pluck('id')->toArray();
      $aspirants = $this->aspirant_institution()->where('institution',$user->institution)->whereNotIn('aspirant_id',$aspirant_already)->pluck('aspirant_id')->toArray();
      return Aspirant::where('is_activated',1)->whereIn('id',$aspirants);
    }

    function aspirants_app_already_evaluated(){
      $aspirants = $this->aspirants_approved_proof()->pluck('id')->toArray();
      $aspirants = AspirantEvaluation::whereNotNull('grade')->whereIn('aspirant_id',$aspirants)->pluck('aspirant_id')->toArray();
      return Aspirant::where('is_activated',1)->whereIn('id',$aspirants);
    }

    function aspirants_per_institution_evaluated(){
      $user      = Auth::user();
      $aspirants = $this->aspirants_approved_proof()->pluck('id')->toArray();
      $aspirants = AspirantEvaluation::whereNotNull('grade')->whereIn('aspirant_id',$aspirants)->where('institution',$user->institution)->pluck('aspirant_id')->toArray();
      return Aspirant::where('is_activated',1)->whereIn('id',$aspirants);
    }
}
