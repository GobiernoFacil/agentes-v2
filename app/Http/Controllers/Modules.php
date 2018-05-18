<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Module;
use App\Models\Program;
use App\User;
// FormValidators
use App\Http\Requests\SaveModule;
use App\Http\Requests\UpdateModule;
use App\Models\FacilitatorModule;

class Modules extends Controller
{
  //
  //Paginación
  public $pageSize = 10;

  /**
  * Búsqueda de módulo
  *
  * @return \Illuminate\Http\Response
  */
  public function search()
  {
    //
  }

  /**
  * Muestra lista de módulos
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //
    $user 		= Auth::user();
    $modules 	= Module::orderBy('start','asc')->paginate($this->pageSize);
    $sessions   = FacilitatorModule::where('user_id',$user->id)->count();
    return view('admin.modules.module-list')->with([
      'user' 	 => $user,
      'modules'  =>$modules,
      'sessions' => $sessions
    ]);

  }

  /**
  * Agregar módulo
  *
  * @return \Illuminate\Http\Response
  */
  public function add($program_id)
  {
    $user     = Auth::user();
    $program  = Program::where('id',$program_id)->firstOrFail();
    $list     = Module::where('program_id',$program_id)->orderBy('order','desc')->pluck('title','id')->toArray();
    $list[null] = 'Sin módulo predecesor';
    return view('admin.modules.module-add')->with([
      "user"      => $user,
      "program"   => $program,
      "list"      => $list
    ]);
  }

  /**
  * Guarda nuevo módulo
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function save(SaveModule $request)
  {
    //
    $user   = Auth::user();
    $program  = Program::where('id',$request->program_id)->firstOrFail();
    $data   = $request->except('_token');
    $data['user_id'] = $user->id;
    $data['slug']    = str_slug($request->title);
    $data['program_id'] = $request->program_id;
    $module = new Module($data);
    $module->save();
    $order = $this->checkOrder($module);
    return redirect("dashboard/programas/$request->program_id/modulos/ver/$module->id")->with('success',"Se ha guardado correctamente");
  }

    /**
    * Muestra módulo
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function view($program_id,$module_id)
    {
      //
      $user   = Auth::user();
      $program  = Program::where('id',$program_id)->firstOrFail();
      $module = Module::where('id',$module_id)->firstOrFail();
      return view('admin.modules.module-view')->with([
        "user"      => $user,
        "module"    => $module,
        "program"   => $program
      ]);
    }

  /**
  * Muestra contenido para actualizar un módulo
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($program_id,$module_id)
  {
    //
    $user = Auth::user();
    $program  = Program::where('id',$program_id)->firstOrFail();
    $module = Module::where('id',$module_id)->firstOrFail();
    $list   =  Module::where('program_id',$program_id)->where('id','!=',$module_id)->orderBy('order','desc')->pluck('title','id')->toArray();
    $list[null] = 'Sin módulo predecesor';
    return view('admin.modules.module-update')->with([
      'user' => $user,
      'module' =>$module,
      'program' => $program,
      'list'   =>$list
    ]);
  }

  /**
  * Actualiza módulo
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(UpdateModule $request)
  {
    //
    $program  = Program::where('id',$request->program_id)->firstOrFail();
    $module   = Module::where('id',$request->module_id)->firstOrFail();
    $data     = $request->except('_token');
    $data['slug']    = str_slug($request->title);
    $data['program_id'] = $module->program_id;
    $this->checkUpdateOrder($data,$module);
    return redirect("dashboard/programas/$program->id/modulos/ver/$request->module_id")->with('success',"Se ha actualizado correctamente");
  }

  /**
  * Deshabilita módulo
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function delete($program_id,$module_id)
  {
    //
    //
    $program = Program::where('id',$program_id)->firstOrFail();
    $module  = $program->modules()->where('id',$module_id)->firstOrFail();
    $sessions = $module->sessions;
    foreach ($sessions as $session) {
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
    $session->delete();
    }
    $module->delete();
    return redirect("dashboard/programas/ver/$program->id")->with(['success'=>'Se ha eliminado correctamente']);
  }

  /**
  * check order
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  object  $data request data
  * @param  object  $data  data to save
  * @param  boolean $type  true add false update
  */

