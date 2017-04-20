@extends('layouts.admin.a_master')
@section('title', 'Ver sesión')
@section('description', 'Ver sesión')
@section('body_class', 'modulos view session')
@section('breadcrumb_type', 'module session view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h4>Información de sesión del <a href="{{ url('dashboard/modulos/ver/'.$session->module->id) }}" class="link">módulo: {{$session->module->title}}</a></h4>
	</div>
	<div class="col-sm-12 center">
		<h4 class="center"></h4>
		<div class="divider b"></div>
		<h2>Sesión {{$session->order}}</h2>
		<h1 class="center">{{$session->name}} <span class="le_link"><a href="{{ url('dashboard/sesiones/editar/'. $session->module->id ) }}" class="btn view">Editar sesión</a></span></h1>
		<div class="divider"></div>
	</div>
</div>

<!-- header -->
<div class="row h_tag">
	<div class="col-sm-3 center">
		<h4>Duración</h4>
		<p>{{$session->hours}} horas</p>
	</div>
	<div class="col-sm-3 center">
		<h4>Fecha inicio</h4>
		<p>{{date("d-m-Y", strtotime($session->start))}}</p>
	</div>
	<div class="col-sm-3 center">
		<h4>Fecha final</h4>
		<p>{{date('d-m-Y', strtotime($session->end))}}</p>
	</div>
	<div class="col-sm-3 center">
		<h4>Modalidad</h4>
		<p>{{$session->modality}}</p>
	</div>
	<div class="col-sm-12">
		<div class="divider top"></div>
	</div>
</div>

<!--- objetivos-->
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="title">Objetivo <span class="le_link right"><a href="{{ url('dashboard/sesiones/editar/'. $session->module->id ) }}" class="btn view">Editar objetivo</a></span></h2>
			<p>{{$session->objective}}</p>
			<h2 class="title">Objetivos particulares {!! $session->topics->count() == 0 ? '' : '<span class="le_link right"><a href="' .  url('dashboard/sesiones/editar/'. $session->module->id ) .'" class="btn view">Editar objetivos particulares</a></span>' !!}</h2>
				@if($session->topics->count() > 0)
					@include('admin.modules.sessions.sessions-topics-list')
				@else
					<p>Sin objetivos particulares</p>
					<a href='{{url("dashboard/sesiones/tematicas/agregar/$session->id")}}' class="btn xs ev"> + Agregar objetivos particulares de la sesión</a>
				@endif
		</div>
		<?php /* delete ASAP
		<div class="col-sm-6">
			<ul class="profile list">
				<li class="right"><span>Agregar actividad</span>
				<a href='{{ url("dashboard/sesiones/actividades/agregar/$session->id") }}' class="btn xs view">Agregar</a></li>
				<li class="right"><span>Asignar Facilitador</span>
				<a href='{{ url("dashboard/sesiones/facilitadores/asignar/$session->id") }}' class="btn xs view">Asignar</a></li>
				<li class="right"><span>Agregar temática</span>
				<a href='{{ url("dashboard/sesiones/tematicas/agregar/$session->id") }}' class="btn xs view">Agregar</a></li>
				<li class="right"><span>Agregar Mecanismos de Monitoreo y Evaluación</span>
				<a href='{{url("dashboard/sesiones/mecanismos-monitoreo/agregar/$session->id")}}' class="btn xs view">Agregar</a></li>
				<!--
				<li class="right"><span>Agregar requisitos previos</span>
				<a href='{{ url("dashboard/sesiones/requisitos/agregar/$session->id") }}' class="btn xs view">Agregar</a></li>
			  -->
			</ul>
		</div>*/?>
	</div>
</div>


	<!---actividades-->
  <div class="row">
  	<div class="col-sm-12">
  		<h1>Actividades</h1>
  	</div>
  </div>
	@if($session->activities->count() > 0)
					@include('admin.modules.sessions.sessions-activities-list')
	@else
  <div class="box">
  	<div class="row">
          <span>Sin actividades</span></br>
          <a href='{{url("dashboard/sesiones/actividades/agregar/$session->id")}}' class="btn xs view">Agregar</a>
      </ul>
    </div>
  </div>
	@endif
	<!--
  <div class="row">
  	<div class="col-sm-12">
  		<h1>Requisitos Previos</h1>
  	</div>
  </div>
	@if($session->requirements->count() > 0)
					@include('admin.modules.sessions.sessions-requirements-list')
	@else
  <div class="box">
  	<div class="row">
          <span>Sin requisitos previos</span></br>
          <a href='{{url("dashboard/sesiones/requisitos/agregar/$session->id")}}' class="btn xs view">Agregar</a>
      </ul>
    </div>
  </div>
	@endif
-->

  <div class="row">
  	<div class="col-sm-12">
  		<h1>Mecanismos de Monitoreo y Evaluación</h1>
  	</div>
  </div>
	@if($session->evaluations->count() > 0)
			@include('admin.modules.sessions.sessions-monitoring-list')
	@else
  <div class="box">
  	<div class="row">
          <span>Sin información</span></br>
          <a href='{{url("dashboard/sesiones/mecanismos-monitoreo/agregar/$session->id")}}' class="btn xs view">Agregar</a>
      </ul>
    </div>
  </div>
 @endif
 <div class="row">
	<div class="col-sm-12">
		<h1>Facilitadores de la sesión</h1>
	</div>
 </div>
 @if($session->facilitators->count() > 0)
		 @include('admin.modules.sessions.sessions-facilitators-list')
 @else
	<div class="box">
	 <div class="row">
					<span>Sin información</span></br>
					<a href='{{ url("dashboard/sesiones/facilitadores/asignar/$session->id") }}' class="btn xs view">Asignar</a>
			</ul>
		</div>
	</div>
 @endif
@endsection
