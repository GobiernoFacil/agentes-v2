<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Activity;

class Quiz extends Controller
{
    //


    /**
     * Agregar cuestionario
     *
     * @return \Illuminate\Http\Response
     */
    public function add($activity_id)
    {
        //
        $user      = Auth::user();
        $activity   = Activity::where('id',$activity_id)->firstOrFail();
        return view('admin.modules.quiz.quiz-add')->with([
          "user"      => $user,
          "activity" => $activity
        ]);
    }
}
