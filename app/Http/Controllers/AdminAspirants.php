<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Notice;
use App\Models\Aspirant;
class AdminAspirants extends Controller
{
    //

    /**
     * Muestra lista de convocatorias para acceder a sus aspirantes
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user    = Auth::user();
        $notices = Notice::orderBy('start','desc')->get();
        return view('admin.aspirants.notices-list')->with([
          'user'    => $user,
          'notices' => $notices
        ]);
    }

    /**
     * Muestra aspirantes de convocatoria
     *
     * @return \Illuminate\Http\Response
     */
    public function aspirantList($notice_id)
    {
        //
        $user    = Auth::user();
        $notice  = Notice::where('id',$notice_id)->firstOrFail();
        $aspirants_ids = $notice->aspirants()->pluck('aspirant_id');
        $aspirants = Aspirant::whereIn('id',$aspirants_ids->toArray())->paginate();
        return view('admin.aspirants.aspirant-list')->with([
            'user'      => $user,
            'notice'    => $notice,
            'aspirants' => $aspirants
          ]);
    }
}
