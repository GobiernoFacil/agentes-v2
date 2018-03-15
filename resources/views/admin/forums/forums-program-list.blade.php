@extends('layouts.admin.a_master')
@section('title', 'Lista de programas con foros')
@section('description', 'Lista de programas con foros')
@section('body_class', 'program')
@section('breadcrumb_type', 'programs list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')

@section('content')


@if($programs->count() > 0)
<div class="row">


	<div class="col-sm-9">
		<h1>Programas</h1>
    <p>Selecciona un programa para ver sus foros.</p>
	</div>
</div>
<div class="row" id ="aspirants">
	<div class="col-sm-12">
		<div class="box">

		<table class="table">
		  <thead>
		    <tr>
		      <th>Nombre</th>
		      <th>Fecha Inicio / Fecha Final</th>
		      <th>Total foros</th>
          <th>Activo</th>
		      <th>Acciones</th>
		    </tr>
		  </thead>
		  <tbody>
		    @foreach ($programs as $program)
		      <tr>
		        <td><h4><a href="{{ url('dashboard/foros/programa/' . $program->id) }}">{{$program->title}}</a></h4></td>
		        <td>{{date("d-m-Y", strtotime($program->start))}} <br> <strong>{{date('d-m-Y', strtotime($program->end))}}</strong></td>
				    <td>{{$program->forums->count()}}</td>
            <?php $today  = date('Y-m-d');?>
            @if($program->start <= $today && $program->end >= $today)
              <td>{{$program->public ? "Sí" : "No" }}</td>
            @else
              <td>No</td>
            @endif
		        <td>
		          <a href="{{ url('dashboard/foros/programa/' . $program->id) }}" class="btn xs ev">Ver</a>
            </td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>

		{{ $programs->links() }}
		</div>
	</div>
</div>

@else
<div class="row">
	<div class="col-sm-12">
		<h1>Programas</h1>
		<div class="box center">
			<h2>Aún no existen programas</h2>
		</div>
	</div>
</div>

@endif

@endsection
