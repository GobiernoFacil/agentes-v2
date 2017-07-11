@extends('layouts.admin.a_master')
@section('title', 'Perfil')
@section('description', 'Ver perfil')
@section('body_class', 'profile fellow')
@section('breadcrumb_type', 'profile view')

@section('content')

@if($files->count() > 0)
<div class="row">
	<div class="col-sm-12">
		<h1>Tus archivos</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
			  <thead>
			    <tr>
			      <th>Nombre</th>
			      <th>Actividad</th>
					  <th>Fecha de creación</th>
			      <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			    @foreach ($files as $file)
			      <tr>
			        <td><h4> <a href="{{ url('tablero/perfil/archivos/descargar/' . $file->id) }}">{{$file->name}}</a></h4></td>
			        <td>{{$file->activity->name}}</td>
			        <td><a title="{{date('d-m-Y H:i', strtotime($file->created_at))}}">{{$file->created_at->diffForHumans()}}</a> </td>
			        <td>
			          <a href="{{ url('tablero/perfil/archivos/descargar/' . $file->id) }}" class="btn xs view">Descargar</a></td>
			    </tr>
			    @endforeach
			  </tbody>
			</table>

			{{ $files->links() }}
		</div>
	</div>
</div>
@else
<div class="row">
	<div class="col-sm-9">
		<h1>Tus archivos</h1>
	</div>
</div>
<div class="box">
	<div class="row center">
		<div class="col-sm-10 col-sm-offset-1">
		<h2>Aún no cuentas con archivos</h2>
		</div>
	</div>
</div>
@endif
@endsection
