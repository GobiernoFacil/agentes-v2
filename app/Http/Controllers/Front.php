<?php

namespace App\Http\Controllers;
use App\Models\Program;
use App\Models\FellowData;
use App\Models\Notice;
use App\User;
use App\Models\ActivitiesFile;
use Illuminate\Http\Request;

class Front extends Controller
{
    //página de inicio
    public function index(){
      $today  = date('Y-m-d');
      $notice = Notice::where('start','<=',$today)->where('end','>=',$today)->where('public',1)->first();
      return view('frontend.home')->with([
        'notice' => $notice
      ]);
    }

    //descripcion
    public function descripcion(){
      return view('frontend.programas.que-es');
    }

    //programa 2017
    public function pro17(){
      return view('frontend.programas.2017.que-es');
    }

    //testimonios 2017
    public function testimony17(){
      return view('frontend.programas.2017.testimonio');
    }

    //testimonios 2017
    public function testimony18(){
      return view('frontend.programas.2018.testimonio');
    }

    //programa 2018
    public function pro18(){
      return view('frontend.programas.2018.que-es');
    }

    //programa 2018
    public function program($program_slug){
      if($program_slug === '2017'){
        return view('frontend.programas.2017.que-es');
      }
      $program = Program::where('slug',$program_slug)->firstOrFail();
      return view('frontend.programas.program-info')->with([
        'program' => $program
      ]);
    }

    //ver generacion
    public function generation($program_slug){
      $program = Program::where('slug',$program_slug)->firstOrFail();
      if(date_format(date_create($program->start),'Y')=='2017'){
        return redirect('programa-gobierno-abierto/2017');
      }
      $fellows = $program->get_all_fellows()->get();
      $states  = FellowData::select('state')->whereIn('user_id',$fellows->pluck('id')->toArray())->orderBy('state','asc')->distinct('state')->get();
      return view('frontend.programas.program-generation')->with([
        'program' => $program,
        'fellows' => $fellows,
        'states'  => $states
      ]);
    }

    //Ver contenido
    public function content($program_slug){
      $program = Program::where('slug',$program_slug)->firstOrFail();
      if(date_format(date_create($program->start),'Y')=='2017'){
        return redirect('programa-gobierno-abierto/2017');
      }
      $fellows = $program->get_all_fellows()->get();
      $states  = FellowData::select('state')->whereIn('user_id',$fellows->pluck('id')->toArray())->orderBy('state','asc')->distinct('state')->get();

      return view('frontend.programas.program-content')->with([
        'program' => $program,
        'states'  => $states
      ]);
    }
   //ver fellow
   public function viewFellow($program_slug,$fellow_slug){
     $program = Program::where('slug',$program_slug)->firstOrFail();
     if(date_format(date_create($program->start),'Y')=='2017'){
       return redirect('programa-gobierno-abierto/2017');
     }
     $name    = ucwords(str_replace('-', ' ', $fellow_slug));
     $fellow  = User::where('name',$name)->firstOrFail();
     return view('frontend.programas.program-view-fellow')->with([
       'program' => $program,
       'fellow'  => $fellow,
       'slug'    => $fellow_slug
     ]);
   }

    //objetivos
    public function antecedentes(){
      return view('frontend.programas.antecedentes');
    }

    //aliados
    public function aliados(){
      return view('frontend.programas.allies');
    }

    //contacto
    public function contacto(){
      return view('frontend.contacto');
    }

    //politicas-de-privacidad
    public function politicas(){
      return view('frontend.privacidad');
    }


    //politicas-de-privacidad
    public function privacidadAgentes(){
      return view('frontend.privacidad-red');
    }

    //proyectos
    public function projects(){
      $states = ['Campeche','Chihuahua','Oaxaca','Quintana Roo','Tlaxcala','Veracruz'];
      return view('frontend.projects')->with(['states'=>$states]);
    }

    public function projectsState($slug){
      $state = ucwords(str_replace('-', ' ', $slug));
      $slug_n  = str_replace('-','_',$slug);
      return view('frontend.projects-state')->with(['state'=>$state,'slug'=>$slug,'slug_n'=>$slug_n ]);
    }

    public function projectDownload($slug){
      $state   = ucwords(str_replace('-', ' ', $slug));
      $slug_n  = str_replace('-','_',$slug);
      $file    = public_path().'/archivos/estados/'.$slug.'/'.$slug_n.'.zip';
      $fileData = pathinfo($file);
      $filename = $slug_n.'_descargables.zip';
      $headers = array(
        'Content-Type: '.$fileData['extension']
      );
      return response()->download($fileData['dirname'].'/'.$fileData['basename'],$filename, $headers);
    }

    //red
    public function network(){
      return view('frontend.network');
    }

    public function networkDownload($name){
      $file    = public_path().'/archivos/red/'.$name.'.pdf';
      $fileData = pathinfo($file);
      $filename = $name.'.pdf';
      $headers = array(
        'Content-Type: '.$fileData['extension']
      );
      return response()->download($fileData['dirname'].'/'.$fileData['basename'], $filename,$headers);
    }


    //redes-sociales
    public function redes(){
      return view('welcome');
    }

    /**
     * Genera descarga pdf
     *
     * @return \Illuminate\Http\Response
     */
    public function download($type)
    {
      if($type==='seminaro-1'){
          $path  = public_path().'/archivos/Programa_Primer_Seminario_Internacional.pdf';
          $name  = 'Programa_Primer_Seminario_Internacional.pdf';
      }elseif($type==='seminaro-2'){
          $path  = public_path().'/archivos/Agenda_2ndoSeminario_Internacional.pdf';
          $name  = 'Agenda_2ndoSeminario_Internacional.pdf';
      }elseif($type==='guia-co'){
        $path  = public_path().'/archivos/guiacocreaciondecompromisos.pdf';
        $name = 'guiacocreaciondecompromisos.pdf';
      }elseif($type==='guia-tl'){
        $path  = public_path().'/archivos/guiastl.pdf';
        $name = 'guiastl.pdf';
      }elseif($type==='taller_diagnostico'){
        $path  = public_path().'/archivos/taller_1_gesoc_diagnostico.pptx';
        $name ='taller_1_gesoc_diagnostico.pptx';
      }else{
        return redirect('/');
      }

      $fileData = pathinfo($path);
      $headers = array(
        'Content-Type: '.$fileData['extension'],
      );
      return response()->download($fileData['dirname'].'/'.$fileData['basename'], $name, $headers);
    }

    /**
    *descargar archivo
    *
    * @return \Illuminate\Http\Response
    */
    public function watchFile(Request $request){
      $data = ActivitiesFile::where('identifier',$request->identifier)->firstOrFail();
      $file = $data->path.'/'.$data->identifier;
      $fileData = pathinfo($file);
      $headers = array(
        'Content-Type: '.$fileData['extension'],
      );
      $filename = $data->name.".".$fileData['extension'];
      return response()->file($fileData['dirname'].'/'.$fileData['basename'], $headers);
    }

}
