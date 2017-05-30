@extends('layouts.admin.a_master')
@section('title', 'Mensaje privado con ' . $conversation->user_to->name)
@section('description', 'Mensaje privado con ' . $conversation->user_to->name)
@section('body_class', 'mensajes')
@section('breadcrumb_type', 'message view')
@section('breadcrumb', 'layouts.facilitator.breadcrumb.b_messages')

@section('content')
<div class="row">
  <div class="col-sm-9">
	    <h1>Conversación con
		@if($conversation->to_id != $user->id)
		   {{$conversation->user_to->name}}
		@else
		   {{$conversation->user->name}}
		@endif
		</h1>
		@if($conversation->to_id != $user->id)
			@if($conversation->user_to->image)
				<img src='{{url("img/users/{$conversation->user_to->image->name}")}}' height="100px">
			@else
				<img src='{{url("img/users/default.png")}}' height="100px">
			@endif
		@else
			@if($conversation->user->image)
				<img src='{{url("img/users/{$conversation->user->image->name}")}}' height="100px">
			@else
				<img src='{{url("img/users/default.png")}}' height="100px">
			@endif
		@endif
		
  </div>
  <div class="col-sm-3 center">
    <a href='{{ url("tablero-facilitador/mensajes/conversacion/agregar/$conversation->id") }}' class="btn gde"><strong>+</strong> Escribir Mensaje</a>
  </div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-9">
			<h5>Asunto</h5>
			<h2 class="title">{{$conversation->title}}</h2>
		</div>
		<div class="col-sm-3">
			<p class="right">{{$conversation->messages->count() == 1 ? $conversation->messages->count() . ' mensaje' : $conversation->messages->count() . ' mensajes' }}</p>
		</div>
		<div class="col-sm-12 divider"></div>
	</div>
	@if($conversation->messages->count() > 0)
	<div class="row">
        <div class="col-sm-8 col-sm-offset-2">
		@foreach($conversation->messages->sortByDesc("updated_at") as $message)
			<div class="row">
			  <div class="col-sm-8 {{$message->user_id == $user->id ? 'col-sm-offset-4' : ''}}">
			    <div class="message_box {{$message->user_id == $user->id ? 'me' : 'not_me'}}">
			    <p>{{$message->message}}</p>
			    </div>
			    <p><span>{{$message->updated_at->diffForHumans()}}</span></p>
			  </div>
			</div>
		@endforeach
        </div>
  	</div>
	@else
	<div class="row">
    	<div class="col-sm-8 col-sm-offset-2">
			<p>No existen mensajes</p>
    	</div>
  	</div>
  	@endif
</div>
<div class="row">
		<div class="col-sm-8 col-sm-offset-2 center">
		    <a href='{{ url("tablero-facilitador/mensajes/conversacion/agregar/$conversation->id") }}' class="btn gde"><strong>+</strong> Escribir Mensaje</a>
		</div>
	</div>
@endsection
