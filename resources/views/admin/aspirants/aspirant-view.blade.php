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
				<li><span>Nivel de estudios:</span> {{$aspirant->degree}}</li>
				<li><span>Procedencia:</span> {{$aspirant->origin ? $aspirant->origin : "Sin información"}}</li>
				<li><span>Ciudad:</span> {{$aspirant->city}}</li>
				<li><span>Estado:</span> {{$aspirant->state}}</li>
				<li><span>Fecha de creación</span>{{ date("d-m-Y, H:i", strtotime($aspirant->created_at)) }} hrs.</li>

				@if($aspirant->AspirantsFile)
				@if($aspirant->AspirantsFile->motives)
				<li class="download"><a href='{{url("dashboard/aspirantes/convocatoria/$notice->id/download/$aspirant->id/motivos")}}'  class="btn view xs"> Descargar exposición de motivos</a></li>
				@endif

				@if($aspirant->cv)
				<li class="download"><a href='{{url("dashboard/aspirantes/convocatoria/$notice->id/download/$aspirant->id/cv")}}'  class="btn view xs"> Descargar Perfil Curricular</a></li>
				@endif

				@if($aspirant->AspirantsFile->video)
				<li><span>Video:</span> <a class ="btn view" href="{{$aspirant->AspirantsFile->video}}" target="_blank">Ir al video</a></li>
				@endif

				@if($aspirant->AspirantsFile->proof)
				<li class="download"><a href='{{url("dashboard/aspirantes/convocatoria/$notice->id/comprobante/{$aspirant->AspirantsFile->proof}")}}'  class="btn view xs"> Descargar Comprobante de Domicilio</a></li>
				@endif


				<li><span>Políticas de Privacidad:</span> <strong> {{$aspirant->AspirantsFile->privacy_policies ? "De acuerdo" : "No de acuerdo"}}</strong></li>
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
