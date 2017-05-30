<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Forum;
use App\Models\FellowData;
use App\Models\ForumMessage;
use App\Models\ModuleSession;
// FormValidators
use App\Http\Requests\SaveForum;
use App\Http\Requests\SaveMessageForum;
class FacilitatorForums extends Controller
{
    //
    //Paginación
    public $pageSize = 10;

    /**
     * Muestra lista de foros general
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
      $user     = Auth::user();
      $forums   = Forum::orderBy('created_at','desc')->paginate($this->pageSize);
      return view('facilitator.forums.forums-all-list')->with([
        "user"      => $user,
        "forums" => $forums,
      ]);

    }
}
