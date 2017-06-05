@extends('layouts.admin.a_master')
@section('title', 'Ver sesión')
@section('description', 'Ver sesión')
@section('body_class', 'actividades')
@section('breadcrumb_type', 'session view')
@section('breadcrumb', 'layouts.facilitator.breadcrumb.b_activity')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h4>Información de sesión del módulo: {{$session->module->title}}</h4>
	</div>
	<div class="col-sm-12 center">
		<h4 class="center"></h4>
		<div class="divider b"></div>
		<h2>Sesión {{$session->order}}</h2>
		<h1 class="center">{{$session->name}}</h1>
		<div class="divider"></div>
	</div>
</div>

<!-- header -->
<div class="row h_tag">
	<div class="col-sm-3 center">
		<h4><b class="icon_h time"></b>Duración</h4>
		<p>{{$session->hours}} horas</p>
	</div>
	<div class="col-sm-3 center">
		<h4><b class="icon_h i_dates_green"></b> Fecha inicio</h4>
		<p>{{date("d-m-Y", strtotime($session->start))}}</p>
	</div>
	<div class="col-sm-3 center">
		<h4><b class="icon_h i_dates_green"></b> Fecha final</h4>
		<p>{{date('d-m-Y', strtotime($session->end))}}</p>
	</div>
	<div class="col-sm-3 center">
		<h4><b class="icon_h modalidad"></b> Modalidad</h4>
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
			<h2 class="title">Objetivo</h2>
			<p>{{$session->objective}}</p>
			<h2 class="title">Objetivos particulares</h2>
				@if($session->topics->count() > 0)
					@include('admin.modules.sessions.sessions-topics-list')
					<?php /*
					<a href='{{url("dashboard/sesiones/tematicas/agregar/$session->id")}}' class="btn xs ev"> + Agregar otro objetivo particular de la sesión</a>*/?>
				@else
					<p>Sin objetivos particulares</p>
					<a href='{{url("dashboard/sesiones/tematicas/agregar/$session->id")}}' class="btn xs ev"> + Agregar objetivos particulares de la sesión</a>
				@endif
		</div>
		
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
		</div>
		@endif
 	</div>
 </div>

<!---actividades-->
  <div class="box">
  	<div class="row">
	  	@if($session->activities->count() > 0)
  		<div class="col-sm-9">
  			<h2 class="title">Actividades</h2>
  		</div>
		<div class="col-sm-3">
		</div>
		<div class="col-sm-12">
			<div class="divider"></div>
		</div>
  		<div class="col-sm-12">
	  		@include('admin.modules.sessions.sessions-activities-list')
	  	</div>
		@else
		<div class="col-sm-12">
  			<h2 class="title">Actividades</h2>
			<p><span>Sin actividades</span></p>
		</div>
		@endif
	</div>
  </div>

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

<!--- mecanismos--->
  <div class="box">
  	<div class="row">
  		<div class="col-sm-12">
  			<h2 class="title">Mecanismos de Monitoreo y Evaluación</h2>
  			@if($session->evaluations->count() > 0)
				@include('admin.modules.sessions.sessions-monitoring-list')
			@else
			<p><span>Sin mecanismos</span></p>
		  	@endif
  		</div>
  	</div>
  </div>

@endsection
