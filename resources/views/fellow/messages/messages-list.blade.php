@extends('layouts.admin.a_master')
@section('title', 'Mensajes')
@section('description', 'Lista de mensajes')
@section('body_class', 'fellow mensajes')
@section('breadcrumb_type', 'messages list')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_messages')

@section('content')
<div class="row">
	<div class="col-sm-6">
		<h1>Mensajes</h1> 
	</div>
	<!--archivados-->
	<div class="col-sm-3 center">
		@if($user->store_conversations->count() > 0)
			<a href="{{ url('tablero/' . $program->slug .'/mensajes-archivados') }}" class="btn view block sessions_l"> Mensajes Archivados ({{$user->store_conversations->count()}})</a>
		@endif
	</div>
	<!--escribir mensajes-->
	<div class="col-sm-3 center">
		<a href="{{ url('tablero/' . $program->slug .'/mensajes/agregar') }}" class="btn view block sessions_l"><b class="write_message"></b> Escribir mensaje</a>
	</div>
	<div class="col-sm-12">
		<div class="divider bg"></div>
	</div>
</div>

@if($conversations->count()>0)
<!--lista de mensajes-->
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
						@if($conversation->user_to->image)
							<img src='{{url("img/users/{$conversation->user_to->image->name}")}}' height="25px">
						@else
							<img src='{{url("img/users/default.png")}}' height="25px">
						@endif
			        	{{$conversation->user_to->name}}
					@else
						@if($conversation->user->image)
							<img src='{{url("img/users/{$conversation->user->image->name}")}}' height="25px">
						@else
							<img src='{{url("img/users/default.png")}}' height="25px">
						@endif
						{{$conversation->user->name}}
					@endif
					</strong>
				    </td>
			        <td><a href="{{ url('tablero/' . $program->slug .'/mensajes/ver/' . $conversation->id) }}">{{$conversation->title}}</a>
			        	<span class="count_m">{{$conversation->messages->count() == 1 ? $conversation->messages->count() . ' mensaje' : $conversation->messages->count() . ' mensajes' }}</span>
			        </td>
					<td>
				        {{$conversation->updated_at->diffForHumans()}}
				    </td>
					<td>
			          <a href="{{ url('tablero/' . $program->slug .'/mensajes/ver/' . $conversation->id) }}" class="btn xs view">Ver Conversación</a>
			          <a href ='{{ url("tablero/mensajes/conversacion/storage/$conversation->id")}}'  id ="{{$conversation->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Archivar</a></td>

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
	<div class="box center">
		<div class="col-sm-12">
	  		<h2>Sin mensajes</h2>
	  		<p>En esta sección podrás iniciar conversaciones privadas acerca del <strong>programa</strong> con facilitadores y fellows</p>
	  		
		</div>
		<div class="col-sm-6 col-sm-offset-3">
			<a href="{{ url('tablero/' . $program->slug .'/mensajes/agregar') }}" class="btn view block sessions_l"><b class="write_message"></b> Escribe un mensaje</a>
		</div>
  </div>
</div>
@endif
@endsection
