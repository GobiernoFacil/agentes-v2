<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Forum;
use App\Models\ForumMessage;
use App\Models\ForumConversation;
use App\Models\ModuleSession;
use App\Models\Activity;
// FormValidators
use App\Http\Requests\SaveAdminForum;
use App\Http\Requests\SaveForumConversation;
use App\Http\Requests\SaveMessageForum;
class AdminForums extends Controller
{
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
    return view('admin.forums.forums-all-list')->with([
      "user"      => $user,
      "forums" => $forums,
    ]);

  }


  /**
   * Muestra lista de preguntas por sesión
   *
   * @return \Illuminate\Http\Response
   */
  public function index($id)
  {
    $user     = Auth::user();
    $forum    = Forum::find($id);
    $forums   = ForumConversation::where('forum_id',$forum->id)->orderBy('created_at','desc')->paginate($this->pageSize);
    return view('admin.forums.forums-list')->with([
      "user"      => $user,
      "forums" => $forums,
      "forum"  =>$forum,
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
    return view('admin.forums.forum-view')->with([
      "user"      => $user,
      "forum"    => $forum
    ]);
  }

  /**
   * Agregar foro
   *
   * @return \Illuminate\Http\Response
   */
  public function add()
  {
      //
      $user       = Auth::user();
      $sessions   = ModuleSession::orderBy('name','asc')->pluck('name','id')->toArray();
      $sessions['0'] = 'Selecciona una opción';
      $activities = Activity::orderBy('name','asc')->pluck('name','id')->toArray();
      $activities['0'] = 'Selecciona una opción';
      return view('admin.forums.forums-add')->with([
        "user"      => $user,
        "sessions"      => $sessions,
        "activities"      => $activities
      ]);
  }
  /**
   * Guarda nuevo foro
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function save(SaveAdminForum $request)
  {
    $user      = Auth::user();
    $forum     = new Forum($request->only(['topic','description']));
    $forum->user_id = $user->id;
    $forum->slug    = str_slug($request->topic);
    if($request->session_id!='0'){
      $forum->session_id = $request->session_id;
    }else{
      $activity = Activity::where('id',$request->activity_id)->firstOrFail();
      $forum->session_id = $activity->session->id;
      $forum->activity_id = $activity->id;
    }
    $forum->save();
    return redirect("dashboard/foros/ver/$forum->id")->with('message','Foro creado correctamente');
  }
  /**
   * Agregar mensaje a foro
   *
   * @return \Illuminate\Http\Response
   */
  public function addMessage($id)
  {
      //
      $user      = Auth::user();
      $forum   = ForumConversation::where('id',$id)->firstOrFail();
      return view('admin.forums.forum-add-message')->with([
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
    $forum     = ForumConversation::where('id',$request->id)->firstOrFail();
    $message   = new ForumMessage($request->only(['message']));
    $message->user_id = $user->id;
    $message->conversation_id = $forum->id;
    $message->save();
    return redirect("dashboard/ver/pregunta/foros/{$forum->id}")->with('message','Mensaje creado correctamente');
  }

  /**
   * Agregar mensaje a foro
   *
   * @return \Illuminate\Http\Response
   */
  public function delete($id)
  {
      //
      $user      = Auth::user();
      $forum     = Forum::where('id',$id)->firstOrFail();
      foreach ($forum->forum_messages as $message) {
        # code...
        $message->delete();
      }
      foreach ($forum->forum_conversations as $message) {
        # code...
        foreach ($message->messages as $mes) {
          $mes->delete();
        }
        $message->delete();
      }
      $forum->delete();
       return redirect("dashboard/foros")->with('message','Foro eliminado correctamente');
  }

  /**
   * Agregar pregunta a foro
   *
   * @return \Illuminate\Http\Response
   */
  public function addQuestion($id)
  {
      //
      $user      = Auth::user();
      $forum   = Forum::where('id',$id)->firstOrFail();
      return view('admin.forums.forums-add-question')->with([
        "user"      => $user,
        "forum" => $forum
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
    $forum       = Forum::where('id',$request->id)->first();
    $forumConversation     = new ForumConversation($request->only(['topic','description']));
    $forumConversation->forum_id = $request->id;
    $forumConversation->user_id = $user->id;
    $forumConversation->slug    = str_slug($request->topic);
    $forumConversation->save();
    return redirect("dashboard/foros/ver/{$forum->id}")->with('message','Pregunta creada correctamente');
  }

  /**
  * Muestra pregunta
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function viewQuestion($id)
  {
    //
    $user   = Auth::user();
    $question  = ForumConversation::where('id',$id)->firstOrFail();
    return view('admin.forums.forum-question-view')->with([
      "user"      => $user,
      "question"    => $question
    ]);
  }
}
