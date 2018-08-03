<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
// models
use App\Models\FacilitatorModule;
use App\Models\Module;
use App\Models\ModuleSession;
use App\Models\Log;
use App\Models\Program;
use App\User;
// FormValidators
use App\Http\Requests\SaveSession;
use App\Http\Requests\UpdateSession;
class ModuleSessions extends Controller
{

    //Paginación
    public $pageSize = 10;

    /**
    * Búsqueda de sesión
    *
    * @return \Illuminate\Http\Response
    */
    public function search()
    {
      //
    }

    /**
    * Muestra lista de sesiones
    *
    * @return \Illuminate\Http\Response
    */
    public function index($id)
    {
      //
      $user    = Auth::user();
      $module  = Module::find($id)->with('sessions')->paginate($this->pageSize);
      return view('admin.modules.sessions.session-list')->with([
        'user' => $user,
        'module' =>$module,
      ]);

    }

    /**
    * Agregar sesión
    *
    * @return \Illuminate\Http\Response
    */
    public function add($program_id, $module_id)
    {
      $user    = Auth::user();
      $program = Program::where('id',$program_id)->firstOrFail();
      $module  = $program->modules()->find($module_id);
      $list     = $module->sessions->pluck('name','id')->toArray();
      $list['0'] = 'Sin sesión predecesora';
      return view('admin.modules.sessions.session-add')->with([
        "user"      => $user,
        "module_id" => $module_id,
        "list"      => $list,
        "program_id" => $program->id
      ]);
    }

    /**
    * Guarda nueva sesión
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function save(SaveSession $request)
    {
      $user   = Auth::user();
      $data    = $request->except('_token');
      $data['module_id']    = $request->module_id;
      $data['slug']         = str_slug($request->name);
      $session = new ModuleSession($data);
      $session = $this->checkOrder($session);
      $log = Log::firstOrCreate([
        'user_id'     => $user->id,
        'session_id'  => $session->id,
        'module_id'   => $request->module_id,
        'program_id'  => $session->module->program->id,
        'type'        => 'create'
      ]);
      return redirect("dashboard/programas/$request->program_id/modulos/$request->module_id/sesiones/ver/$session->id")->with('success',"Se ha guardado correctamente");

    }

    /**
    * check order session
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  object  $data request data
    * @param  object  $data  data to save
    * @param  boolean $type  true add false update
    */

    protected function checkOrder($data){
      //primera sesión
      if(!$data->parent_id){
         $order        =  1;
         $data->order  =  $order;
         $data->parent_id = null;
         $last_parent_null = ModuleSession::where('module_id',$data->module_id)->where('parent_id',null)->first();
         $data->save();
         if($last_parent_null){
           $last_parent_null->parent_id = $data->id;
           $last_parent_null->save();
         }
         $sessions = ModuleSession::where('module_id',$data->module_id)->whereNotNull('parent_id')->where('id','!=',$data->id)->orderBy('order','asc')->get();
         foreach ($sessions as $s) {
           $s->order = $s->order+1;
           $s->save();
         }
      }else{
        //new session
        $parent  = ModuleSession::find($data->parent_id);
        $order   = $parent->order+1;
        $data->order = $order;
        $data->save();
        $session_with_same_order = ModuleSession::where('module_id',$data->module_id)->whereNotNull('parent_id')->where('id','!=',$data->id)->where('order','>=',$order)->orderBy('order','asc')->first();
        if($session_with_same_order){
          $session_with_same_order->order      = $order+1;
          $session_with_same_order->parent_id  = $data->id;
          $session_with_same_order->save();
          $sessions = ModuleSession::where('module_id',$data->module_id)->whereNotNull('parent_id')->whereNotIn('id',[$data->id,$session_with_same_order->id])->where('order','>=',$order)->orderBy('order','asc')->get();
          foreach ($sessions as $s) {
            $s->order = $s->order+1;
            $s->save();
          }
        }
      }
     return $data;
    }



