@extends('layouts.admin.a_master')
@section('title', 'Lista de programas')
@section('description', 'Lista de programas')
@section('body_class', 'program')
@section('breadcrumb_type', 'programs list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')

@section('content')


@if($programs->count() > 0)
<div class="row">


	<div class="col-sm-9">
		<h1>Lista de programas</h1>
    <p>Selecciona un programa para ver las encuestas</p>
	</div>
</div>
<div class="row" id ="aspirants">
	<div class="col-sm-12">
		<table class="table">
		  <thead>
		    <tr>
		      <th>Nombre</th>
		      <th>Fecha Inicio / Fecha Final</th>
					<th>Encuestas</th>
		      <th>Acciones</th>
		    </tr>
		  </thead>
		  <tbody>
		    @foreach ($programs as $program)
		      <tr>
		        <td><h4><a href="{{ url('dashboard/encuestas/programa/'.$program->id) }}">{{$program->title}}</a></h4></td>
		        <td>{{date("d-m-Y", strtotime($program->start))}} <br> <strong>{{date('d-m-Y', strtotime($program->end))}}</strong></td>
						<td><h5><a href='{{url("dashboard/encuestas/programa/$program->id")}}'>{{$program->surveys()->count()}}</a></h5></td>
		        <td>
		          <a href='{{url("dashboard/encuestas/programa/$program->id")}}' class="btn xs ev">Ver</a> <!-- <a href ="{{ url('dashboard/programas/eliminar' . $program->id) }}"  id ="{{$program->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>-->
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
