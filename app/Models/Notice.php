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
       $aspirants               = $this->aspirants->pluck('aspirant_id')->toArray();
       $aspirants_id            = AspirantsFile::whereNull('proof')->whereIn('aspirant_id',$aspirants)->pluck('aspirant_id')->toArray();
       $all_aspirants_files_ids = AspirantsFile::where('notice_id',$this->id)->pluck('aspirant_id')->toArray();
       if($all_aspirants_files_ids){
         $aspirants = array_diff($aspirants,$all_aspirants_files_ids);
       }
       if($aspirants_id){
         $aspirants = array_merge($aspirants,$aspirants_id);
       }

       return Aspirant::whereIn('id',$aspirants);
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
      return Aspirant::whereIn('id',$all_ids);
    }

    function aspirants_rejected_proof(){
      $aspirants_id = AspirantEvaluation::where('address_proof',0)->where('notice_id',$this->id)->pluck('aspirant_id')->toArray();
      return Aspirant::whereIn('id',$aspirants_id);
    }

    function all_aspirants_data(){
      $aspirants = $this->aspirants->pluck('aspirant_id')->toArray();
      return Aspirant::whereIn('id',$aspirants);
    }

    function aspirants_already_evaluated(){
      $aspirants_id = AspirantEvaluation::whereNotNull('address_proof')->where('notice_id',$this->id)->pluck('aspirant_id')->toArray();
      return Aspirant::whereIn('id',$aspirants_id);
    }

    function aspirants_approved_proof(){
      $aspirants_id = AspirantEvaluation::where('address_proof',1)->where('notice_id',$this->id)->pluck('aspirant_id')->toArray();
      return Aspirant::whereIn('id',$aspirants_id);
    }

    function aspirants_per_institution_to_evaluate(){
      $user      = Auth::user();
      $aspirants = $this->aspirant_institution()->where('institution',$user->institution)->pluck('aspirant_id')->toArray();
      return Aspirant::whereIn('id',$aspirants);
    }
}
