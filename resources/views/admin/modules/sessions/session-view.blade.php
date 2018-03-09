@extends('layouts.admin.a_master')
@section('title', 'Ver sesión')
@section('description', 'Ver sesión')
@section('body_class', 'modulos')
@section('breadcrumb_type', 'module session view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h4>Información de sesión del <a href='{{ url("dashboard/programas/{$session->module->program->id}/modulos/ver/{$session->module->id}") }}' class="link">módulo: {{$session->module->title}}</a></h4>
	</div>
	<div class="col-sm-12 center">
		<h4 class="center"></h4>
		<div class="divider b"></div>
		<h2>Sesión {{$session->order}}</h2>
		<h1 class="center">{{$session->name}} <span class="le_link"><a href='{{ url("dashboard/programas/{$session->module->program->id}/modulos/{$session->module->id}/sesiones/editar/$session->id")}}' class="btn view">Editar sesión</a></span></h1>
		<div class="divider"></div>
	</div>
</div>

 <!--- facilitadores--->
 <div class="box">
 	<div class="row">
		@if($session->facilitators->count() > 0)
		<div class="col-sm-9">
			<h2 class="title">Facilitadores de la sesión</h2>
		</div>
		<div class="col-sm-3">
			<a href='{{ url("dashboard/sesiones/facilitadores/asignar/$session->id") }}' class="btn xs ev">Asignar más facilitadores</a>
		</div>
		<div class="col-sm-12">
			<div class="divider"></div>
		</div>
		<div class="col-sm-12">
				@include('admin.modules.sessions.sessions-facilitators-list')
		</div>
		@else
		<div class="col-sm-12">
			<h2 class="title">Facilitadores de la sesión</h2>
			<p>Sin facilitadores asignados</p>
			<a href='{{ url("dashboard/programas/{$session->module->program->id}/modulos/{$session->module->id}/sesiones-facilitadores/asignar/{$session->id}") }}' class="btn xs ev">Asignar facilitadores</a>
		</div>
		@endif
 	</div>
 </div>

<!---actividades-->
  <div class="box">
  	<div class="row">
	  	@if($session->activities->count() > 0)
  		<div class="col-sm-9">
  			<h2 class="title">Actividad</h2>
  		</div>
		<div class="col-sm-12">
			<div class="divider"></div>
		</div>
  		<div class="col-sm-12">
	  		@include('admin.modules.sessions.sessions-activities-list')
	  	</div>
		@else
		<div class="col-sm-12">
  			<h2 class="title">Actividad</h2>
			<p><span>Sin actividad</span></p>
			<a href='{{url("dashboard/sesiones/actividades/agregar/$session->id")}}' class="btn xs ev">Agregar actividad</a>
		</div>
		@endif
	</div>
  </div>



@endsection
