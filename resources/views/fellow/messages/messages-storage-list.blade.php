@extends('layouts.admin.a_master')
@section('title', 'Mensajes')
@section('description', 'Lista de mensajes archivados')
@section('body_class', 'fellow mensajes')
@section('breadcrumb_type', 'messages list')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_messages')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Mensajes archivados</h1>
	</div>
	<!--ir a mensajes-->
	<div class="col-sm-3 center">
		<a href="{{ url('tablero/' . $program->slug .'/mensajes') }}" class="btn view block sessions_l">&lt; Regresar a mensajes</a>
	</div>
	<div class="col-sm-12">
		<div class="divider bg"></div>
	</div>
</div>

@if($user->store_conversations->count()>0)
<div class="box session_list last_activity">
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
			        <td><a href="{{ url('tablero/mensajes/ver/' . $conversation->id) }}">{{$conversation->title}}</a>
			        	<span class="count_m">{{$conversation->messages->count() == 1 ? $conversation->messages->count() . ' mensaje' : $conversation->messages->count() . ' mensajes' }}</span>
			        </td>
					<td>
				        {{$conversation->last_message->first()->updated_at->diffForHumans()}}
				    </td>
					<td>
			          <a href="{{ url('tablero/mensajes/ver/' . $conversation->id) }}" class="btn xs view">Ver Conversación</a>
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
	  	<a href="{{ url('tablero/mensajes') }}" class="btn ev"> Ir a Mensajes</a>
	  </div>
  </div>
</div>
@endif
@endsection