    /**
    * Muestra sesión
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function view($program_id,$module_id,$session_id)
    {
      //
      $user    = Auth::user();
      $program = Program::where('id',$program_id)->firstOrFail();
      $module  = $program->modules()->find($module_id);
      $session = $module->sessions()->find($session_id);
      return view('admin.modules.sessions.session-view')->with([
        "user"      => $user,
        "session"   => $session,
      ]);
    }

    /**
    * Muestra contenido para actualizar una sesión
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($program_id,$module_id,$session_id)
    {
      //
      $user = Auth::user();
      $program = Program::where('id',$program_id)->firstOrFail();
      $module  = $program->modules()->find($module_id);
      $session = $module->sessions()->find($session_id);
      $list     = $module->sessions()->where('id','!=',$session_id)->pluck('name','id')->toArray();
      $list['0'] = 'Sin sesión predecesora';
      return view('admin.modules.sessions.session-update')->with([
        'user' => $user,
        'session' =>$session,
        'list'=>$list
      ]);
    }

    /**
    * Actualiza sesión
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(UpdateSession $request)
    {
      //
      $user      = Auth::user();
      $data      = $request->except('_token');
      $program   = Program::where('id',$request->program_id)->firstOrFail();
      $module    = $program->modules()->find($request->module_id);
      $old_sess  = $module->sessions()->find($request->session_id);
      $data['module_id']    = $old_sess->module_id;
      $data['slug']         = str_slug($request->name);
      if($data['parent_id']==='0'){
        $data['parent_id'] = null;
        $new_parent      = false;
      }else{
        $new_parent        = ModuleSession::find($data['parent_id']);
      }
      $this->checkUpdateOrder($data,$old_sess,$new_parent);
      $log = Log::firstOrCreate([
        'user_id'     => $user->id,
        'session_id'  => $request->session_id,
        'module_id'   => $request->module_id,
        'program_id'  => $program->id,
        'type'        => 'update'
      ]);
      return redirect("dashboard/programas/$request->program_id/modulos/$request->module_id/sesiones/ver/$old_sess->id")->with('success',"Se ha actualizado correctamente");
    }


    protected function parent_child($session_id,$count){
      $session = ModuleSession::where('id',$session_id)->first();
      if($session){
        $session->order = $count;
        $session->save();
        if($session->parent_id){
            $count++;
            $this->parent_child($session->parent_id,$count);
        }else{
          return $session;
        }
      }else{
        return false;
      }

    }

    protected function child_deep($session_id,$count){
      $session = ModuleSession::where('id',$session_id)->first();
      if($session){
        $session->order = $count;
        $session->save();
        if($child = ModuleSession::where('module_id',$session->module_id)->where('parent_id',$session->id)->first()){
            $count++;
            $this->child_deep($child->id,$count);
        }else{
          return $session;
        }
      }else{
        return false;
      }
    }


    /**
    * check order session
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  object  $data request data
    * @param  object  $data  data to save
    * @param  boolean $type  true add false update
    */

    protected function checkUpdateOrder($data,$old_sess,$new_parent){
      if($new_parent){
          $new_parent_old_child = ModuleSession::where('module_id',$old_sess->module_id)->where('parent_id',$new_parent->id)->first();
          $old_parent           = ModuleSession::where('module_id',$old_sess->module_id)->where('id',$old_sess->parent_id)->first();
          $old_child            = ModuleSession::where('module_id',$old_sess->module_id)->where('parent_id',$old_sess->id)->first();
          if($new_parent_old_child){
            $old_child->parent_id = $old_parent->id;
            $old_child->save();
            $new_parent_old_child->parent_id = $old_sess->id;
            $new_parent_old_child->save();
          }else{
            //last session
            $old_child->parent_id = $old_parent->id;
            $old_child->save();
          }
          ModuleSession::where('id',$old_sess->id)->update($data);
          $start        = ModuleSession::where('module_id',$old_sess->module_id)->whereNull('parent_id')->first();
          $this->child_deep($start->id,1);
      }else{
        $old_parent           = ModuleSession::where('module_id',$old_sess->module_id)->where('id',$old_sess->parent_id)->first();
        $old_child            = ModuleSession::where('module_id',$old_sess->module_id)->where('parent_id',$old_sess->id)->first();
        $first_old_session    = ModuleSession::where('module_id',$old_sess->module_id)->whereNull('parent_id')->first();
        $first_old_session->parent_id = $old_sess->id;
        $first_old_session->save();
        $old_child->parent_id = $old_parent->id;
        $old_child->save();

        ModuleSession::where('id',$old_sess->id)->update($data);
        $start        = ModuleSession::where('module_id',$old_sess->module_id)->whereNull('parent_id')->first();
        $this->child_deep($start->id,1);
      }

      return true;

    }


