<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Auth;
use Mail;
//Models
use App\Models\Aspirant;
use App\Models\AspirantActivation;
use App\Models\AspirantsFile;
use App\Models\AspirantNotice;
use App\Models\City;
use App\Models\Notice;
use App\User;
// FormValidators
use App\Http\Requests\SaveAspirant;
use App\Http\Requests\SaveFiles;
//Notifications
use App\Notifications\AspirantConfirmation;
use App\Notifications\AspirantCredentials;
class NoticeFront extends Controller
{
  /******************* funciones de convocatoria ************************/
      //convocatoria
      public function convocatoria(){
        $notice  = new Notice;
        $notice  = $notice->get_last_notice();
        return view('frontend.convocatoria.notice-front')->with([
          'notice' =>$notice,
        ]);
      }


	  //faqs
      public function faqs(){
        return view('frontend.convocatoria.faqs');
      }
      
      //convocatoria 2017
      public function convoca17(){
        return view('frontend.convocatoria.2017');
      }

      //resultados 2017
      public function resultado17(){
        return view('frontend.convocatoria.resultados2017');
      }

      //metodología 2017
      public function metodo17(){
        return view('frontend.convocatoria.metodologia');
      }

      //convocatoria/bases
      public function bases(){
        return view('frontend.convocatoria.bases');
      }

      //convocatoria/aplicar
      public function aplicar($notice_slug){
        $today  = date('Y-m-d');
        $notice  = Notice::where('slug',$notice_slug)->where('start','<=',$today)->where('end','>=',$today)->where('public',1)->firstOrFail();
        $cities	    =  City::all();
        return view('frontend.convocatoria.aplicar-1')->with([
          'notice' =>$notice,
          'cities' => $cities
        ]);
      }

      //Guardar aspirante
      public function saveAspirant(SaveAspirant $request){
        $data     = $request->except('email-confirm');
        $today  = date('Y-m-d');
        $notice  = Notice::where('slug',$request->notice_slug)->where('start','<=',$today)->where('end','>=',$today)->where('public',1)->firstOrFail();
        $aspirant = new Aspirant($data);
        $aspirant->is_activated = 0;
        $aspirant->save();
        $aspirant_notice  =  AspirantNotice::firstOrCreate(['aspirant_id'=>$aspirant->id,'notice_id'=>$notice->id]);
        $link     =  str_random(40);
        $activation = new AspirantActivation([
          'aspirant_id' => $aspirant->id,
          'token'       => $link
        ]);
        $activation ->save();
    /*    $from    = "info@apertus.org.mx";
        $subject = "Confirma tu dirección correo | Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible";
       //enviar correo para confirmar dirección de correo
        Mail::send('emails.confirmation', ['aspirant' => $aspirant,'link' =>$link], function($message) use ($aspirant,$link,$from, $subject) {
                $message->from($from, 'no-reply');
                $message->to($aspirant->email);
                $message->subject($from);
        });*/
        $aspirant->notify(new AspirantConfirmation($aspirant,$notice));

        return view('frontend.convocatoria.aplicar-message');

      }

      //convocatoria/aplicar/fin
      public function end(){
        return view('frontend.convocatoria.convocatoria-end');
      }


      //activar aspirantes
      public function aspirantActivation($notice_slug, $token){
        $notice = Notice::where('slug',$notice_slug)->firstOrFail();
        $code   = AspirantActivation::where('token',$token)->first();
        if($code){
          $aspirant = $code->aspirant;
          if($aspirant->is_activated == 1){
                $message = "Ya se encuentra validado";
          }else{
                $message = "Se ha validado tu correo";
                $aspirant->is_activated = 1;
                $aspirant->save();
          }
          session()->flash('aspirant_id', $aspirant->id);
          //usuarios nuevos
          $user = User::where('email',$aspirant->email)->first();
          if(!$user){
            $password  = str_random(10);
            $name      = $aspirant->name.' '.$aspirant->surname.' '.$aspirant->lastname;
            $new_user  = User::firstOrCreate(['name'=>$name, 'email'=>$aspirant->email,'password'=>bcrypt($password),'type'=>'aspirant']);
            $new_user->enabled = 1;
            $new_user->institution = $aspirant->origin;
            $new_user->save();
            $aspirant->code->delete();
            $new_user->notify(new AspirantCredentials($new_user,$password));
            return redirect('convocatoria/registro/fin')->with('success',"Se ha validado tu correo");
          }else{
            return redirect('login')->with('error',"Tu correo se encuentra activo en el sistema");
          }

        }else{
          return redirect("convocatoria/aplicar/$notice_slug")->with('error',"El código de activación es incorrecto o ha expirado");
        }
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
        $aspirantFile     = AspirantsFile::firstOrCreate(['aspirant_id'=>$aspirant_id]);
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
        //Eliminar token al terminar registro
        AspirantActivation::where('aspirant_id',$aspirant_id)->delete();
        return redirect('convocatoria/aplicar/fin')->with('success',"Tu registro se ha finalizado con éxito");
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
        if($request->input('state')==='Estado de México'){
          $cities = City::where('state', 'México' . '%')->orderBy('city', 'asc')->get();
        }else{
          $cities = City::where('state', 'like', $request->input('state') . '%')->orderBy('city', 'asc')->get();
        }
        return response()->json($cities);
      }

}