  protected function checkOrder($data){
    //primer módulo
    if(!$data->parent_id){
       $order        =  1;
       $data->order  =  $order;
       $data->parent_id = null;
       $last_parent_null = Module::where('program_id',$data->program_id)->where('parent_id',null)->first();
       $this->reOrder($order,$data->program_id,$data);
       $data->save();
       if($last_parent_null){
         $last_parent_null->parent_id = $data->id;
         $last_parent_null->save();
       }
       return $data;
    }else{
      //new module
      $parent  = Module::find($data->parent_id);
      $order   = $parent->order+1;
      $data->order = $order;
      $this->reOrder($order,$data->program_id,$data);
      return $data;
    }
  }

  /**
  * reorder modules
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */

  protected function reOrder($order,$program_id,$data){
    $numbers = Module::where('program_id',$program_id)->orderBy('order','asc')->pluck('id','order')->toArray();
    $index   = Module::where('program_id',$program_id)->orderBy('order','asc')->pluck('order','id')->toArray();
    if(isset($numbers[$order])){
        $data->save();
        $module_with_same_order = Module::where('program_id',$program_id)->where('order',$order)->first();
        $module_with_same_order->parent_id = $data->id;
        $module_with_same_order->save();
      $flag = 0;
      $temp_ids = [];
      $temp2 = [];
      //llenar arreglo con los modelos que se re-ordenaran
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
        $module = Module::find($id);
        if($flag>0){
          if(($module->order - $temp_s)< 2){
            $temp_s  = $module->order;
            $module->order = $module->order+1;
            $module->parent_id = $temp_parent_id;
            $temp_parent_id    = $module->id;
          }
        }else{
          $temp_s  = $module->order;
          $temp_parent_id = $module->id;
          $module->order = $module->order+1;
        }
        $module->save();
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
      * check order module
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  object  $data request data
      * @param  object  $data  data to save
      * @param  boolean $type  true add false update
      */

      protected function checkUpdateOrder($data,$module_to){
        if(intval($data['parent_id']) != $module_to->parent_id){
              //first module
              if(!$data['parent_id']){
                    $order             =  1;
                    $data['order']     =  $order;
                    $data['parent_id'] = null;
                    $last_parent_null  = Module::where('program_id',$data['program_id'])->where('parent_id',null)->first();
                    $numbers = Module::where('program_id',$data['program_id'])->whereNotIn('id',[$module_to->id])->orderBy('order','asc')->get();
                    $new_order = 2;
                    foreach ($numbers as $number) {
                      if($new_order>3){
                        $number->order =$new_order;
                        $number->parent_id = $last_module->id;
                        $number->save();
                        $last_module = $number;
                      }else{
                        $number->order =$new_order;
                        $number->save();
                        $last_module = $number;
                      }
                      $new_order++;
                    }
                    Module::where('id',$module_to->id)->update($data);
                    if($last_parent_null){
                      $last_parent_null->parent_id = $module_to->id;
                      $last_parent_null->save();
                    }
              }else{
                //new parent
                $parent         = Module::where('id',$data['parent_id'])->first();
                $new_order      = $parent->order+1;
                $data['order']  =  $new_order;
                $this->reUpdateOrder($new_order,$data,$module_to->id);
              }
        }else{
              Module::where('id',$module_to->id)->update($data);
        }
      }

        /**
        * check order module
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  object  $data request data
        * @param  object  $data  data to save
        * @param  boolean $type  true add false update
        */

        protected function reUpdateOrder($order,$data,$module_id){
          $numbers = Module::where('program_id',$data['program_id'])->orderBy('order','asc')->whereNotIn('id',[$module_id])->get();
          foreach ($numbers as $number) {
            if($number->order >= $order){
              $number->order = $number->order+1;
              $number->save();
            }
          }
         Module::where('id',$module_id)->update($data);
         $numbers = Module::where('program_id',$data['program_id'])->orderBy('order','asc')->get();
          $new_order = 1;
          foreach ($numbers as $number) {
            if($new_order>1){
              $number->order =$new_order;
              $number->parent_id = $last_module->id;
              $number->save();
              $last_module = $number;
            }else{
              $number->order =$new_order;
              $number->save();
              $last_module = $number;
            }
            $new_order++;
          }
          return true;
        }

}
