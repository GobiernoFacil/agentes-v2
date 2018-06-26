<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Crypt;
use App\Models\FacilitatorModule;
use App\Models\Forum;
use App\Models\FellowData;
use App\Models\FellowAverage;
use App\Models\ForumMessage;
use App\Models\ForumConversation;
use App\Models\ForumLog;
use App\Models\FellowProgress;
use App\Models\Module;
use App\Models\ModuleSession;
use App\Models\Program;
use App\User;
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
      $user            = Auth::user();
      $program         = $user->actual_program();
      $forums          = $program->fellow_forums($user)->paginate($this->pageSize);
      $week_forums     = $program->actual_week_forums()->get();
      return view('fellow.forums.forums-dash')->with([
        "user"      => $user,
        "forums"    => $forums,
        "program"   => $program
      ]);

    }


     /**
     * Muestra lista de módulos con foros
     *
     * @return \Illuminate\Http\Response
     */
    public function allMo()
    {
      $user       = Auth::user();
      $program    = $user->actual_program();
      $modules    = $program->get_active_modules_with_forums()->paginate($this->pageSize);
      $general    = Forum::where('program_id',$program->id)->where('type','general')->first();
      return view('fellow.forums.forums-module-list')->with([
        "user"      => $user,
        "modules"   => $modules,
        "program"   => $program,
        "general"   => $general
      ]);


    }

    /**
    * Muestra lista de foros general
    *
    * @return \Illuminate\Http\Response
    */
   public function allAc($program_slug,$module_slug)
   {
     $user       = Auth::user();
     $program    = $user->actual_program();
     $module     = Module::where('slug',$module_slug)->where('public',1)->firstOrFail();
     $forums     = $module->fellow_act_forums()->paginate($this->pageSize);
     return view('fellow.forums.forums-all-list')->with([
       "user"      => $user,
       "forums"    => $forums,
       "program"   => $program,
       "module"    => $module
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
      if(isset($forum->session->slug)){
        if(!$user->check_progress($forum->session->slug,1)){
          return redirect("tablero/$program->slug/foros")->with(['error'=>'Aún no puedes participar en ese foro']);
        }
      }
      if($forum->type === 'activity'){
        $session  = $forum->session;
        $session  = $program->get_all_sessions()->where('slug',$session->slug)->firstOrFail();
      }elseif($forum->type === 'state'){
        if(strpos($user->fellowData->state,"xico")){
          if('México' !== $forum->state_name){
            return redirect('tablero')->with(['success'=>'No puedes ver ese foro.']);
          }

        }else{

          if($user->fellowData->state !== $forum->state_name){
            return redirect('tablero')->with(['success'=>'No puedes ver ese foro.']);
          }
        }

      }
      $forums   = ForumConversation::where('forum_id',$forum->id)->orderBy('created_at','desc')->paginate($this->pageSize);
      return view('fellow.forums.forums-list')->with([
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
        return view('fellow.forums.forums-add-question')->with([
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
      var_dump($forum->toArray());
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
        $fellowProgress  = FellowProgress::firstOrCreate([
          'fellow_id'    => $user->id,
          'module_id'    => $forum->session->module->id,
          'session_id'   => $forum->session->id,
          'activity_id'  => $forum->activity->id,
          'program_id'   => $forum->session->module->program->id,
          'type'         => 'forum'
        ]);
        $fellowProgress->status = 1;
        $fellowProgress->save();
        $fellowAverage   = FellowAverage::firstOrCreate([
          'user_id'      => $user->id,
          'module_id'    => $forum->session->module->id,
          'session_id'   => $forum->session->id,
          'program_id'   => $forum->session->module->program->id,
          'type'         => 'session'

        ]);
       $fellowAverage->scoreSession();
       $user->update_progress($forum->session->module);
      }else{
        $log->forum_id = $forum->id;
        $log->save();
      }
      $forum->send_notification_to($program,$forumConversation,'question');
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
      return view('fellow.forums.forum-question-view')->with([
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
        return view('fellow.forums.forum-add-message')->with([
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
        //conversacion perteneciente a foro con sesion
        if($conversation->forum->type === 'activity'){
          $fellowProgress  = FellowProgress::firstOrCreate([
            'fellow_id'    => $user->id,
            'module_id'    => $conversation->forum->session->module->id,
            'session_id'   => $conversation->forum->session->id,
            'activity_id'  => $conversation->forum->activity->id,
            'program_id'   => $conversation->forum->session->module->program->id,
            'type'         => 'forum'
          ]);
          $fellowProgress->status = 1;
          $fellowProgress->save();

          $fellowAverage   = FellowAverage::firstOrCreate([
            'user_id'      => $user->id,
            'module_id'    => $conversation->forum->session->module->id,
            'session_id'   => $conversation->forum->session->id,
            'program_id'   => $conversation->forum->session->module->program->id,
            'type'         => 'session'

          ]);
         $fellowAverage->scoreSession();
         $user->update_progress($conversation->forum->session->module);
        }
        $conversation->forum->send_notification_to($program,$conversation,'message',$message);
        return redirect("tablero/$program->slug/foros/{$conversation->forum->slug}/ver-pregunta/$conversation->slug")->with('message','Mensaje creado correctamente');
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
         return view('fellow.forums.forum-view-profile')->with([
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
      public function profileFUser($program_slug,$name)
      {
        $user = Auth::user();
         //fellow
         $userF      = User::where('name',$name)->firstOrFail();;
         return view('fellow.forums.forum-view-profile')->with([
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
          return view('fellow.forums.forum-view-profile')->with([
            "user"      => $user,
            "userF"      => $userF,
          ]);
        }elseif($type==2){
          $userF      = User::where('name',$name)->where('type','facilitator')->firstOrFail();
           return view('fellow.forums.forum-view-profile')->with([
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
        $program = $user->actual_program();
        $today  = date('Y-m-d');
        $modules = $program->fellow_modules()->paginate(5);
        return view('fellow.forums.participation-view')->with([
          "user"      => $user,
          'modules'   =>$modules,
          'today'     =>$today,
          "program"   =>$program
        ]);
      }


}
