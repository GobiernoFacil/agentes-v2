@extends('layouts.admin.a_master')
@section('title', 'Ver módulo '. $module->title)
@section('description', 'Ver módulo')
@section('body_class', 'modulos view')
@section('breadcrumb_type', 'module view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')
@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1 class="center">{{$module->title}}</h1>
		<p class="center date">{{date("d-m-Y", strtotime($module->start))}} al {{date('d-m-Y', strtotime($module->end))}}</p>
		<div class="divider"></div>
	</div>
</div>
<div class="row">
	<div class="col-sm-3 center">
		<h4>Duración</h4>
		<p>{{$module->number_hours}} horas</p>
	</div>
	<div class="col-sm-3 center">
		<h4># Sesiones</h4>
		<p>{{$module->number_sessions}}</p>
	</div>
	<div class="col-sm-3 center">
		<h4>Modalidad</h4>
		<p>{{$module->modality}}</p>
	</div>
	<div class="col-sm-3 center">
		<h4>Publicado</h4>
		<p>{{$module->public ? 'Sí' : 'No'}}</p>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="divider top"></div>
	</div>
	<div class="col-sm-12">
		<h3>Objetivo</h3>
		<p>{{$module->objective}}</p>
	</div>
	<div class="col-sm-6">
		<h3>Situación didáctica</h3>
		<p>{{$module->teaching_situation}}</p>
	</div>
	<div class="col-sm-6">
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
	</div>
</div>


@if($module->sessions->count() > 0)
<div class="box">
	<div class="row">
		<table class="table">
			<thead>
				<tr>

					<th>Número de sesión</th>
					<th>Nombre</th>
					<th>Fecha Inicio / Fecha Final</th>
					<th>Horas</th>
					<th>Modalidad</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($module->sessions as $session)
					<tr>
						<td>{{$session->order}}</td>
						<td><h4><a href="{{ url('dashboard/sesiones/ver/' . $session->id) }}">{{$session->name}}</a></h4></td>
						<td>{{date("d-m-Y", strtotime($session->start))}} <br> <strong>{{date('d-m-Y', strtotime($session->end))}}</strong></td>
						<td>{{$session->hours}} hrs.</td>
						<td>{{$session->modality}}</td>
						<td>
							<a href="{{ url('dashboard/sesiones/ver/' . $session->id) }}" class="btn xs view">Ver</a>
							<a href="{{ url('dashboard/sesiones/editar/' . $session->id) }}" class="btn xs view">Actualizar</a>
						 <!-- <a href ="{{ url('dashboard/modulos/eliminar' . $module->id) }}"  id ="{{$module->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>-->
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@else
<div class="box">
	<div class="row">
				<span>Sin sesiones</span></br>
				<a href='{{url("dashboard/sesiones/agregar/$module->id")}}' class="btn xs view">Agregar</a>
		</ul>
	</div>
</div>
@endif
@endsection
