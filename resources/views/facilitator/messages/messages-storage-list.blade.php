@extends('layouts.admin.a_master')
@section('title', 'Mensajes')
@section('description', 'Lista de mensajes archivados')
@section('body_class', 'facilitator mensajes')
@section('breadcrumb_type', 'messages list')

@section('content')
<div class="row">
	<div class="col-sm-6">
		<h1>Mensajes Privados Archivados</h1>
	</div>
  <div class="col-sm-3 center">
		<a href="{{ url('tablero-facilitador/mensajes') }}" class="btn gde"> Mensajes</a>
	</div>
</div>

@if($user->store_conversations->count()>0)
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
			          <a href="{{ url('tablero-facilitador/mensajes/ver/' . $conversation->id) }}" class="btn xs view">Ver Conversación</a>
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
	  	<h2>Sin mensajes archivados</h2>
	  	<a href="{{ url('tablero-facilitador/mensajes') }}" class="btn ev"> Ir a Mensajes</a>
	  </div>
  </div>
</div>
@endif
@endsection