    /**
    * Deshabilita sesión
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function delete($program_id,$module_id,$session_id)
    {
      //
      $user    = Auth::user();
      $program = Program::where('id',$program_id)->firstOrFail();
      $module  = $program->modules()->where('id',$module_id)->firstOrFail();
      $session = $module->sessions()->where('id',$session_id)->firstOrFail();
   //eliminar actividades
      foreach ($session->activities as $activity) {
        foreach ($activity->activityFiles as $file) {
          File::delete($file->path."/".$file->identifier);
          $file->delete();
        }

        if($activity->videos){
          $activity->videos->delete();
        }
        $activity->delete();
      }

      //eliminar facilitadores asignados
      $session->facilitators()->delete();
      //delete forum
      $session->all_forum()->delete();
      $log = Log::firstOrCreate([
        'user_id'     => $user->id,
        'session_id'  => $session->id,
        'module_id'   => $session->module_id,
        'program_id'  => $session->module->program->id,
        'type'        => 'delete: '.str_limit($session->name, 150)
      ]);
      $this->checkDeleteOrder($session);
      return redirect("dashboard/programas/$program->id/modulos/ver/$module_id")->with('success',"Se ha eliminado correctamente");
    }



    /**
    * check order session
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  object  $data request data
    * @param  object  $data  data to save
    * @param  boolean $type  true add false update
    */

    protected function checkDeleteOrder($old_sess){
      if($old_sess->parent_id){
          $old_parent           = ModuleSession::where('module_id',$old_sess->module_id)->where('id',$old_sess->parent_id)->first();
          $old_child            = ModuleSession::where('module_id',$old_sess->module_id)->where('parent_id',$old_sess->id)->first();
          if($old_child){
            $old_child->parent_id = $old_parent->id;
            $old_child->save();
          }
          $old_sess->delete();
          $start        = ModuleSession::where('module_id',$old_sess->module_id)->whereNull('parent_id')->first();
          $this->child_deep($start->id,1);
      }else{
        //first session deleted
        $old_child            = ModuleSession::where('module_id',$old_sess->module_id)->where('parent_id',$old_sess->id)->first();
        $old_child->parent_id = null;
        $old_child->save();
        $old_sess->delete();
        $start        = ModuleSession::where('module_id',$old_sess->module_id)->whereNull('parent_id')->first();
        $this->child_deep($start->id,1);
      }
      return true;

    }

    /**
    * Actualiza orden de sesiones
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $order el orden nuevo
    * @param  int  $id el id del módulo o sesión
    * @param  boolean  $type true sesión, false módulo
    */
    protected function orderSession($order,$id,$type){
      $order   =  (int)$order;
      if($type){
        $session =  ModuleSession::find($id);
        $id_c    =  $session->module_id;
      }else{
        $id_c    = $id;
      }
      $numbers = ModuleSession::where('module_id',$id_c)->orderBy('order','asc')->pluck('id','order')->toArray();
      $index    = ModuleSession::where('module_id',$id_c)->orderBy('order','asc')->pluck('order','id')->toArray();
      if(isset($numbers[$order])){
        $flag = 0;
        $temp_ids = [];
        $temp2 = [];
        foreach ($index as $number) {
          if($order==$number){
            $flag =1;
          }
          if($flag){
            $idsr    = $numbers[$number];
            array_push($temp_ids,$idsr);

          }
        }
        $flag = 0;
        foreach ($temp_ids as $id) {
          # code...
          $session = ModuleSession::find($id);
          if($flag>0){
            if(($session->order - $temp_s)< 2){
              $temp_s  = $session->order;
              $session->order = $session->order+1;
            }
          }else{
            $temp_s  = $session->order;
            $session->order = $session->order+1;
          }
          $session->save();
          $flag++;
        }
        return true;
      }else{
          return true;
      }
    }

