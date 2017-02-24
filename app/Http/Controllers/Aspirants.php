<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;
//Models
use App\Models\Aspirant;
use App\Models\AspirantsFile;
class Aspirants extends Controller
{

  //Paginación
  public $pageSize = 10;
    /**
     * Lista de aspirantes
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
      $aspirants = Aspirant::where('is_activated',1)->paginate($this->pageSize);
      return view('admin.aspirants.aspirant-list')->with([
        'user' => $user,
        'aspirants' =>$aspirants
      ]);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        //
        $user = Auth::user();
        $aspirant = Aspirant::find($id);
        return view('admin.aspirants.aspirant-view')->with([
          'user' => $user,
          'aspirant' =>$aspirant
        ]);
    }

    public function download($name,$type){
      $user = Auth::user();
      $file = public_path(). "/files/".$name;
      $ext  = substr(strrchr($file,'.'),1);
      $mime = mime_content_type ($file);
      $headers = array(
        'Content-Type: '.$mime,
      );
      if($type =='CV'){
        $filename = 'CV'.".".$ext;
      }else{
        $filename = 'Ensayo'.".".$ext;
      }
      return response()->download($file, $filename, $headers);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    }
}
