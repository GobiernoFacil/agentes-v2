@extends('layouts.admin.a_master')
@section('title',  $question->topic)
@section('description', 'Ver pregunta agregada a foro')
@section('body_class', 'fellow foros')
@section('breadcrumb_type', 'forum view question')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_forum')

@section('content')
<div class="row">
	<!--foro-->
	<div class="col-sm-12 forum_list">
		<h3>{{$question->forum->topic}}</h3>
		@if($question->forum->session)
		<p><span class="type module_session">{{$question->forum->session->module->title}} / {{$question->forum->session->name}}</span></p>
		@else
		<p><span class="type state">Estado</span></p>
		@endif
		<div class="divider b"></div>
	</div>
	<!--avatar-->
	<div class="col-sm-1">
		<img src='{{url("img/users/default.png")}}' width="100%">
	</div>
	<!--pregunta-->
	<div class="col-sm-9 forum_list">
    	<h1>{{$question->topic}} </h1>
		<p class="author">Por {{$question->user_id}} <span>{{$question->created_at->diffForHumans()}}</span></p>
	</div>
	<!--mensajes-->
	<div class="col-sm-2 forum_list">
		<h3 class="count_messages">{{$question->messages->count()}}</h3>
	</div>
  	<div class="col-sm-12">
	  	<div class="divider b"></div>
  	</div>
  	<div class="col-sm-10 col-sm-offset-1">
	  	<p>{{$question->description}}</p>
  	</div>
</div>


<div class="box">
  @if($question->messages->count()>0 )
  	<div class="row">
  		<div class="col-sm-9">
	  		<h2>{{$question->messages->count() == 1 ? $question->messages->count() . ' respuesta' : $question->messages->count() . ' respuestas' }}</h2>
  		</div>
  		<!--enlace a agregar respuesta-->
	  	<div class="col-sm-3 center">
	  		<a href='{{ url("tablero/foros/pregunta/$question->slug/mensajes/agregar") }}' class="btn gde download">Agregar Respuesta [<strong>+</strong>]</a>
	  	</div>
	  	<div class="col-sm-12">
	  		<div class="divider b"></div>
  		</div>
  	</div>
  	<div class="row">
        <div class="col-sm-8 col-sm-offset-2 forum_list">
    @foreach($question->messages as $message)
      		<div class="row">
	      		<div class="col-sm-1">
		  			<img src='{{url("img/users/default.png")}}' width="100%">
				</div>
				<div class="col-sm-11">
	  				<p>{{$message->message}}</p>
	  				<p class="author">Por {{$message->user->name}} <span>{{$message->created_at->diffForHumans()}}</span></p>
				</div>
				<div class="col-sm-12">
	  			<div class="divider b"></div>
				</div>
      		</div>
    @endforeach
    	</div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3 center">
        <a href='{{ url("tablero/foros/pregunta/$question->slug/mensajes/agregar") }}' class="btn gde download">Agregar Respuesta [<strong>+</strong>]</a>
      </div>
    </div>
  @else
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2 center">
      <h2>No existen respuestas.</h2>
      <a href='{{ url("tablero/foros/pregunta/$question->slug/mensajes/agregar") }}' class="btn gde download">Agregar Respuesta [<strong>+</strong>]</a>
    </div>
  </div>
  @endif
</div>
@endsection
