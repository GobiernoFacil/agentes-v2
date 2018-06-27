<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Auth;
use App\Models\Forum;
use App\Models\FellowData;
use App\Models\ForumMessage;
use App\Models\ForumConversation;
use App\Models\ModuleSession;
use App\Models\Module;
use App\Models\ForumLog;
use App\User;
use App\Models\FacilitatorModule;
use App\Models\Program;
use App\Notifications\SendForumNotice;
// FormValidators
use App\Http\Requests\SaveForum;
use App\Http\Requests\SaveForumConversation;
use App\Http\Requests\SaveMessageForum;
class FacilitatorForums extends Controller
{
    //
    //Paginación
    public $pageSize = 10;
    /**
     * Muestra dashboard  de foros
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
      $user     = Auth::user();
      $program  = $user->fac_program();
      if($program){
        $forums   = $program->forums()->paginate($this->pageSize);
      }else{
        $forums   = Forum::where('program_id',null)->orderBy('created_at','desc')->paginate($this->pageSize);
        $program   = new Program();
      }
      return view('facilitator.forums.forum-dashboard')->with([
        "user"      => $user,
        "forums"    => $forums,
        "program"   => $program
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
      return view('facilitator.forums.forums-list')->with([
        "user"      => $user,
        "forums" => $forums,
        "forum"  =>$forum,
      ]);

    }
    /**
     * Muestra lista de foros por módulo
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMo()
    {
      $user     = Auth::user();
      $program  = $user->fac_program();
      if($program){
        $modules  = $program->get_admin_modules_with_forums()->paginate($this->pageSize);
        $general  = Forum::where('program_id',$program->id)->where('type','general')->first();

        return view('facilitator.forums.forum-module-list')->with([
          "user"      => $user,
          "modules"   => $modules,
          "program"   => $program,
          "general"   => $general
        ]);
      }else{
        return redirect('tablero-facilitador/foros');
      }

    }

    /**
     * Muestra lista de foros general
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAc($module_id)
    {
      $user     = Auth::user();
      $program  = $user->fac_program();
      if($program){
        $module   = Module::where('id',$module_id)->firstOrFail();
        $forums   = $module->fellow_act_forums()->paginate($this->pageSize);
        return view('facilitator.forums.forums-all-list')->with([
          "user"      => $user,
          "forums"    => $forums,
          "program"   => $program
        ]);
      }else{
          return redirect('tablero-facilitador/foros');
      }

    }

    /**
     * Muestra lista de foros
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSt()
    {
      $user     = Auth::user();
      $program  = $user->fac_program();
      if($program){
        $forums   = Forum::where('type','state')->where('program_id',$program->id)->paginate($this->pageSize);
        return view('facilitator.forums.forums-all-list')->with([
          "user"      => $user,
          "forums"    => $forums,
          "program"   => $program
        ]);
      }else{
          return redirect('tablero-facilitador/foros');
      }
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
    public function addMessage($id)
    {
        //
        $user      = Auth::user();
        $forum   = ForumConversation::where('id',$id)->firstOrFail();
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
      $conversation     = ForumConversation::where('id',$request->id)->firstOrFail();
      $message   = new ForumMessage($request->only(['message']));
      $message->user_id = $user->id;
      $message->conversation_id = $conversation->id;
      $message->save();
      //forum log
      $log = new ForumLog();
      $log->user_id = $user->id;
      $log->type    = 'facilitator';
      $log->action  = 'add-message';
      $log->conversation_id = $conversation->id;
      $log->forum_id = $conversation->forum->id;
      $log->message_id = $message->id;
      $log->save();
      $conversation->forum->send_notification_to($conversation->forum->program,$conversation,'message',$message);
      return redirect("tablero-facilitador/foros/pregunta/ver/{$conversation->id}")->with('message','Mensaje creado correctamente');
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
        return view('facilitator.forums.forums-add-question')->with([
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
      //forum log
      $log = new ForumLog();
      $log->user_id = $user->id;
      $log->type    = 'facilitator';
      $log->action  = 'create-question';
      $log->conversation_id = $forumConversation->id;
      $log->forum_id = $forum->id;
      $log->save();
      $forum->send_notification_to($forum->program,$forumConversation,'question');
      return redirect("tablero-facilitador/foros/{$forum->id}")->with('message','Pregunta creada correctamente');
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
      return view('facilitator.forums.forum-question-view')->with([
        "user"      => $user,
        "question"    => $question
      ]);
    }




}
