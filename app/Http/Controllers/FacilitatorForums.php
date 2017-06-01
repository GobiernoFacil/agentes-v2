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

    /**
    * Muestra foro
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function view($id)
    {
      //
      $user   = Auth::user();
      $forum  = Forum::where('id',$id)->firstOrFail();
      return view('facilitator.forums.forum-view')->with([
        "user"      => $user,
        "forum"    => $forum
      ]);
    }

    /**
     * Agregar mensaje a foro
     *
     * @return \Illuminate\Http\Response
     */
    public function addMessage($forum_slug)
    {
        //
        $user      = Auth::user();
        $forum   = Forum::where('slug',$forum_slug)->firstOrFail();
        return view('facilitator.forums.forum-add-message')->with([
          "user"      => $user,
          "forum" => $forum
        ]);
    }

    /**
     * Guarda nuevo mensaje en foro
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveMessage(SaveMessageForum $request)
    {
      $user      = Auth::user();
      $forum     = Forum::where('slug',$request->forum_slug)->firstOrFail();
      $message   = new ForumMessage($request->only(['message']));
      $message->user_id = $user->id;
      $message->forum_id = $forum->id;
      $message->save();
      return redirect("tablero-facilitador/foros/ver/{$forum->id}")->with('message','Mensaje creado correctamente');
    }

}
