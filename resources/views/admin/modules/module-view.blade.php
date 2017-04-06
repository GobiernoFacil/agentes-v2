@extends('layouts.admin.a_master')
@section('title', 'Agregar módulo')
@section('description', 'Agregar nuevo módulo')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Información de módulo</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-6">
			<ul class="profile list">
				<li><span>Nombre:</span> <h2>{{$module->title}}</h2></li>
				<li><span>Fecha inicio:</span> {{date("d-m-Y", strtotime($module->start))}}</li>
				<li><span>Fecha final:</span> {{date('d-m-Y', strtotime($module->end))}}</li>
				<li><span>Número de sesiones:</span> {{$module->number_sessions}}</li>
				<li><span>Total de horas:</span> {{$module->number_hours}}</li>
				<li><span>Modalidad:</span>{{$module->modality}}</li>
        <li><span>Objetivo:</span>{{$module->objective}}</li>
        <li><span>Situación didáctica:</span>{{$module->teaching_situation}}</li>
        <li><span>Situación didáctica:</span>{{$module->product_developed}}</li>
        <li><span>Publicado:</span>{{$module->public ? 'Si' : 'No'}}</li>
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

<div class="row">
	<div class="col-sm-12">
		<h1>Sesiones</h1>
	</div>
</div>
@if($module->sessions->count() > 0)
<div class="box">
	<div class="row">
		<table class="table">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Fecha Inicio / Fecha Final</th>
					<th>Número de sesión</th>
					<th>Horas</th>
					<th>Modalidad</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($module->sessions as $session)
					<tr>
						<td><h4><a href="{{ url('dashboard/sesiones/ver/' . $session->id) }}">{{$session->name}}</a></h4></td>
						<td>{{date("d-m-Y", strtotime($session->start))}} <br> <strong>{{date('d-m-Y', strtotime($session->end))}}</strong></td>
						<td>{{$session->order}}</td>
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
