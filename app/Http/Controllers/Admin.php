<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use File;
use Hash;
use Mail;

// models
use App\User;
use App\Models\Aspirant;
use App\Models\AspirantInstitution;
use App\Models\AspirantEvaluation;
use App\Models\Conversation;
use App\Models\FacilitatorData;
use App\Models\FacilitatorModule;
use App\Models\Image;
use App\Models\Module;
use App\Models\NewsEvent;
use App\Models\Program;
// FormValidators
use App\Http\Requests\SaveAdmin;
use App\Http\Requests\UpdateAdmin;
use App\Http\Requests\UpdateAdminProfile;
class Admin extends Controller
{

  //Paginación
  public $pageSize = 10;
  // En esta carpeta se guardan las imágenes de los usuarios
  const UPLOADS = "img/users";
      /**
       * Muestra panel de inicio para administrador
       *
       * @return \Illuminate\Http\Response
       */
      public function dashboard()
      {
        $user 		          = Auth::user();
        $aspirants 	        = Aspirant::where('is_activated',1)->count();
        $testUserId         = User::where('email','andre@fcb.com')->get()->pluck('id');
    	  $fellows	          = User::where('type',"fellow")->where('enabled',1)->whereNotIn('id',$testUserId->toArray())->count();
		    $programs 	        = Program::all()->count();
    		$modules_count      = Module::all()->count();
        $listId             = FacilitatorModule::all()->pluck('user_id');
        $adm_count          = User::whereIn('id',$listId->toArray())->where('type','!=','facilitator')->where('enabled',1)->count();
        $sessions_count     = FacilitatorModule::where('user_id',$user->id)->count();
        $facilitator_number = User::where("type", "facilitator")->where("enabled",1)->count();
        $facilitators_count = $facilitator_number + $adm_count;
		    $news               = NewsEvent::orderBy('created_at','desc')->take(3)->get();
        $conversation_id     = Conversation::where('user_id',$user->id)->pluck('id');
        $conversations_count = Conversation::where('user_id',$user->id)
        ->orWhere(function($query)use($conversation_id,$user){
          $query->where('to_id',$user->id)->whereNotIn('id',$conversation_id->toArray());
        })
        ->count();
        //conteo de aspirantes por estado
        $edomex_number     = Aspirant::where('is_activated',1)->where('state','México')->count();
        $campeche_number   = Aspirant::where('is_activated',1)->where('state','Campeche')->count();
        $durango_number    = Aspirant::where('is_activated',1)->where('state','Durango')->count();
        $guanajuato_number = Aspirant::where('is_activated',1)->where('state','Guanajuato')->count();
        $quintana_number   = Aspirant::where('is_activated',1)->where('state','Quintana Roo')->count();
        $sanluis_number    = Aspirant::where('is_activated',1)->where('state','San Luis Potosí')->count();
        $sinaloa_number    = Aspirant::where('is_activated',1)->where('state','Sinaloa')->count();
        $tabasco_number    = Aspirant::where('is_activated',1)->where('state','Tabasco')->count();
        $tlaxcala_number   = Aspirant::where('is_activated',1)->where('state','Tlaxcala')->count();
        $veracruz_number   = Aspirant::where('is_activated',1)->where('state','Veracruz de Ignacio de la Llave ')->count();

        return view('admin.dashboard')->with([
          "user"      			=> $user,
          "aspirants"			=> $aspirants,
    		  "modules_count"		=> $modules_count,
    		  'facilitators_count'  => $facilitators_count,
    		  'fellows'			    => $fellows,
    		  'news'			    => $news,
    		  'conversations_count' => $conversations_count,
    		  'sessions_count'		=> $sessions_count,
    		  'programs'			=> $programs,
    		  'edomex_number' 		  => $edomex_number,
    		  'campeche_number' 		  => $campeche_number,
    		  'durango_number' 		  => $durango_number,
    		  'guanajuato_number' 		  => $guanajuato_number,
    		  'quintana_number' 		  => $quintana_number,
    		  'sanluis_number' 		  => $sanluis_number,
    		  'sinaloa_number' 		  => $sinaloa_number,
    		  'tabasco_number' 		  => $tabasco_number,
    		  'tlaxcala_number' 		  => $tlaxcala_number,
    		  'veracruz_number' 		  => $veracruz_number,
         ]);
      }

      /**
       * Muestra lista de administradores para usuario super administrador
       *
       * @return \Illuminate\Http\Response
       */
      public function index()
      {
        $user = Auth::user();
        $list = User::where("type", "admin")->paginate($this->pageSize);
        return view('suAdmin.users.admin-list')->with([
          "user"      => $user,
          "admins"  => $list]);
      }

      /**
       * Agregar usuario administrador
       *
       * @return \Illuminate\Http\Response
       */
      public function add()
      {
        $user = Auth::user();
        return view('suAdmin.users.admin-add')->with([
          "user"      => $user
        ]);
      }

