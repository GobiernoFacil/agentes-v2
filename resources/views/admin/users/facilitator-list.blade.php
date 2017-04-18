@extends('layouts.admin.a_master')
@section('title', 'Lista de facilitadores')
@section('description', 'Lista de facilitadores de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', '')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Lista de usuarios facilitadores</h1>
	</div>
	<div class="col-sm-3 center">
		<a href="{{ url('dashboard/facilitadores/agregar') }}" class="btn gde"><strong>+</strong> Agregar usuario</a>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
			  <thead>
			    <tr>
			      <th>Nombre</th>
			      <th>Email</th>
			      <th>Institución</th>
			      <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			    @foreach ($facilitators as $user)
			      <tr>
			        <td><h4> <a href="{{ url('dashboard/facilitadores/ver/' . $user->id) }}">{{$user->name}}</a></h4></td>
			        <td>{{$user->email}}</td>
			        <td>{{$user->institution}}</td>
			        <td>
			          <a href="{{ url('dashboard/facilitadores/ver/' . $user->id) }}" class="btn xs view">Ver</a>
			          <a href="{{ url('dashboard/facilitadores/editar/' . $user->id) }}" class="btn xs ev">Editar</a>
			          <a href ="{{ url('dashboard/facilitadores/eliminar' . $user->id) }}"  id ="{{$user->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>
			    </tr>
			    @endforeach
			  </tbody>
			</table>

			{{ $facilitators->links() }}
		</div>
	</div>
</div>
@endsection
