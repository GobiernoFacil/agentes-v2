<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
    'public'
    ];

    function files(){
      return $this->hasMany("App\Models\NoticeFile");
    }

    function get_last_notice(){
      $today  = date('Y-m-d');
      $notice = $this::where('start','<=',$today)->where('end','>=',$today)->first();
      return $notice;

    }

    function files_front(){
      $files  = NoticeFile::where('notice_id',$this->id)->limit(2)->get();
      return $files;
    }
}
