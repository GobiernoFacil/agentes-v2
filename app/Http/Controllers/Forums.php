<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Forum;
use App\Models\FellowData;
use App\Models\ForumMessage;
use App\Models\ModuleSession;
use App\Models\ForumConversation;
// FormValidators
use App\Http\Requests\SaveForum;
use App\Http\Requests\SaveForumConversation;
use App\Http\Requests\SaveMessageForum;
class Forums extends Controller
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
      $forums   = Forum::where('state_name',$user->fellowData->state)->orWhere('state_name',null)->orderBy('created_at','desc')->paginate($this->pageSize);
      return view('fellow.modules.sessions.forums.forums-all-list')->with([
        "user"      => $user,
        "forums" => $forums,
      ]);

    }


    /**
     * Muestra lista de foros por sesión
     *
     * @return \Illuminate\Http\Response
     */
    public function index($module_slug,$session_slug)
    {
      $user     = Auth::user();
      $session  = ModuleSession::where('slug',$session_slug)->firstOrFail();
      $forum    = Forum::where('session_id',$session->id)->firstOrFail();
      $forums   = ForumConversation::where('forum_id',$forum->id)->orderBy('created_at','desc')->paginate($this->pageSize);
      return view('fellow.modules.sessions.forums.forums-list')->with([
        "user"      => $user,
        "forums" => $forums,
        "forum"  =>$forum,
        "session" => $session
      ]);

    }

    /**
    * Muestra foro
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function view($session_slug,$forum_slug)
    {
      //
      $user   = Auth::user();
      $forum  = Forum::where('slug',$forum_slug)->firstOrFail();
      return view('fellow.modules.sessions.forums.forum-view')->with([
        "user"      => $user,
        "forum"    => $forum
      ]);
    }


    /**
     * Agregar foro
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

    /**
     * Agregar pregunta a foro
     *
     * @return \Illuminate\Http\Response
     */
    public function addQuestion($module_slug,$session_slug)
    {
        //
        $user      = Auth::user();
        $session   = ModuleSession::where('slug',$session_slug)->firstOrFail();
        return view('fellow.modules.sessions.forums.forums-add-question')->with([
          "user"      => $user,
          "session" => $session
        ]);
    }


    /**
     * Guarda nueva pregunta
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveQuestion(SaveForumConversation $request)
    {
      $user      = Auth::user();
      $forum     = Forum::where('slug',$request->forum_slug)->firstOrFail();
      $forumConversation     = new ForumConversation($request->only(['topic','description']));
      $forumConversation->user_id = $user->id;
      $forumConversation->forum_id = $forum->id;
      $forumConversation->slug    = str_slug($request->topic);
      $forumConversation->save();
      return redirect("tablero/foros/{$session->module->slug}/{$session->slug}/{$forumConversation->slug}/ver")->with('message','Pregunta creada correctamente');
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
        return view('fellow.modules.sessions.forums.forum-add-message')->with([
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
        $forum   = Forum::where('slug',$request->forum_slug)->firstOrFail();
        $message     = new ForumMessage($request->only(['message']));
        $message->user_id = $user->id;
        $message->forum_id = $forum->id;
        $message->save();
        if($forum->session_id){
          return redirect("tablero/foros/{$forum->session->slug}/{$forum->slug}/ver")->with('message','Mensaje creado correctamente');
        }else{
          return redirect("tablero/foros/{$forum->state_name}")->with('message','Mensaje creado correctamente');
        }
      }

      /**
       * foro por estado
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
      public function stateForum($state_name)
      {
        $user      = Auth::user();
        if($user->fellowData->state === $state_name){
          $forum  = Forum::where('state_name',$state_name)->firstOrFail();
          return view('fellow.modules.sessions.forums.forum-view')->with([
            "user"      => $user,
            "forum"    => $forum
          ]);
        }else{
          return redirect('tablero');
        }

      }

}
