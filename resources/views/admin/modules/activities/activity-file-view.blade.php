@extends('layouts.admin.a_master')
@section('title', 'Ver archivo de actividad: ' . $file->activity->name)
@section('description', 'Ver archivo de actividad')
@section('body_class', '')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Información de archivo de actividad: {{$file->activity->name}}</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-6">
			<ul class="profile list">
				<li><span>Nombre:</span> <h2>{{$file->name}}</h2></li>
				<li><span>Descripción:</span>{{$file->description}}</li>
        <li><span><a href='{{url("dashboard/sesiones/actividades/archivos/descargar/$file->id")}}'>Descargar archivo</a></span></li>
			</ul>
		</div>
		<div class="col-sm-6">
			<ul class="profile list">
				<li class="right"><a href='{{ url("dashboard/sesiones/actividades/archivos/editar/$file->id") }}' class="btn xs view">Editar</a></li>
			</ul>
		</div>
	</div>
</div>
@endsection
