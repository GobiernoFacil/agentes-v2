@extends('layouts.admin.a_master')
@section('title', 'Lista de programas con mensajes')
@section('description', 'Lista de programas con mensajes')
@section('body_class', 'program')
@section('breadcrumb_type', 'programs list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_messages')

@section('content')


@if($programs->count() > 0)
<div class="row">


	<div class="col-sm-9">
		<h1>Programas</h1>
    <p>Selecciona un programa para ver tus mensajes.</p>
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
					<th>Activo</th>
		      <th>Total conversaciones</th>
					<th>Sin leer</th>
		      <th>Acciones</th>
		    </tr>
		  </thead>
		  <tbody>
		    @foreach ($programs as $program)
		      <tr>
		        <td><h4><a href='{{url("dashboard/mensajes/programa/$program->id/ver-mensajes") }}'>{{$program->title}}</a></h4></td>
		        <td>{{date("d-m-Y", strtotime($program->start))}} <br> <strong>{{date('d-m-Y', strtotime($program->end))}}</strong></td>
            <?php $today  = date('Y-m-d');?>
            @if($program->start <= $today && $program->end >= $today)
              <td>{{$program->public ? "Sí" : "No" }}</td>
            @else
              <td>No</td>
            @endif
				    <td><a href='{{url("dashboard/mensajes/programa/$program->id/ver-mensajes") }}' >{{$program->messages($user->id)->count()}}</a></td>

						<td>{{$user->unread_messages($program)->count()}}</td>
		        <td>
		          <a href='{{url("dashboard/mensajes/programa/$program->id/ver-mensajes") }}' class="btn xs ev">Ver</a>
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
