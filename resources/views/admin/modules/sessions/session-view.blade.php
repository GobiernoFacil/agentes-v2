@extends('layouts.admin.a_master')
@section('title', 'Ver sesión')
@section('description', 'Ver sesión')
@section('body_class', 'module view session')
@section('breadcrumb_type', 'module session view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Información de sesión</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-6">
			<ul class="profile list">
				<li><span>Nombre:</span> <h2>{{$session->name}}</h2></li>
        <li><span>Módulo:</span> {{$session->module->title}}</li>
				<li><span>Fecha inicio:</span> {{date("d-m-Y", strtotime($session->start))}}</li>
				<li><span>Fecha final:</span> {{date('d-m-Y', strtotime($session->end))}}</li>
				<li><span>Número de sesión:</span> {{$session->order}}</li>
				<li><span>Total de horas:</span> {{$session->hours}}</li>
				<li><span>Modalidad:</span>{{$session->modality}}</li>
        <li><span>Objetivo:</span>{{$session->objective}}</li>
			</ul>
		</div>
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
		</div>
	</div>
</div>

  <div class="row">
  	<div class="col-sm-12">
  		<h1>Temáticas</h1>
  	</div>
  </div>
	@if($session->topics->count() > 0)
					@include('admin.modules.sessions.sessions-topics-list')
	@else
  <div class="box">
  	<div class="row">
          <span>Sin temáticas</span></br>
          <a href='{{url("dashboard/sesiones/tematicas/agregar/$session->id")}}' class="btn xs view">Agregar</a>
      </ul>
    </div>
  </div>
	@endif

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
