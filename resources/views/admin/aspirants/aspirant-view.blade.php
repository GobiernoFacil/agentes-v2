@extends('layouts.admin.a_master')
@section('title', 'Lista de Aspirantes')
@section('description', 'Lista de Aspirantes')
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirantes ver')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_aspirantes')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Perfil de Aspirante</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-6">
			<ul class="profile list">
				<li><span>Nombre:</span> <h2>{{$aspirant->name." ".$aspirant->surname." ".$aspirant->lastname}}</h2></li>
				<li><span>Email:</span> {{$aspirant->email}}</li>
				<li><span>Ciudad:</span> {{$aspirant->city}}</li>
				<li><span>Estado:</span> {{$aspirant->state}}</li>
				<li><span>Fecha de creación</span>{{ date("d-m-Y, H:i", strtotime($aspirant->created_at)) }} hrs.</li>
				
				@if($aspirant->AspirantsFile)
				@if($aspirant->AspirantsFile->video)
				<li><span>Video:</span> {{$aspirant->AspirantsFile->video}}</li>
				@endif
				@if($aspirant->AspirantsFile->cv)
				<li class="download"><a href='{{url("dashboard/archivo/download/{$aspirant->AspirantsFile->cv}/CV")}}'  class="btn view xs"> Descargar Perfil Curricular</a></li>
				@endif
				@if($aspirant->AspirantsFile->essay)
				<li class="download"><a href='{{url("dashboard/archivo/download/{$aspirant->AspirantsFile->essay}/ensayo")}}'  class="btn view xs"> Descargar Ensayo</a></li>
				@endif
				@if($aspirant->AspirantsFile->letter)
				<li class="download"><a href='{{url("dashboard/archivo/download/{$aspirant->AspirantsFile->letter}/carta")}}'  class="btn view xs"> Descargar Carta de Membretada</a></li>
				@endif
				@if($aspirant->AspirantsFile->proof)
				<li class="download"><a href='{{url("dashboard/archivo/download/{$aspirant->AspirantsFile->proof}/comprobante")}}'  class="btn view xs"> Descargar Comprobante de Domicilio</a></li>
				@endif
				@if($aspirant->AspirantsFile->privacy)
				<li class="download"><a href='{{url("dashboard/archivo/download/{$aspirant->AspirantsFile->privacy}/privacidad")}}'  class="btn view xs"> Descargar Consentimiento Relativo Al Tratamiento de sus Datos Personales</a></li>
				@endif
				@endif
				
			</ul>
		</div>
		<div class="col-sm-6">
			<ul class="profile list">
				@if($aspirant->aspirantEvaluation)
				<li><span>Experiencia previa:</span> {{($aspirant->aspirantEvaluation->experienceGrade*10).'%'}}</li>
				<li><span>Valoración ensayo:</span> {{($aspirant->aspirantEvaluation->essayGrade*10).'%'}}</li>
				<li><span>Valoración video:</span> {{($aspirant->aspirantEvaluation->videoGrade*10).'%'}}</li>
				<li><span>Evaluación:</span> {{($aspirant->aspirantEvaluation->grade*10).'%'}}</li>
				@else
				<li class="right"><span>Sin evaluar</span>
				<a href="{{ url('dashboard/aspirantes/evaluar/' . $aspirant->id) }}" class="btn xs view">Evaluar</a></li>
				@endif
			</ul>
		</div>
	</div>
</div>
@endsection