    /**
    * asignar facilitador a sesión
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function assign($program_id,$module_id,$session_id)
    {
      //
      $user = Auth::user();
      $facilitators = User::where('type','facilitator')->orWhere('type','admin')->where('enabled',1)->orderBy('institution','desc')->get();
      $session       = ModuleSession::where('id',$session_id)->firstOrFail();
      return view('admin.modules.facilitator-assign')->with([
        'user' => $user,
        'facilitators' =>$facilitators,
        'session'=>$session
      ]);

    }


    /**
    * remover facilitador a sesión
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function remove($program_id,$module_id,$session_id,$facilitator_id)
    {
      //
      $user = Auth::user();
      $program = Program::where('id',$program_id)->firstOrFail();
      $module  = $program->modules()->where('id',$module_id)->firstOrFail();
      $session = $module->sessions()->where('id',$session_id)->firstOrFail();
      $session->facilitators()->where('user_id',$facilitator_id)->where('session_id',$session_id)->where('module_id',$module_id)->delete();
      return redirect("dashboard/programas/$program->id/modulos/$module->id}/sesiones/ver/$session->id")->with('success',"Se ha guardado correctamente");

    }

    /**
    * guardar asignacion de facilitadores a módulo
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function saveAssign(Request $request)
    {
      //
      $user = Auth::user();
      $session   = ModuleSession::where('id',$request->session_id)->firstOrFail();
      $session->facilitators()->delete();
      if(!empty($request->signed)){
        foreach($request->signed as $g){
          $facilitator = $session->facilitators()->firstOrCreate([
            "user_id" => $g,
            "module_id" => $session->module->id,
            "session_id" => $session->id
          ]);
        }
      }
      $log = Log::firstOrCreate([
        'user_id'     => $user->id,
        'session_id'  => $session->id,
        'module_id'   => $session->module_id,
        'program_id'  => $session->module->program->id,
        'type'        => 'assign'
      ]);
      return redirect("dashboard/programas/{$session->module->program->id}/modulos/{$session->module->id}/sesiones/ver/$session->id")->with('success',"Se ha guardado correctamente");
    }

    /**
     * busca facilitador
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function searchFacilitator(Request $request){
        $member = $request->match;
        $results = User::where('type', 'facilitator')
                    ->orWhere('type','admin')
                    ->where('enabled', 1)
                    ->where('name', 'like', "$member%")
                    ->get();
         if($results->isempty()){
           $results = User::where('type', 'facilitator')
                       ->orWhere('type','admin')
                       ->where('enabled', 1)
                       ->where('email', 'like', "$member%")
                       ->get();
          if($results->isempty()){
            return response()->json(['false'])->header('Access-Control-Allow-Origin', '*');
          }else{
            return response()->json($results)->header('Access-Control-Allow-Origin', '*');
          }
         }else{
           return response()->json($results)->header('Access-Control-Allow-Origin', '*');
         }


     }


     /**
      * Muestra sesiones asignadas como facilitador
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function assignedIndex()
     {
       $user 			  = Auth::user();
       $programs    = Program::orderBy('start','desc')->paginate(10);
       return view('admin.modules.assigned.assigned-program')->with([
         "user"      		=> $user,
         "programs"          => $programs
       ]);
     }

     /**
      * Muestra sesiones asignadas como facilitador
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function assignedView($program_id)
     {
       $user 			  = Auth::user();
       $program     = Program::where('id',$program_id)->firstOrFail();
       $sessions    = $program->get_assigned_sessions($user->id)->paginate(10);
       return view('admin.modules.assigned.assigned-view')->with([
         "user"      		=> $user,
         "program"      => $program,
         "sessions"     => $sessions
       ]);
     }

}
