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
		@if($user->get_storaged_conversations()->count() > 0)
			<a href="{{ url('tablero/' . $program->slug .'/mensajes-archivados') }}" class="btn view block sessions_l"> Mensajes Archivados ({{$user->get_storaged_conversations()->count()}})</a>
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
<div class="row">
		@foreach ($conversations as $conversation)
		<div class="col-sm-11">
			<a class="btn_message_list" href="{{ url('tablero/' . $program->slug .'/mensajes/ver/' . encrypt($conversation->id)) }}">
				@if($conversation->to_id != $user->id)
					<span class="col-sm-1">
						@if($conversation->user_to->image)
							<img src='{{url("img/users/{$conversation->user_to->image->name}")}}' height="25px">
						@else
							<img src='{{url("img/users/default.png")}}' height="25px">
						@endif
					</span>
					<span class="col-sm-4">
						{{$conversation->user_to->name}}
					</span>
				@else
					<span class="col-sm-1">
						@if($conversation->user->image)
							<img src='{{url("img/users/{$conversation->user->image->name}")}}' height="25px">
						@else
							<img src='{{url("img/users/default.png")}}' height="25px">
						@endif
					</span>
					<span class="col-sm-4">
						{{$conversation->user->name}}
					</span>
				@endif
				<span class="col-sm-5">{{$conversation->title}}
					<span class="count_m inline">({{$conversation->messages->count() == 1 ? $conversation->messages->count() . ' mensaje' : $conversation->messages->count() . ' mensajes' }})</span> 
				</span>
				<span class="col-sm-2">
					<span class="ap_date">
					{{$conversation->updated_at->diffForHumans()}}
					</span>
				</span>
				<span class="clearfix"></span>
			</a>
		</div>
			
		<div class="col-sm-1">
			  <a href ='{{ url("tablero/$program->slug/mensajes/conversacion/storage/".encrypt($conversation->id))}}'  id ="{{encrypt($conversation->id)}}" class="btn ev" onclick="return confirm('¿Estás seguro?');">Archivar</a>
		</div>
		@endforeach
	
</div>

<div class="row">
	<div class="col-sm-12">
		{{ $conversations->links() }}
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
