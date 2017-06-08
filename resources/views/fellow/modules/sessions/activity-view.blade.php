@extends('layouts.admin.a_master')
@section('title', $activity->name )
@section('description', $activity->name)
@section('body_class', 'fellow aprendizaje modulos')
@section('breadcrumb_type', 'activity view')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_modules')

@section('content')

<div class="row">
	<div class="col-sm-12">
		<?php switch($activity->type) {
			case "lecture":
				$type = "Lectura";
				break;
			case "video":
				$type = "Video";
				break;
			case "evaluation":
				$type = "Evaluación";
				break;
			default:
			 $type = "Lectura";
		}
		?>
		@if(Session::has('success'))
		<div class="message success">
	      {{ Session::get('success') }}
	  	</div>
	  	@endif

			@if(Session::has('error'))
			<div class="message error">
		      {{ Session::get('error') }}
		  	</div>
		  	@endif
		<h4>Actividad #{{$activity->order}} de la <a href="{{ url('tablero/aprendizaje/'.$session->module->slug.'/'. $session->slug) }}" class="link">sesión {{$session->order}}</a> del <a href="{{ url('tablero/aprendizaje/'.$session->module->slug) }}" class="link">módulo: {{$session->module->title}}</a></h4>
		<div class="divider b"></div>
		<h1><b class="icon_h {{$activity->type ? $activity->type  : 'default'}} list_s width_s"></b> {{$type}}: <strong>{{$activity->name}}</strong> <span class="notetime">(<b class="icon_h time"></b>{{$activity->duration}})</span></h1>
	</div>
</div>

<div class="box">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<ul class="profile list row">
				<li class="col-sm-12"><span>Descripción:</span>{{$activity->description}}</li>
				<li class="col-sm-6"><span>Rol Facilitador:</span>{{$activity->facilitator_role}}</li>
				<li class="col-sm-6"><span>Rol Participantes:</span>{{$activity->competitor_role}}</li>
			</ul>
		</div>

	</div>
	@if($activity->slug ==='examen-diagnostico' && !$user->diagnostic)
	<div class="row">
		<div class="col-sm-3 col-sm-offset-1">
				<a href='{{ url("tablero/aprendizaje/examen-diagnostico/examen-diagnostico/examen/evaluar") }}' class="btn gde"><strong>+</strong> Ir a evaluación</a>
		</div>
	</div>
	@else
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<div class="box blue center">
				<h2>Ya respondiste el examen</h2>
			</div>
		</div>
	</div>
	@endif
</div>

@if($activity->activityRequirements->count() > 0)
<!-- recursos-->
<div class="box">
	<div class="row">
		<div class="col-sm-9">
			<h2 class="title">Recursos</h2>
  		</div>
  		<div class="col-sm-12">
  			@include('admin.modules.activities.activities-requirements-list')
  		</div>
  	</div>
</div>
@endif

@if($activity->activityFiles->count() > 0)
<!--archivos-->
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="title">Archivos</h2>
			@include('admin.modules.activities.activities-files-list')
		</div>
	</div>
</div>
@endif

@if($activity->forum)
<!--forum-->
<div class="box">
	<div class="row">
		<div class="col-sm-9">
			<h2 class="title">Foro</h2>
		</div>
		<div class="col-sm-3 center">
	    <a href='{{ url("tablero/foros/{$activity->forum->slug}/mensajes/agregar") }}' class="btn gde"><strong>+</strong> Agregar Mensaje</a>
	  </div>
	</div>

	@if($activity->forum->forum_messages)
		@foreach($activity->forum->forum_messages as $message)
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<p>{{$message->message}}</p>
				</div>
			</div>
		@endforeach
		<div class="row">
			<div class="col-sm-3 col-sm-offset-2 center">
				<a href='{{ url("tablero/foros/{$activity->forum->slug}/mensajes/agregar") }}' class="btn gde"><strong>+</strong> Agregar Mensaje</a>
			</div>
		</div>
	@else
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<p>No existen mensajes</p>
		</div>
	</div>
	@endif
</div>
@endif



@endsection
