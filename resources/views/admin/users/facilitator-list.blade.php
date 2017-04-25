@extends('layouts.admin.a_master')
@section('title', 'Lista de facilitadores')
@section('description', 'Lista de facilitadores de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'facilitadores')
@section('breadcrumb_type', 'facilitadores')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_facilitadores')

@section('content')

@if($facilitators->count() > 0)
<div class="row">
	<div class="col-sm-9">
		<h1>Lista de usuarios facilitadores</h1>
	</div>
	<div class="col-sm-3 center">
		<a href="{{ url('dashboard/facilitadores/agregar') }}" class="btn gde"><strong>+</strong> Agregar facilitador</a>
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
			    @foreach ($facilitators as $userf)
			      <tr>
			        <td><h4> <a href="{{ url('dashboard/facilitadores/ver/' . $userf->id) }}">{{$userf->name}}</a></h4></td>
			        <td>{{$userf->email}}</td>
			        <td>{{$userf->institution}}</td>
			        <td>
			          <a href="{{ url('dashboard/facilitadores/ver/' . $userf->id) }}" class="btn xs view">Ver</a>
			          <a href="{{ url('dashboard/facilitadores/editar/' . $userf->id) }}" class="btn xs ev">Editar</a>
			          <a href ="{{ url('dashboard/facilitadores/eliminar' . $userf->id) }}"  id ="{{$userf->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>
			    </tr>
			    @endforeach
			  </tbody>
			</table>

			{{ $facilitators->links() }}
		</div>
	</div>
</div>
@else
<div class="row">
	<div class="col-sm-9">
		<h1>Lista de usuarios facilitadores</h1>
	</div>
</div>
<div class="box">
	<div class="row center">
		<div class="col-sm-10 col-sm-offset-1">
		<h2>Sin facilitadores</h2>
		<a href="{{ url('dashboard/facilitadores/agregar') }}" class="btn gde"><strong>+</strong> Agregar facilitador</a>
		</div>
	</div>
</div>
@endif
@endsection
