<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Auth;
use Crypt;
use App\Models\FacilitatorModule;
use App\Models\Forum;
use App\Models\FellowData;
use App\Models\FellowAverage;
use App\Models\ForumMessage;
use App\Models\ForumConversation;
use App\Models\ForumLog;
use App\Models\Module;
use App\Models\ModuleSession;
use App\User;
use App\Notifications\SendForumNotice;
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
      $user       = Auth::user();
      $today = date("Y-m-d");
      $program     = $user->actual_program();
      $sessions_id = $program->get_all_fellow_sessions()->where('start','<=',$today)->pluck('id');
      $forums      = $program->forums()->orWhere(function($query)use($sessions_id){
        $query->whereIn('session_id',$sessions_id);
      })->paginate($this->pageSize);
      return view('fellow.modules.sessions.forums.forums-all-list')->with([
        "user"      => $user,
        "forums"    => $forums,
        "program"   => $program
      ]);

    }


    /**
     * Muestra lista de foros por sesión
     *
     * @return \Illuminate\Http\Response
     */
    public function index($session_slug,$forum_slug)
    {
      $user     = Auth::user();
      $today = date("Y-m-d");
      $session  = ModuleSession::where('slug',$session_slug)->where('start','<=',$today)->firstOrFail();
      $forum    = Forum::where('slug',$forum_slug)->first();
      if(!$forum){
        $auser = User::where('institution','Gobierno Fácil')->first();
        $forum = new Forum();
        $forum->session_id = $session->id;
        $forum->user_id    = $auser->id;
        $forum->topic      = "Foro de la sesión: ".$session->name;
        $forum->description = "En este foro podrás resolver tus dudas acerca de la sesión.";
        $forum->slug       = str_slug("Foro de la sesión: ".$session->name);
        $forum->save();
      }
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
    public function addQuestion($session_slug)
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
     * Agregar pregunta a foro de estado
     *
     * @return \Illuminate\Http\Response
     */
    public function addStateQuestion($state_name)
    {
        //
        $user      = Auth::user();
        return view('fellow.modules.sessions.forums.forums-add-question')->with([
          "user"      => $user,
          "session" => $state_name
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
      $session     = ModuleSession::where('slug',$request->session_slug)->first();
      if($request->session_slug==='foro-general'){
        $forum       = Forum::where('state_name','General')->first();
      }else{
        $forum       = Forum::where('state_name',$request->session_slug)->first();
      }
      $forumConversation     = new ForumConversation($request->only(['topic','description']));
      if($session){
        //foro con sesión
        $forumConversation->forum_id = $session->forums->id;
      }elseif($forum){
        //foro de estado
        $forumConversation->forum_id = $forum->id;
      }else{
        //foro general
      }
      $forumConversation->user_id = $user->id;
      $forumConversation->slug    = str_slug($request->topic);
      $forumConversation->save();
      //forum log
      $log = new ForumLog();
      $log->user_id = $user->id;
      $log->type    = 'fellow';
      $log->action  = 'create-question';
      $log->conversation_id = $forumConversation->id;
      if($session){
        $log->forum_id = $session->forums->id;
        $log->save();
        $this->send_to($session->forums,$forumConversation,'question');
        $fellowAverage = new FellowAverage();
        $fellowAverage->scoreSession(null,$user->id,$session->id);
        return redirect("tablero/foros/{$session->slug}/{$session->forums->slug}")->with('message','Pregunta creada correctamente');
      }else{
        $log->forum_id = $forum->id;
        $log->save();
        $this->send_to($forum,$forumConversation,'question');
        if($request->session_slug==='foro-general'){
          return redirect("tablero/foros/foro-general")->with('message','Pregunta creada correctamente');
        }else{
          return redirect("tablero/foros/{$forum->state_name}")->with('message','Pregunta creada correctamente');
        }
      }
    }


    /**
    * Muestra pregunta
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function viewQuestion($session_slug,$question_slug)
    {
      //
      $user   = Auth::user();
      $question  = ForumConversation::where('slug',$question_slug)->firstOrFail();
      return view('fellow.modules.sessions.forums.forum-question-view')->with([
        "user"      => $user,
        "question"    => $question
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
        $forum   = ForumConversation::where('slug',$forum_slug)->firstOrFail();
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
        $conversation   = ForumConversation::where('slug',$request->question_slug)->firstOrFail();
        $message     = new ForumMessage($request->only(['message']));
        $message->user_id = $user->id;
        $message->conversation_id = $conversation->id;
        $message->save();
        //forum log
        $log = new ForumLog();
        $log->user_id = $user->id;
        $log->type    = 'fellow';
        $log->action  = 'add-message';
        $log->conversation_id = $conversation->id;
        $log->forum_id = $conversation->forum->id;
        $log->message_id = $message->id;
        $log->save();
        $this->send_to($conversation->forum,$conversation,'message');
        //conversacion perteneciente a foro con sesion
        if($conversation->forum->session_id){
          $fellowAverage = new FellowAverage();
          $fellowAverage->scoreSession(null,$user->id,$conversation->forum->session_id);
          return redirect("tablero/foros/pregunta/{$conversation->forum->session->slug}/{$conversation->slug}/ver")->with('message','Mensaje creado correctamente');
        }elseif($conversation->forum->state_name){
          //conversacion perteneciente a foro con estado
          return redirect("tablero/foros/{$conversation->forum->state_name}/{$conversation->slug}/ver")->with('message','Mensaje creado correctamente');
        }else{
          //conversacion perteneciente a foro general
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
        if($user->fellowData->state == $state_name || $state_name =="foro-general"){
          if($state_name=='foro-general'){
            $state_name= 'General';
          }
          $forum  = Forum::where('state_name',$state_name)->firstOrFail();
          $forums   = ForumConversation::where('forum_id',$forum->id)->orderBy('created_at','desc')->paginate($this->pageSize);
          return view('fellow.modules.sessions.forums.forums-list')->with([
            "user"      => $user,
            "forum"    => $forum,
            "forums"    => $forums,
            "session"   => null
          ]);
        }else{
          return redirect('tablero');
        }

      }

      protected function send_to($forum,$conversation,$type){
          if(!$forum->state_name && $type!="create"){
            //usuarios en el foro
            $user_ids = ForumLog::where('forum_id',$forum->id)->pluck('user_id');
            $users    = User::whereIn('id',$user_ids->toArray())->where('type','fellow')
            ->orWhere(function($query)use($user_ids){
              $query->where('institution','PROSOCIEDAD')->whereIn('id',$user_ids->toArray());
            })
            ->where('enabled',1)
            ->get();
            foreach ($users as $userA) {
              $this->send($userA,$forum,$conversation,$type);
            }
          }elseif(!$forum->state_name && $type==="create"){
           //a todos los usuarios fellow y facilitator PROSOCIEDAD
           $assign_f = FacilitatorModule::all()->pluck('user_id');
           $users = User::where('type','fellow')
           ->orWhere(function($query)use($assign_f){
             $query->where('institution','PROSOCIEDAD')->whereIn('id',$assign_f->toArray());
           })
           ->orWhere(function($query){
             $query->where('type','facilitator')->where('institution','PROSOCIEDAD');
           })
           ->where('enabled',1)->get();
            foreach ($users as $userA) {
              $this->send($userA,$forum,$conversation,$type);
            }

          }else{
            if($forum->state_name==='General'){
              //a todos los usuarios fellow y facilitator
              $assign_f = FacilitatorModule::all()->pluck('user_id');
              $users = User::where('type','fellow')
              ->orWhere(function($query)use($assign_f){
                $query->where('institution','PROSOCIEDAD')->whereIn('id',$assign_f->toArray());
              })
              ->orWhere(function($query){
                $query->where('type','facilitator')->where('institution','PROSOCIEDAD');
              })
              ->where('enabled',1)->get();
               foreach ($users as $userA) {
                 $this->send($userA,$forum,$conversation,$type);
               }
            }else{
              //usuarios del estado y facilitator
              $assign_f = FacilitatorModule::all()->pluck('user_id');
              $assign_state = FellowData::where('state',$forum->state_name)->pluck('user_id');
              $users = User::where('institution','PROSOCIEDAD')->whereIn('id',$assign_f->toArray())
              ->orWhere(function($query)use($assign_state){
                $query->where('type','fellow')->whereIn('id',$assign_state->toArray());
              })
              ->where('enabled',1)->get();
               foreach ($users as $userA) {
                 $this->send($userA,$forum,$conversation,$type);
               }
            }
          }
      }


      protected function send($userA,$forum,$conversation,$type){
        if($type==='create'){
          $userA->notify(new SendForumNotice($userA,$forum,$type,null,null));
        }else{
          $userA->notify(new SendForumNotice($userA,$forum,$type,$conversation,null));
        }
      }


      /**
       * ver perfil
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
      public function profileUser($name,$surname,$lastname)
      {
         $user = Auth::user();
          //fellow
          $fellowData = FellowData::where('surname',$surname)->where('lastname',$lastname)->firstOrFail();
          $userF      = User::find($fellowData->user_id);
          return view('fellow.modules.sessions.forums.forum-view-profile')->with([
            "user"      => $user,
            "userF"      => $userF,
          ]);
      }

      /**
       * ver perfil
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
      public function profileAdminUser($name,$type)
      {

        $user = Auth::user();
        if($type==1){
         $userF      = User::where('name',$name)->where('type','admin')->firstOrFail();
          return view('fellow.modules.sessions.forums.forum-view-profile')->with([
            "user"      => $user,
            "userF"      => $userF,
          ]);
        }elseif($type==2){
          $userF      = User::where('name',$name)->where('type','facilitator')->firstOrFail();
           return view('fellow.modules.sessions.forums.forum-view-profile')->with([
             "user"      => $user,
             "userF"      => $userF,
           ]);
        }else{
          return redirect('tablero');
        }
      }

      /**
      * Muestra hoja de participaciones
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
      public function participations()
      {
        //
        $user   = Auth::user();
        $today  = date('Y-m-d');
        $modules = Module::orderBy('start','asc')->where('public',1)->paginate($this->pageSize);
        return view('fellow.modules.sessions.forums.participation-view')->with([
          "user"      => $user,
          'modules'   =>$modules,
          'today'     =>$today
        ]);
      }


}
