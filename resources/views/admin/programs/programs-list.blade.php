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
	</div>
</div>
<div class="row" id ="aspirants">
	<div class="col-sm-12">
		<p class="right"><a href="{{ url('dashboard/programas/agregar') }}" class="btn ev">[+] Agregar programa</a></p>

		<table class="table">
		  <thead>
		    <tr>
		      <th>Nombre</th>
		      <th>Fecha Inicio / Fecha Final</th>
					<th>Aspirantes</th>
		      <th>Fellows</th>
		      <th>Módulos</th>
			  <th>Publicado</th>
		      <th>Acciones</th>
		    </tr>
		  </thead>
		  <tbody>
		    @foreach ($programs as $program)
		      <tr>
		        <td><h4><a href="{{ url('dashboard/programas/ver/' . $program->id) }}">{{$program->title}}</a></h4></td>
		        <td>{{date("d-m-Y", strtotime($program->start))}} <br> <strong>{{date('d-m-Y', strtotime($program->end))}}</strong></td>
						<td><h5><a href='{{url("dashboard/aspirantes/convocatoria/{$program->notice->notice_id}/ver")}}'>{{$program->notice->notice_data->all_aspirants_data()->count()}}</a></h5></td>
						<td><h5><a href='{{url("dashboard/fellows/programa/$program->id")}}'>{{$program->fellows->count()}}</a></h5></td>
						<td><h5><a href='{{url("dashboard/programas/ver/$program->id")}}'>{{$program->modules->count()}}</a></h5></td>
		        <td>{{$program->public ? "Sí" : "No" }}</td>
		        <td>
		          <a href="{{ url('dashboard/programas/ver/' . $program->id) }}" class="btn xs ev">Ver</a>
              <a href="{{ url('dashboard/programas/editar/' . $program->id) }}" class="btn xs view">Actualizar</a>
		         <!-- <a href ="{{ url('dashboard/programas/eliminar' . $program->id) }}"  id ="{{$program->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>-->
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
