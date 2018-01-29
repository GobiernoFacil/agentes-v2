<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\Aspirant;
use App\Models\Image;
use App\Models\AspirantsFile;

use Auth;
use File;
// FormValidators
use App\Http\Requests\UpdateAspirantProfile;
class AspirantDash extends Controller
{

	// En esta carpeta se guardan las imágenes de los usuarios
  const UPLOADS = "img/users";
    //

    public function dashboard(){
	  	$user 		   = Auth::user();
	    $notices       = $user->aspirant($user)->notices;
	    $single       = $notices->first();
	    $aspirantFile     = AspirantsFile::firstOrCreate([
        'aspirant_id'=>$user->aspirant($user)->id,
        'notice_id'=>$single->id,
        'user_id'=>$user->id
      ]);
	    return view('aspirant.dashboard')->with([
	      "user"      	  => $user,
	      "single"        => $single,
	      "aspirantFile"  => $aspirantFile
	    ]);

    }


  /**
  * Ver usuario aspirante
  *
  * @return \Illuminate\Http\Response
  */
  public function viewProfile()
  {
    $user 			  = Auth::user();
    return view('aspirant.profile.profile-view')->with([
      "user"      		=> $user,
    ]);
  }

  /**
  * edita perfil del usuario aspirante
  *
  * @return \Illuminate\Http\Response
  */
  public function editProfile()
  {
    	$user = Auth::user();
        return view('aspirant.profile.profile-update')->with([
          "user"      => $user
        ]);
  }

   /**
  * Actualiza perfil del usuario aspirante
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function saveProfile(UpdateAspirantProfile $request)
  {

	$user = Auth::user();
    $user->name  = $request->name;

    //update user data
    if(!empty($request->password)){
      $data   = $request->only(['name','password']);
      $data['password'] = bcrypt($request->password);
    }else {
      $data   = $request->only(['name']);
    }

	$user->update($data);
    //update aspirant data
    Aspirant::where('email',$user->email)->update($request->only(['degree']));
    // [ SAVE THE IMAGE ]
    if($request->hasFile('image') && $request->file('image')->isValid()){
      $path  = public_path(self::UPLOADS);
      $name = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
      $request->file('image')->move($path, $name);
      if($user->image){
        File::delete($user->image->path."/".$user->image->name);
      }
      $image   = Image::firstorCreate(['user_id'=>$user->id,]);
      $image->name = $name;
      $image->path = $path;
      $image->type = 'full';
      $image->save();
    }
    return redirect("tablero-aspirante/perfil")->with('success',"Se ha actualizado correctamente");
  }

  /**
  * politicas de privacidad
  *
  * @return \Illuminate\Http\Response
  */
  public function privacyPolices()
  {
      $user = Auth::user();
        return view('aspirant.privacy-polices')->with([
          "user"      => $user
        ]);
  }
}