      /**
       * Guarda nuevo usuario administrador
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
      public function save(SaveAdmin $request)
      {
        $admin           = new User();
        $admin->type     = "admin";
        $admin->name     = $request->name;
        $admin->email    = $request->email;
        $admin->institution    = $request->institution;
        $admin->enabled  = 1;
        $admin->password = Hash::make($request->password);
        $admin->save();
        $path  = public_path(self::UPLOADS);
        // [ SAVE THE IMAGE ]
        if($request->hasFile('image') && $request->file('image')->isValid()){
          $name = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
          $request->file('image')->move($path, $name);
          $image         = new Image();
          $image->name = $name;
          $image->user_id = $admin->id;
          $image->path = $path;
          $image->type = 'full';
          $image->save();
        }
        //envía correo
        $from    = "info@apertus.org.mx";
        $subject = "Bienvenido al Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible";
       //enviar correo para confirmar dirección de correo
        Mail::send('emails.new_user', ['user' => $admin,'request'=>$request], function($message) use ($admin,$from, $subject) {
                $message->from($from, 'no-reply');
                $message->to($admin->email);
                $message->subject($from);
        });
        return redirect("sa/dashboard/administradores/ver/$admin->id")->with('message','Usuario creado correctamente');
      }
      /**
       * Muestra un usuario administrador
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function view($id)
      {
        $user  = Auth::user();
        $admin = User::find($id);
        return view("suAdmin.users.admin-profile")->with([
          "user"  => $user,
          "admin" => $admin
        ]);
      }

      /**
       * Muestra contenido para actualizar usuario administrador
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function edit($id)
      {
        $user  = Auth::user();
        $admin = User::find($id);
        return view("suAdmin.users.admin-update")->with([
          "user"  => $user,
          "admin" => $admin
        ]);

      }
      /**
       * Actualiza usuario administrador
       *
       * @param  \Illuminate\Http\Request  $request
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function update(UpdateAdmin $request, $id)
      {
        $admin        = User::find($id);
        $admin->name  = $request->name;
        $admin->email = $request->email;
        $admin->institution    = $request->institution;
        if(!empty($request->password)){
          $admin->password = Hash::make($request->password);
        }
        $admin->save();
        // [ SAVE THE IMAGE ]
        if($request->hasFile('image') && $request->file('image')->isValid()){
          $path  = public_path(self::UPLOADS);
          $name = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
          $request->file('image')->move($path, $name);
          if($admin->image){
            File::delete($admin->image->path."/".$admin->image->name);
          }
          $image   = Image::firstorCreate(['user_id'=>$request->id,]);
          $image->name = $name;
          $image->path = $path;
          $image->type = 'full';
          $image->save();
        }
        return redirect("sa/dashboard/administradores/ver/$id")->with("message",'Usuario actualizado correctamente');
      }

      /**
       * Deshabilita usuario administrador
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function delete($id)
      {
        $admin        = User::find($id);
        $admin->enabled  = 0;
        $admin->save();
        return redirect("sa/dashboard/administradores")->with("message",'Usuario deshabilitado');
      }

      /**
       * Muestra perfil del usuario  administrador
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function viewProfile()
      {
        $user = Auth::user();
        $facilitatorData = FacilitatorData::firstOrCreate(['user_id'=>$user->id]);
        return view('admin.profile.profile-view')->with([
          "user"      => $user
        ]);
      }

      /**
       * edita perfil del usuario  administrador
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function editProfile()
      {
        $user = Auth::user();
        $facilitatorData = FacilitatorData::firstOrCreate(['user_id'=>$user->id]);
        return view('admin.profile.profile-update')->with([
          "user"      => $user
        ]);
      }

      /**
       * salva perfil del usuario administrador
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function saveProfile(UpdateAdminProfile $request)
      {
        $admin = Auth::user();
        if(!empty($request->password)){
          $data   = $request->only(['name','email','password']);
          $data['password'] = Hash::make($request->password);
        }else {
          $data   = $request->only(['name','email']);
        }

        User::where('id',$admin->id)->update($data);
        //update facilitator data
        FacilitatorData::where('user_id',$admin->id)->update($request->except(['_token','name','email','image','password','password-confirm']));
        // [ SAVE THE IMAGE ]
        if($request->hasFile('image') && $request->file('image')->isValid()){
          $path  = public_path(self::UPLOADS);
          $name = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
          $request->file('image')->move($path, $name);
          if($admin->image){
            File::delete($admin->image->path."/".$admin->image->name);
          }
          $image   = Image::firstorCreate(['user_id'=>$admin->id,]);
          $image->name = $name;
          $image->path = $path;
          $image->type = 'full';
          $image->save();
        }
        return redirect("dashboard/perfil")->with("message",'Perfil actualizado correctamente');
      }

      //debug function, para ver hora de servidor y desplegar lista de ev por realizar
      public function time($task){
        if($task ==='1'){
          $programs 	  = Program::where('notice_id',2)->firstOrfail();
          $users_in  = User::select('institution')->where('type','admin')->where('enabled',1)->distinct('institution')->orderBy('institution','asc')->get();
          foreach ($users_in as $institution) {
              echo 'Evaluaciones totales de '.$institution->institution.': ';
              echo(AspirantInstitution::where('institution',$institution->institution)->count().' Evaluaciones realizadas: ');
              echo(AspirantEvaluation::where('institution',$institution->institution)->whereNotNull('grade')->count().'<br>');
          }

        }else{
          echo date('Y-m-d H:i:s');
        }
      }
}
