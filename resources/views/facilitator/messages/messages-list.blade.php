@extends('layouts.admin.a_master')
@section('title', 'Lista de Mensajes')
@section('description', 'Lista de mensajes')
@section('body_class', 'mensajes')
@section('breadcrumb_type', 'messages list')
@section('breadcrumb', 'layouts.facilitator.breadcrumb.b_messages')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Mensajes Privados</h1>
	</div>
  <div class="col-sm-3 center">
		<a href="{{ url('tablero-facilitador/mensajes/agregar') }}" class="btn gde"><strong>+</strong> Crear Mensaje</a>
	</div>
</div>
@if($conversations->count()>0)
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
			  <thead>
			    <tr>
			      <th>Conversación con</th>
			      <th>Asunto</th>
			      <th></th>
			      <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			    @foreach ($conversations as $conversation)
			    <tr>
				    <td><strong>	
					@if($conversation->to_id != $user->id)
			        	{{$conversation->user_to->name}}
					@else
						{{$conversation->user->name}}
					@endif
					</strong>
				    </td>
			        <td><a href="{{ url('tablero-facilitador/mensajes/ver/' . $conversation->id) }}">{{$conversation->title}}</a>
			        <span class="count_m">{{$conversation->messages->count() == 1 ? $conversation->messages->count() . ' mensaje' : $conversation->messages->count() . ' mensajes' }}</span>
			        </td>
					<td>
				        {{$conversation->updated_at->diffForHumans()}}
				    </td>
				    <td>
			          <a href="{{ url('tablero-facilitador/mensajes/ver/' . $conversation->id) }}" class="btn xs view">Ver</a>
								<!--
			          <a href ="{{ url('sa/dashboard/administradores/eliminar' . $conversation->id) }}"  id ="{{$conversation->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>
								!-->
				    </td>
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
	  <div class="box center">
	  	<h2>Sin mensajes</h2>
	  	<a href="{{ url('tablero-facilitador/mensajes/agregar') }}" class="btn ev"><strong>+</strong> Crear Mensaje</a>
	  </div>
  </div>
</div>
@endif
@endsection