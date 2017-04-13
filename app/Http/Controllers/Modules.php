<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Module;
use App\User;
// FormValidators
use App\Http\Requests\SaveModule;
use App\Http\Requests\UpdateModule;
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
    $user = Auth::user();
    $modules = Module::orderBy('start','desc')->paginate($this->pageSize);
    return view('admin.modules.module-list')->with([
      'user' => $user,
      'modules' =>$modules,
    ]);

  }

  /**
  * Agregar módulo
  *
  * @return \Illuminate\Http\Response
  */
  public function add()
  {
    $user   = Auth::user();
    return view('admin.modules.module-add')->with([
      "user"      => $user,
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
    $data   = $request->except('_token');
    $data['user_id'] = $user->id;
    $data['slug']    = str_slug($request->title);
    $module = new Module($data);
    $module->save();
    return redirect("dashboard/modulos/ver/$module->id")->with('success',"Se ha guardado correctamente");
  }

  /**
  * Muestra módulo
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function view($id)
  {
    //
    $user   = Auth::user();
    $module = Module::find($id);
    return view('admin.modules.module-view')->with([
      "user"      => $user,
      "module"    => $module
    ]);
  }

  /**
  * Muestra contenido para actualizar un módulo
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
    $user = Auth::user();
    $module = Module::find($id);
    return view('admin.modules.module-update')->with([
      'user' => $user,
      'module' =>$module,
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
    $data   = $request->except('_token');
    $data['slug']    = str_slug($request->title);
    Module::where('id',$request->id)->update($data);
    return redirect("dashboard/modulos/ver/$request->id")->with('success',"Se ha actualizado correctamente");
  }

  /**
  * Deshabilita módulo
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function delete($id)
  {
    //
  }

  /**
  * asignar facilitador a módulo
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function assign($module_id)
  {
    //
    $user = Auth::user();
    $facilitators = User::where('type','facilitator')->where('enabled',1)->orderBy('name','desc')->get();
    $module       = Module::where('id',$module_id)->firstOrFail();
    return view('admin.modules.facilitator-assign')->with([
      'user' => $user,
      'facilitators' =>$facilitators,
      'module'=>$module
    ]);

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
                  ->where('enabled', 1)
                  ->where('name', 'like', "$member%")
                  ->get();
       if($results->isempty()){
         $results = User::where('type', 'facilitator')
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
}
