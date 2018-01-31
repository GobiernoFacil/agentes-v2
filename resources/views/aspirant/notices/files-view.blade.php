@extends('layouts.admin.a_master')
@section('title', 'Archivos de convocatoria '.$notice->title )
@section('description', 'Archivos de convocatoria '.$notice->title.' - '.$user->name)
@section('body_class', 'aspirante convocatoria')
@section('breadcrumb_type', 'notice files view')
@section('breadcrumb', 'layouts.aspirant.breadcrumb.b_notices')

@section('content')

<!-- title -->

<div class="row">
	<div class="col-sm-12">
		 <h1 class="center">{{$notice->title}}</h1>
	</div>
</div>

@if($files)
<div class="box">
 <div class="row">
	 <h3 class ="center">Tus archivos en la convocatoria</h3>

	 <div class="col-sm-8">
		 <ul class="profile list">
			 <li><span>Video:</span> <a href ="{{$files->video}}" target="_blank">Ir al video</li>
			 <li class="download"><span>Perfil Curricular:</span> <a href='{{url("tablero-aspirante/archivo/download/{$files->cv}/CV")}}'  class="btn view xs"> Descargar</a></li>
			 <li class="download"><span>Ensayo:</span> <a href='{{url("tablero-aspirante/archivo/download/{$files->essay}/ensayo")}}'  class="btn view xs"> Descargar</a></li>
			 <li class="download"><span>Carta Membretada:</span> <a href='{{url("tablero-aspirante/archivo/download/{$files->letter}/carta")}}'  class="btn view xs"> Descargar</a></li>
			 <li class="download"><span>Comprobante de Domicilio:</span> <a href='{{url("tablero-aspirante/archivo/download/{$files->proof}/comprobante")}}'  class="btn view xs"> Descargar</a></li>
			 <li class="download"><span>Consentimiento Relativo Al Tratamiento de sus Datos Personales:</span> <a href='{{url("tablero-aspirante/archivo/download/{$files->privacy}/privacidad")}}'  class="btn view xs"> Descargar </a></li>
		 </ul>
	 </div>
   <?php $today = date('Y-m-d');?>
	 @if($today <= $notice->end)
	 <div class="col-sm-3 right">
		 <a class = "btn view" href='{{url("tablero-aspirante/convocatorias/$notice->slug/actualizar-archivos")}}'>Actualizar archivos</a>
 	</div>
	@endif
 </div>
</div>
@else
<div class="box">
	<div class="row center">
		<h2>Aún no cuentas con archivos</h2>
		<p><a class= "btn view" href='{{url("tablero-aspirante/convocatorias/$notice->slug/agregar-archivos")}}'>Agregar archivos</a></p>
	</div>
</div>
@endif
@endsection
