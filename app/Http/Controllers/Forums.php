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
use App\Models\Program;
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
      $program     = $user->actual_program();
      $forums      = $program->fellow_forums($user)->paginate($this->pageSize);
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
    public function index($program_slug,$forum_slug)
    {
      $user     = Auth::user();
      $program  = Program::where('slug',$program_slug)->where('public',1)->firstOrFail();
      $forum    = Forum::where('slug',$forum_slug)->firstOrFail();
      if($forum->type === 'activity'){
        $today = date("Y-m-d");
        $session  = $forum->session;
        $session  = $program->get_all_sessions()->where('slug',$session->slug)->where('start','<=',$today)->firstOrFail();

      }elseif($forum->type === 'state'){
        if($user->fellowData->state != $forum->state_name){
          return redirect('tablero')->with(['success'=>'No puedes ver ese foro.']);
        }

      }
      $forums   = ForumConversation::where('forum_id',$forum->id)->orderBy('created_at','desc')->paginate($this->pageSize);
      return view('fellow.modules.sessions.forums.forums-list')->with([
        "user"      => $user,
        "forums" => $forums,
        "forum"  =>$forum,
        "program" => $program
      ]);

    }


    /**
     * Agregar pregunta a foro
     *
     * @return \Illuminate\Http\Response
     */
    public function addQuestion($program_slug,$forum_slug)
    {
        //
        $user      = Auth::user();
        $program   = $user->actual_program();
        $forum     = Forum::where('slug',$forum_slug)->firstOrFail();
        return view('fellow.modules.sessions.forums.forums-add-question')->with([
          "user"      => $user,
          "forum"     => $forum,
          "program"   => $program
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
      $program   = $user->actual_program();
      $forum     = Forum::where('slug',$request->forum_slug)->firstOrFail();
      $forumConversation     = new ForumConversation($request->only(['topic','description']));
      $forumConversation->forum_id = $forum->id;
      $forumConversation->user_id  = $user->id;
      $forumConversation->slug     = str_slug($request->topic);
      $forumConversation->save();
      //forum log
      $log = new ForumLog();
      $log->user_id = $user->id;
      $log->type    = 'fellow';
      $log->action  = 'create-question';
      $log->conversation_id = $forumConversation->id;
      if($forum->type ==='activity'){
        $log->forum_id = $forum->id;
        $log->save();
      //  $this->send_to($session->forums,$forumConversation,'question');
        $fellowAverage = new FellowAverage();
        $fellowAverage->scoreSession(null,$user->id,$forum->session->id);
      }else{
        $log->forum_id = $forum->id;
        $log->save();
      //    $this->send_to($forum,$forumConversation,'question');
      }
        return redirect("tablero/$program->slug/foros/$forum->slug")->with('message','Pregunta creada correctamente');
    }


    /**
    * Muestra pregunta
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function viewQuestion($program_slug,$session_slug,$question_slug)
    {
      //
      $user   = Auth::user();
      $program = $user->actual_program();
      $question  = ForumConversation::where('slug',$question_slug)->firstOrFail();
      return view('fellow.modules.sessions.forums.forum-question-view')->with([
        "user"      => $user,
        "question"  => $question,
        "program"   => $program
      ]);
    }



    /**
     * Agregar mensaje a foro
     *
     * @return \Illuminate\Http\Response
     */
    public function addMessage($program_slug,$forum_slug)
    {
        //
        $user      = Auth::user();
        $program   = $user->actual_program();
        $question  = ForumConversation::where('slug',$forum_slug)->firstOrFail();
        return view('fellow.modules.sessions.forums.forum-add-message')->with([
          "user"      => $user,
          "question"  => $question,
          "program"   => $program,
          "forum"     => $question
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
        $program   = $user->actual_program();
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
      //  $this->send_to($conversation->forum,$conversation,'message');
        //conversacion perteneciente a foro con sesion
        if($conversation->forum->type === 'activity'){
          $fellowAverage = new FellowAverage();
          $fellowAverage->scoreSession(null,$user->id,$conversation->forum->session_id);
        }
        return redirect("tablero/$program->slug/foros/{$conversation->forum->slug}/ver-pregunta/$conversation->slug")->with('message','Mensaje creado correctamente');
      }

      /**
       * foro por estado, general o soporte
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
      public function stateForum($program_slug,$slug)
      {
        $user      = Auth::user();
        $program   = Program::where('slug',$program_slug)->where('public',1)->firstOrFail();
        $forum     = Forum::where('program_id',$program->id)->where('slug',$slug)->firstOrFail();
        if($forum->type==='state'){
            if($user->fellowData->state != $forum->state_name){
              return redirect('tablero')->with(['success'=>'No puedes ver ese foro.']);
            }
        }elseif($forum->type==='activity'){
              return redirect('tablero')->with(['success'=>'No puedes ver ese foro.']);
        }
        $forums   = ForumConversation::where('forum_id',$forum->id)->orderBy('created_at','desc')->paginate($this->pageSize);
         return view('fellow.modules.sessions.forums.forums-list')->with([
            "user"      => $user,
            "forum"    => $forum,
            "forums"    => $forums,
            "session"   => null
          ]);
      }

      protected function send_to($program_slug,$forum,$conversation,$type){
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
      public function profileUser($program_slug,$name,$surname,$lastname)
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
      public function profileAdminUser($program_slug,$name,$type)
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
      public function participations($program_slug)
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
