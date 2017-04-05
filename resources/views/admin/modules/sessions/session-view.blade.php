@extends('layouts.admin.a_master')
@section('title', 'Ver sesión')
@section('description', 'Ver sesión')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

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
				<a href='{{ url("dashboard/sesiones/actividad/agregar/$session->id") }}' class="btn xs view">Agregar</a></li>
        <li class="right"><span>Agregar temática</span>
				<a href='{{ url("dashboard/sesiones/tematica/agregar/$session->id") }}' class="btn xs view">Agregar</a></li>
        <li class="right"><span>Agregar requisitos previos</span>
				<a href='{{ url("dashboard/sesiones/requisitos/agregar/$session->id") }}' class="btn xs view">Agregar</a></li>
			</ul>
		</div>
	</div>
</div>
@endsection
