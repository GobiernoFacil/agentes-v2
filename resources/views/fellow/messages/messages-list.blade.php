@extends('layouts.admin.a_master')
@section('title', 'Mensajes')
@section('description', 'Lista de mensajes')
@section('body_class', 'fellow mensajes')
@section('breadcrumb_type', 'profile view')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Mensajes Privados</h1>
	</div>
  <div class="col-sm-3 center">
		<a href="{{ url('tablero/mensajes/agregar') }}" class="btn gde"><strong>+</strong> Crear Mensaje</a>
	</div>
</div>

@if($conversations->count()>0)
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
			  <thead>
			    <tr>
			      <th>Asunto</th>
			      <th>Destinatario</th>
			      <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			    @foreach ($conversations as $conversation)
			      <tr>
			        <td><h4> <a href="{{ url('tablero/mensajes/ver/' . $conversation->id) }}">{{$conversation->title}}</a></h4></td>
							@if($conversation->to_id != $user->id)
			        <td>{{$conversation->user_to->name}}</td>
							@else
							<td>{{$conversation->user->user_id}}</td>
							@endif
			        <td>
			          <a href="{{ url('tablero/mensajes/ver/' . $conversation->id) }}" class="btn xs view">Ver</a>
								<!--
			          <a href ="{{ url('sa/dashboard/administradores/eliminar' . $conversation->id) }}"  id ="{{$conversation->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>
								!-->
					</tr>
			    @endforeach
			  </tbody>
			</table>

			{{ $conversations->links() }}
		</div>
	</div>
</div>
@else
<div class="row">
  <div class="col-sm-12">
    <p>Sin mensajes</p>
  </div>
</div>
@endif
@endsection
