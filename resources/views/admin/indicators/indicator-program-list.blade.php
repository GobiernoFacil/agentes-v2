@extends('layouts.admin.a_master')
@section('title', 'Lista de indicadores')
@section('description', 'Lista de indicadores de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', '')
@section('breadcrumb_type', 'indicator list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_indicators')

@section('content')
@if($programs->count() > 0)
<div class="row">


	<div class="col-sm-9">
		<h1>Lista de programas</h1>
    <p>Selecciona un programa para ver sus indicadores</p>
	</div>
</div>
<div class="row" id ="aspirants">
	<div class="col-sm-12">
		<table class="table">
		  <thead>
		    <tr>
		      <th>Nombre</th>
		      <th>Fecha Inicio / Fecha Final</th>
		      <th>Acciones</th>
		    </tr>
		  </thead>
		  <tbody>
		    @foreach ($programs as $program)
		      <tr>
		        <td><h4><a href="{{ url('dashboard/indicadores/programa/'.$program->id) }}">{{$program->title}}</a></h4></td>
		        <td>{{date("d-m-Y", strtotime($program->start))}} <br> <strong>{{date('d-m-Y', strtotime($program->end))}}</strong></td>
		        <td>
		          <a href='{{url("dashboard/indicadores/programa/$program->id")}}' class="btn xs ev">Ver</a>
            </td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>

		{{ $programs->links() }}
	</div>
</div>

@else
<div class="row">
	<div class="col-sm-12">
		<h1>Programas</h1>
		<div class="box center">
			<h2>Aún no existen programas</h2>
			<p><a href="{{ url('dashboard/programas/agregar') }}" class="btn add">+ Agregar programa</a></p>
		</div>
	</div>
</div>

@endif

@endsection
