<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Forum;
use App\Models\ForumMessage;
use App\Models\ModuleSession;
// FormValidators
use App\Http\Requests\SaveForum;
use App\Http\Requests\UpdateActivity;
class Forums extends Controller
{
    //
    //Paginación
    public $pageSize = 10;

    /**
     * Muestra lista de foros por sesión
     *
     * @return \Illuminate\Http\Response
     */
    public function index($module_slug,$session_slug)
    {
      $user     = Auth::user();
      $session  = ModuleSession::where('slug',$session_slug)->firstOrFail();
      $forums   = Forum::where('session_id',$session->id)->orderBy('created_at','desc')->paginate($this->pageSize);
      return view('fellow.modules.sessions.forums.forums-list')->with([
        "user"      => $user,
        "forums" => $forums,
        "session" => $session
      ]);

    }

    /**
     * Agregar actividad
     *
     * @return \Illuminate\Http\Response
     */
    public function add($module_slug,$session_slug)
    {
        //
        $user      = Auth::user();
        $session   = ModuleSession::where('slug',$session_slug)->firstOrFail();
        return view('fellow.modules.sessions.forums.forums-add')->with([
          "user"      => $user,
          "session" => $session
        ]);
    }

    /**
     * Guarda nuevo foro
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(SaveForum $request)
    {
      $user      = Auth::user();
      $session   = ModuleSession::where('slug',$request->session_slug)->firstOrFail();
      $forum     = new Forum($request->only(['topic','description']));
      $forum->user_id = $user->id;
      $forum->session_id = $session->id;
      $forum->slug    = str_slug($request->topic);
      $forum->save();
      return redirect("tablero/foros/{$session->module->slug}/{$session->slug}")->with('message','Foro creado correctamente');
    }


}
