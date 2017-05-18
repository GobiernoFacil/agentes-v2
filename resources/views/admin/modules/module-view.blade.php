@extends('layouts.admin.a_master')
@section('title', 'Ver módulo '. $module->title)
@section('description', 'Ver módulo')
@section('body_class', 'modulos view')
@section('breadcrumb_type', 'module view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')
@section('content')

<!-- title -->
<div class="row">
	<div class="col-sm-12">
		<h1 class="center">{{$module->title}} <span class="le_link"><a href="{{url('dashboard/modulos/editar/' . $module->id)}}" class="btn view">Editar Módulo</a></span></h1>
		<p class="center date">{{date("d-m-Y", strtotime($module->start))}} al {{date('d-m-Y', strtotime($module->end))}}</p>
		<div class="divider"></div>
	</div>
</div>
<!-- header -->
<div class="row h_tag">
	<div class="col-sm-3 center">
		<h4><b class="icon_h time"></b> Duración</h4>
		<p>{{$module->number_hours}} horas</p>
	</div>
	<div class="col-sm-3 center">
		<h4><b class="icon_h session"></b> # Sesiones</h4>
		<p>{{$module->number_sessions}}</p>
	</div>
	<div class="col-sm-3 center">
		<h4><b class="icon_h modalidad"></b> Modalidad</h4>
		<p>{{$module->modality}}</p>
	</div>
	<div class="col-sm-3 center">
		<h4><b class="icon_h {{$module->public ? 'publicado' : 'no_p'}} "></b>Publicado</h4>
		<p> <span class="published {{$module->public ? 'view' : ''}}">{{$module->public ? 'Sí' : 'No'}}</span></p>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="divider top"></div>
	</div>
	<div class="col-sm-4">
		<h3>Objetivo</h3>
		<p>{{$module->objective}}</p>
	</div>
	<div class="col-sm-4">
		<h3>Situación didáctica</h3>
		<p>{{$module->teaching_situation}}</p>
	</div>
	<div class="col-sm-4">
		<h3>Productos a desarrollar</h3>
		<p>{{$module->product_developed}}</p>
	</div>
</div>

<?php /* DELETE ASAP
<div class="box">
	<div class="row">
		<div class="col-sm-6">
			<ul class="profile list">
				<li><span>Fecha inicio:</span> {{date("d-m-Y", strtotime($module->start))}}</li>
				<li><span>Fecha final:</span> {{date('d-m-Y', strtotime($module->end))}}</li>
        <li><span>Objetivo:</span>{{$module->objective}}</li>
        <li><span>Situación didáctica:</span></li>
        <li><span>Productos a desarrollar:</span></li>
			</ul>
		</div>
		<div class="col-sm-6">
			<ul class="profile list">
				<li class="right"><span>Agregar sesión</span>
				<a href='{{ url("dashboard/sesiones/agregar/$module->id") }}' class="btn xs view">Agregar</a></li>
			</ul>
		</div>
	</div>
</div>
*/?>
<div class="row">
	<div class="col-sm-12">
		<div class="divider"></div>
		<h2 class="center">Sesiones del módulo</h2>
		<p class="center"><a href='{{url("dashboard/sesiones/agregar/$module->id")}}' class="btn xs ev">+ Agregar sesión</a></p>
	</div>
</div>


@if($module->sessions->count() > 0)
@foreach ($module->sessions as $session)
<div class="box session_list">
	<div class="row">
		<!--icono-->
		<div class="col-sm-1 right">
			<b class="icon_h session list_s"></b>
		</div>
		<div class="col-sm-9">
			<h3>Sesión {{$session->order}}</h3>
			<h2><a href="{{ url('dashboard/sesiones/ver/' . $session->id) }}">{{$session->name}}</a>  <span class="le_link"><a href="{{ url('dashboard/sesiones/editar/' . $session->id) }}" class="btn xs view">Actualizar sesión</a></span></h2>
			<div class="divider"></div>
			<div class="row">
				<div class="col-sm-9">
					<p>{{$session->objective}}</p>
				</div>
				<div class="col-sm-3 notes">
					<p class="right">Fechas:<br>{{date("d-m-Y", strtotime($session->start))}} al {{date('d-m-Y', strtotime($session->end))}}</p>
				</div>
			</div>
		</div>
		<!-- ver sesión-->
		<div class="col-sm-2">
			<a class="btn view block sessions_l"  href="{{ url('dashboard/sesiones/ver/' . $session->id) }}">Ver sesión</a>
			 <a href ="{{ url('dashboard/sesiones/eliminar/' . $session->id) }}"  id ="{{$session->id}}" class="btn danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a>
		</div>

		<div class="footnote">
			<div class="row">
				<div class="col-sm-2">
					<p><b class="icon_h time"></b>{{$session->hours}} h </p>
				</div>
				<div class="col-sm-2">
					<p><b class="icon_h modalidad"></b>{{$session->modality}}</p>
				</div>
				<div class="col-sm-6">
					@if($session->facilitators->count() > 0)
					<p><strong>{{$session->facilitators->count() == 1 ? 'Facilitador' : 'Facilitadores' }}:</strong>
					@foreach ($session->facilitators as $facilitator)
						@if($facilitator->user->image)
						<img src='{{url("img/users/{$facilitator->user->image->name}")}}' height="30px">
						@else
						@endif
						 {{$facilitator->user->name}} -  {{$facilitator->user->institution}} <br>
					@endforeach
					</p>
					@endif
				</div>
				<div class="col-sm-2">
					<p class="right">{{$session->activities->count() == 1 ? $session->activities->count(). " actividad" : $session->activities->count(). " actividades"}}  </p>
				</div>
			</div>
		</div>
	</div>
</div>
@endforeach
@else
<div class="box">
	<div class="row center">
		<h2>Sin sesiones</h2>
		<p><a href='{{url("dashboard/sesiones/agregar/$module->id")}}' class="btn xs view">Agregar sesión</a></p>
	</div>
</div>
@endif
@endsection
