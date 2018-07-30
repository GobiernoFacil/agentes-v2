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
         $this->reOrder($order,$data->module_id,$data);
         if($last_parent_null){
           $last_parent_null->parent_id = $data->id;
           $last_parent_null->save();
         }
      }else{
        //new session
        $parent  = ModuleSession::find($data->parent_id);
        $order   = $parent->order+1;
        $data->order = $order;
        $data->save();
        $this->reOrder($order,$data->module_id,$data);
      }
     return $data;
    }


    /**
    * reorder sessions
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    protected function reOrder($order,$module_id,$data){
      $numbers = ModuleSession::where('module_id',$module_id)->orderBy('order','asc')->pluck('id','order')->toArray();
      $index   = ModuleSession::where('module_id',$module_id)->orderBy('order','asc')->pluck('order','id')->toArray();
      if(isset($numbers[$order])){
          $data->save();
          $session_with_same_order = ModuleSession::where('module_id',$module_id)->where('order',$order)->first();
          $session_with_same_order->parent_id = $data->id;
          $session_with_same_order->save();
        $flag = 0;
        $temp_ids = [];
        $temp2 = [];
        //llenar arreglo con las sesiones que se re-ordenaran
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
          # reordenar sesiones
          $session = ModuleSession::find($id);
          if($flag>0){
            if(($session->order - $temp_s)< 2){
              $temp_s  = $session->order;
              $session->order = $session->order+1;
              $session->parent_id = $temp_parent_id;
              $temp_parent_id    = $session->id;
            }
          }else{
            $temp_s  = $session->order;
            $temp_parent_id = $session->id;
            $session->order = $session->order+1;
          }
          $session->save();
          $flag++;
        }
        return true;
      }else{
          $data->save();
        //ultima de la lista no se hace nada
          return true;
      }

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
      $user = Auth::user();
      $data    = $request->except('_token');
      $program = Program::where('id',$request->program_id)->firstOrFail();
      $module  = $program->modules()->find($request->module_id);
      $sess    = $module->sessions()->find($request->session_id);
      $data['module_id']    = $sess->module_id;
      $data['slug']         = str_slug($request->name);
      $session = new ModuleSession($data);
      $this->checkUpdateOrder($session,$request->session_id);
      $log = Log::firstOrCreate([
        'user_id'     => $user->id,
        'session_id'  => $sess->id,
        'module_id'   => $request->module_id,
        'program_id'  => $session->module->program->id,
        'type'        => 'update'
      ]);
      return redirect("dashboard/programas/$request->program_id/modulos/$request->module_id/sesiones/ver/$sess->id")->with('success',"Se ha actualizado correctamente");
    }


    /**
    * check order session
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  object  $data request data
    * @param  object  $data  data to save
    * @param  boolean $type  true add false update
    */

    protected function checkUpdateOrder($data,$session_id){
      $sess = ModuleSession::find($session_id);
      if($data->parent_id!=$sess->parent_id){
            //first session
            if($data->parent_id==='0'){
              $order        =  1;
              $data->order  =  $order;
              $data->parent_id = null;
              $last_parent_null = ModuleSession::where('module_id',$data->module_id)->where('parent_id',null)->first();
              $numbers = ModuleSession::where('module_id',$data->module_id)->whereNotIn('id',[$session_id])->orderBy('order','asc')->get();
              $new_order = 2;
              foreach ($numbers as $number) {
                if($new_order>3){
                  $number->order =$new_order;
                  $number->parent_id = $last_session->id;
                  $number->save();
                  $last_session = $number;
                }else{
                  $number->order =$new_order;
                  $number->save();
                  $last_session = $number;
                }
                $new_order++;
              }
              ModuleSession::where('id',$session_id)->update($data->toArray());
              if($last_parent_null){
                $last_parent_null->parent_id = $session_id;
                $last_parent_null->save();
              }
            }else{
              $parent    = ModuleSession::find($data->parent_id);
              $new_order = $parent->order+1;
              $data->order  =  $new_order;
              $this->reUpdateOrder($new_order,$data->module_id,$data,$session_id);

            }
          }else{
            ModuleSession::where('id',$session_id)->update($data->toArray());
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

    protected function reUpdateOrder($order,$module_id,$data,$session_id){
      $numbers = ModuleSession::where('module_id',$module_id)->orderBy('order','asc')->whereNotIn('id',[$session_id])->get();
      foreach ($numbers as $number) {
        if($number->order>=$order){
          $number->order = $number->order+1;
          $number->save();
        }
      }
     ModuleSession::where('id',$session_id)->update($data->toArray());
     $numbers = ModuleSession::where('module_id',$data->module_id)->orderBy('order','asc')->get();
      $new_order = 1;
      foreach ($numbers as $number) {
        if($new_order>1){
          $number->order =$new_order;
          $number->parent_id = $last_session->id;
          $number->save();
          $last_session = $number;
        }else{
          $number->order =$new_order;
          $number->save();
          $last_session = $number;
        }
        $new_order++;
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
      $order = $session->order;
      $temp  = $order;
      $last_parent_id = null;
      $log = Log::firstOrCreate([
        'user_id'     => $user->id,
        'session_id'  => $session->id,
        'module_id'   => $session->module_id,
        'program_id'  => $session->module->program->id,
        'type'        => 'delete: '.str_limit($session->name, 150)
      ]);
      $session->delete();
     foreach ($program->get_all_sessions()->get() as $session) {
          if($order < $session->order){
            $session->order = $temp;
            $session->parent_id = $last_parent_id;
            $temp++;
            $session->save();
            $last_parent_id = $session->id;
          }
        if($order != $session->order){
            $last_parent_id = $session->id;
        }
      }

       return redirect("dashboard/programas/$program->id/modulos/ver/$module_id")->with('success',"Se ha eliminado correctamente");
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
