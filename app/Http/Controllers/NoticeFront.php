<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;
//Models
use App\Models\Aspirant;
use App\Models\AspirantActivation;
use App\Models\AspirantsFile;
// FormValidators
use App\Http\Requests\SaveAspirant;
use App\Http\Requests\SaveFiles;
class NoticeFront extends Controller
{
  /******************* funciones de convocatoria ************************/
      //convocatoria
      public function convocatoria(){
        return view('welcome');
      }

      //convocatoria/bases
      public function bases(){
        return view('welcome');
      }

      //convocatoria/aplicar
      public function aplicar(){
        return view('frontend.convocatoria.aplicar-1');
      }

      //Guardar aspirante
      public function saveAspirant(SaveAspirant $request){
        $data     = $request->except('email-confirm');
        $aspirant = new Aspirant($data);
        $aspirant->is_activated = 0;
        $aspirant->save();
        $link     =  str_random(40);
        $activation = new AspirantActivation([
          'aspirant_id' => $aspirant->id,
          'token'       => $link
        ]);
        $activation ->save();
       //enviar correo para confirmar dirección de correo
        Mail::send('emails.confirmation', ['aspirant' => $aspirant,'link' =>$link], function($message) use ($aspirant,$link) {
                $message->to($aspirant->email);
                $message->subject('Confirma tu dirección de correo');
        });

        return view('frontend.convocatoria.aplicar-message');

      }


      //activar aspirantes
      public function aspirantActivation($token){
        $code  = AspirantActivation::where('token',$token)->first();

        if(!is_null($code)){
          $aspirant = Aspirant::find($code->aspirant_id);
            if($aspirant->is_activated == 1){
                return redirect('convocatoria/aplicar')->with('success',"Ya se encuentra validado");
            }
            $aspirant->is_activated = 1;
            $aspirant->save();
            AspirantActivation::where('token',$token)->delete();
            session()->flash('aspirant_id', $aspirant->id);
            return redirect('convocatoria/aplicar/registro')->with('success',"Se ha validado tu correo");
        }
            return redirect('convocatoria/aplicar')->with('error',"El código de activación es incorrecto");
      }

      //view para agregar archivos
      public function aspirantFiles(){
        session()->keep(['aspirant_id']);
        $aspirant_id  = session()->get('aspirant_id');
        return view('frontend.convocatoria.archivos');
      }

      //Guardar archivos
      public function saveFiles(saveFiles $request){
        session()->keep(['aspirant_id']);
        $aspirant_id  = session()->get('aspirant_id');
        $aspirantFile     = new AspirantsFile(['aspirant_id'=>$aspirant_id]);
        if($request->file('cv')->isValid()){
            $name = uniqid() . "." . $request->file("cv")->guessExtension();
            $path = "/files/";
            $request->file('cv')->move(public_path() . $path, $name);
            $aspirantFile->cv = $name;
        }
        if($request->file('essay')->isValid()){
            $name = uniqid() . "." . $request->file("essay")->guessExtension();
            $path = "/files/";
            $request->file('essay')->move(public_path() . $path, $name);
            $aspirantFile->essay = $name;
        }
        $aspirantFile->video = $request->video;
        $aspirantFile->save();
        session()->keep(['aspirant_id']);
        return redirect('convocatoria/aplicar')->with('success',"Tu registro se ha finalizado con éxito");
      }

      //convocatoria/resultados
      public function resultados(){
        return view('welcome');
      }

}
