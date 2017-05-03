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
				<li><span>Procedencia:</span> {{$aspirant->origin ? $aspirant->origin : "Sin información"}}</li>
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
				<li class="download"><a href='{{url("dashboard/archivo/download/{$aspirant->AspirantsFile->letter}/carta")}}'  class="btn view xs"> Descargar Carta Membretada</a></li>
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
				@if($aspirantEvaluation)
				<h3>Evaluación de {{$user->institution}}</h3>
				<li><span>Experiencia previa:</span> {{($aspirantEvaluation->experienceGrade*10).'%'}}</li>
				<li><span>Valoración ensayo:</span> {{($aspirantEvaluation->essayGrade*10).'%'}}</li>
				<li><span>Valoración video:</span> {{($aspirantEvaluation->videoGrade*10).'%'}}</li>
				<li><span>Evaluación:</span> {{($aspirantEvaluation->grade*10).'%'}}</li>
				@else
				<li class="right"><span>Sin evaluar</span>
				<a href="{{ url('dashboard/aspirantes/evaluar-archivos/' . $aspirant->id) }}" class="btn xs view">Evaluar</a></li>
				@endif
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<h1>Evaluación General: {{$generalGrade.'%'}}</h1>
	</div>
</div>
@if($allEva->count() > 0)
<div class="box">
	<div class="row">
		@foreach($allEva as $eva)
		<div class="col-sm-6">
			<ul class="profile list">
				@if($eva->grade)
				<li><span>Institución:</span> {{($eva->institution)}}</li>
				<li><span>Evaluación:</span> {{($eva->grade*10).'%'}}</li>
				@endif
			</ul>
		</div>
		@endforeach
	</div>
</div>
@else
<li class="right"><span>Sin evaluar</span>
<a href="{{ url('dashboard/aspirantes/evaluar-archivos/' . $aspirant->id) }}" class="btn xs view">Evaluar</a></li>
@endif
@endsection
