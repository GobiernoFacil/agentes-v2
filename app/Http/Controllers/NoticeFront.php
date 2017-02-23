<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;
//Models
use App\Models\Aspirant;
use App\Models\AspirantActivation;
// FormValidators
use App\Http\Requests\SaveAspirant;
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
            return redirect('convocatoria/aplicar/archivos')->with('success',"Se ha validado tu correo");
        }
            return redirect('convocatoria/aplicar')->with('error',"El código es incorrecto");
      }



      //convocatoria/resultados
      public function resultados(){
        return view('welcome');
      }

}
