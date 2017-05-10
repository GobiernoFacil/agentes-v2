@extends('layouts.admin.a_master')
@section('title', 'Ver actividad: ' . $activity->name)
@section('description', 'Ver actividad')
@section('body_class', 'modulos session activity')
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
<div class="box">
  <div class="row">
  	<div class="col-sm-9">
  	  <h2 class="title">Recursos</h2>
  	</div>
  	<div class="col-sm-3">
  	   <p class="right"><a href='{{url("dashboard/sesiones/actividades/requerimientos/agregar/$activity->id")}}' class="btn xs ev">Agregar requerimiento</a></p>
  	</div>
  	<div class="col-sm-12">  
  		@if($activity->activityRequirements->count() > 0)
  	      @include('admin.modules.activities.activities-requirements-list')
  		@else
  		    <p>Sin requerimientos</p>
  	      <a href='{{url("dashboard/sesiones/actividades/requerimientos/agregar/$activity->id")}}' class="btn xs view">Agregar requerimiento</a>
  		@endif
  	</div>
  </div>
</div>

<!--archivos-->
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="title">Archivos</h2>
			@if($activity->activityFiles->count() > 0)
			    @include('admin.modules.activities.activities-files-list')
			@else
				<p>Sin archivos</p>
				<a href='{{url("dashboard/sesiones/actividades/archivos/agregar/$activity->id")}}' class="btn xs view">Agregar archivo</a>
			@endif
		</div>
	</div>
</div>
@endsection
