<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;
//Models
use App\Models\Aspirant;
use App\Models\AspirantActivation;
use App\Models\AspirantsFile;
use App\Models\City;
// FormValidators
use App\Http\Requests\SaveAspirant;
use App\Http\Requests\SaveFiles;
class NoticeFront extends Controller
{
  /******************* funciones de convocatoria ************************/
      //convocatoria
      public function convocatoria(){
        return view('frontend.convocatoria.info');
      }

      //convocatoria/bases
      public function bases(){
        return view('frontend.convocatoria.bases');
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
        $from    = "info@apertus.org.mx";
        $subject = "Confirma tu dirección correo | Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible";
       //enviar correo para confirmar dirección de correo
        Mail::send('emails.confirmation', ['aspirant' => $aspirant,'link' =>$link], function($message) use ($aspirant,$link,$from, $subject) {
                $message->from($from, 'no-reply');
                $message->to($aspirant->email);
                $message->subject($from);
        });

        return view('frontend.convocatoria.aplicar-message');

      }


      //activar aspirantes
      public function aspirantActivation($token){
        $code  = AspirantActivation::where('token',$token)->first();

        if($code->aspirant_id){
          $aspirant = Aspirant::find($code->aspirant_id);
            if($aspirant->is_activated == 1){
                return redirect('convocatoria/aplicar')->with('success',"Ya se encuentra validado");
            }
            $aspirant->is_activated = 1;
            $aspirant->save();
            session()->flash('aspirant_id', $aspirant->id);
            return redirect('convocatoria/aplicar/registro')->with('success',"Se ha validado tu correo");
        }
            return redirect('convocatoria/aplicar')->with('error',"El código de activación es incorrecto");
      }

      //view para agregar archivos
      public function aspirantFiles(){
        session()->keep(['aspirant_id']);
        $aspirant_id  = session()->get('aspirant_id');
        return view('frontend.convocatoria.archivos')->with(['aId' =>$aspirant_id]);
      }

      //Guardar archivos
      public function saveFiles(saveFiles $request){
        session()->keep(['aspirant_id']);
        $aspirant_id  = $request->aId;
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
        if($request->file('letter')->isValid()){
            $name = uniqid() . "." . $request->file("letter")->guessExtension();
            $path = "/files/";
            $request->file('letter')->move(public_path() . $path, $name);
            $aspirantFile->letter = $name;
        }
        if($request->file('proof')->isValid()){
            $name = uniqid() . "." . $request->file("proof")->guessExtension();
            $path = "/files/";
            $request->file('proof')->move(public_path() . $path, $name);
            $aspirantFile->proof = $name;
        }
        if($request->file('privacy')->isValid()){
            $name = uniqid() . "." . $request->file("privacy")->guessExtension();
            $path = "/files/";
            $request->file('privacy')->move(public_path() . $path, $name);
            $aspirantFile->privacy = $name;
        }
        $aspirantFile->video = $request->video;
        $aspirantFile->save();
        session()->keep(['aspirant_id']);
        AspirantActivation::where('aspirant_id',$aspirant_id)->delete();
        return redirect('convocatoria/aplicar')->with('success',"Tu registro se ha finalizado con éxito");
      }

      //convocatoria/resultados
      public function resultados(){
        return view('welcome');
      }

      /**
       * Get cities
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function cities(Request $request){
        $cities = City::where('state', 'like', $request->input('state') . '%')->orderBy('city', 'asc')->get();
        return response()->json($cities);
      }

}
