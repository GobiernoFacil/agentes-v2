<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Interview;
use App\Models\Notice;
class AdminInterviews extends Controller
{
    //

    /**
     * Muestra lista de entrevistas
     *
     * @return \Illuminate\Http\Response
     */
    public function index($notice_id)
    {
        //
        //
        $user      = Auth::user();
        $notice    = Notice::where('id',$notice_id)->firstOrFail();
        $aspirants = $notice->all_aspirants_data()->get();
        $list      = $notice->aspirants_per_institution_to_interview()->paginate();
        $asToE_count = $notice->aspirants_per_institution_to_interview()->count();
        $aAe_count  = $notice->aspirants_inter_already_evaluated()->count();
        $aIaE_count = $notice->aspirants_inter_already_evaluated_by_institution($user->institution)->count();
        $type_list = 1;
        return view('admin.aspirants.interviews.aspirant-list-per-institution')->with([
          'user' =>$user,
          'notice' => $notice,
          'aspirants' =>$aspirants,
          'list' =>$list,
          'type_list' => $type_list,
          'asToE_count' => $asToE_count,
          'aAe_count'  =>$aAe_count,
          'aIaE_count' =>$aIaE_count
        ]);
    }


    /**
     * Muestra lista de entrevistas
     *
     * @return \Illuminate\Http\Response
     */
    public function add($notice_id,$aspirant_id)
    {
        //
        //
        $user          = Auth::user();
        $notice        = Notice::where('id',$notice_id)->firstOrFail();
        $interview     = Interview::where('notice_id',$notice->id)->where('institution',$user->institution)->where('aspirant_id',$aspirant_id)->firstOrFail();
        $questionnaire = $notice->interview_questionnaire;

        return view('admin.aspirants.interviews.aspirant-add-interview-evaluation')->with([
          'user' =>$user,
          'notice' => $notice,
          'interview' =>$interview,
          'questionnaire' =>$questionnaire
        ]);
    }
}
