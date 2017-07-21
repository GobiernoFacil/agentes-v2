@extends('layouts.admin.a_master')
@section('title', 'Ver actividad: ' . $activity->name)
@section('description', 'Ver actividad')
@section('body_class', 'modulos')
@section('breadcrumb_type', 'module session view activity')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')

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
		<h4>Actividad #{{$activity->order}} de la <a href="{{ url('/dashboard/sesiones/ver/'. $session->id) }}" class="link">sesión {{$session->order}}</a> del <a href="{{ url('dashboard/modulos/ver/'.$session->module->id) }}" class="link">módulo: {{$session->module->title}}</a></h4>
		<div class="divider b"></div>
		<h1><b class="icon_h {{$activity->type ? $activity->type  : 'default'}} list_s width_s"></b> {{$type}}: <strong>{{$activity->name}}</strong> <span class="notetime">(<b class="icon_h time"></b>{{$activity->duration}})</span> <span class="le_link right"><a href="{{url('dashboard/sesiones/actividades/editar/' . $activity->id)}}" class="btn view">Editar Actividad</a></span></h1>
	</div>
</div>
@if($activity->type == 'video')
	@if($activity->videos)
	<div class="row">
		<div class="col-sm-12">
			<div class="divider"></div>
			<div id="ytVideo"></div>
		</div>
	</div>
	@endif
@endif
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
</div>
@if($activity->slug ==='examen-diagnostico')
@include('admin.modules.activities.diagnostic-view')
@endif

@if($activity->type ==='evaluation' && $activity->files==='No' && $activity->slug !='examen-diagnostico')
@include('admin.modules.activities.evaluation-view')
@elseif($activity->type ==='evaluation' && $activity->files==='Sí' && $activity->slug !='examen-diagnostico')
<div class="box">
	<div class="row">
		<div class="col-sm-9">
			<h2 class="title">Evaluación</h2>
		</div>
		<div class="col-sm-8 col-sm-offset-2">
			<p>Carga de archivo</p>
		</div>
	</div>
</div>

@endif

<div class="box">
	<div class="row">
		<div class="col-sm-9">
			<h2 class="title">Recursos</h2>
		</div>
		<div class="col-sm-3">
			<p class="right"><a href='{{url("dashboard/sesiones/actividades/requerimientos/agregar/$activity->id")}}' class="btn xs ev">[+] Agregar recurso</a></p>
		</div>
		<div class="col-sm-12">
			@if($activity->activityRequirements->count() > 0)
			@include('admin.modules.activities.activities-requirements-list')
			@else
			<p>Sin recurso</p>
			<a href='{{url("dashboard/sesiones/actividades/requerimientos/agregar/$activity->id")}}' class="btn xs view">Agregar recurso</a>
			@endif
		</div>
	</div>
</div>

<!--archivos-->
<div class="box">
	<div class="row">
		<div class="col-sm-9">
			<h2 class="title">Archivos</h2>
		</div>
		<div class="col-sm-3">
			<p class="right"><a href='{{url("dashboard/sesiones/actividades/archivos/agregar/nuevo/$activity->id")}}' class="btn xs ev">[+] Agregar archivo</a></p>
		</div>
		<div class="col-sm-12">
			@if($activity->activityFiles->count() > 0)
			@include('admin.modules.activities.activities-files-list')
			@else
			<p>Sin archivos</p>
			<a href='{{url("dashboard/sesiones/actividades/archivos/agregar/nuevo/$activity->id")}}' class="btn xs view">Agregar archivo</a>
			@endif
		</div>
	</div>
</div>

<div class="divider"></div>
@if($activity->forum)
@include('layouts.forums.list-at-activity')
@else
<div class="box">
	<div class="row">
		<div class="col-sm-9">
			<h2 class="title">Foro</h2>
		</div>
		<div class="col-sm-12">
			<p>Sin Foro</p>
		</div>
	</div>
</div>
@endif


@if($activity->type == 'video')
	@if($activity->videos)
		<script>
			function getId(url) {
				var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
				var match = url.match(regExp);
				if (match && match[2].length == 11) {
					return match[2];
				} 
				else {
					return 'error';
    			}
			}

			var ytId = getId('{{$activity->videos->link}}');

			document.getElementById("ytVideo").innerHTML = '<iframe width="100%" height="555" src="//www.youtube.com/embed/' + ytId + '" frameborder="0" allowfullscreen></iframe>';
		</script>	
	@endif
@endif


@endsection
