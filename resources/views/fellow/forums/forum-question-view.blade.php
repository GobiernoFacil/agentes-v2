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
		@if($question->forum->type === 'activity')
		<p><span class="type module_session">{{$question->forum->session->module->title}} / {{$question->forum->session->name}}</span></p>
		@elseif($question->forum->type ==='general')
			<p><span class="type general">General</span></p>
		@elseif($question->forum->type ==='state')
			<p><span class="type state">Estado</span></p>
		@else
			<p><span class="type state">Soporte Técnico</span></p>
		@endif
		<div class="divider b"></div>
	</div>
	<!--avatar-->
	<div class="col-sm-1">
		@if($question->user->image)
		<img src='{{url("img/users/{$question->user->image->name}")}}' widht="100%">
		@else
		<img src='{{url("img/users/default.png")}}' widht="100%">
		@endif
	</div>
	<!--pregunta-->
	<div class="col-sm-9 forum_list">
    	<h1>{{$question->topic}} </h1>
		<p class="author">Por {{$question->user->name}} <span>{{$question->created_at->diffForHumans()}}</span></p>
	</div>
	<!--contador de mensajes-->
	<div class="col-sm-2 forum_list">
		<h3 class="count_messages">{{$question->messages->count()}}</h3>
	</div>
	<!--- descripción de la pregunta-->
  	<div class="col-sm-12">
	  	<p class="ap_descriptionq">{{$question->description}}</p>
	  	<div class="divider b"></div>
  	</div>
</div>



  @if($question->messages->count()>0 )
  	<div class="row">
  		<div class="col-sm-9">
	  		<h3>{{$question->messages->count() == 1 ? $question->messages->count() . ' respuesta' : $question->messages->count() . ' respuestas' }}</h3>
  		</div>
  		<!--enlace a agregar respuesta-->
	  	<div class="col-sm-3">
	  		<a href='{{ url("tablero/$program->slug/foros/pregunta/$question->slug/agregar-mensaje") }}' class="btn view block sessions_l">[<strong>+</strong>] Agregar Respuesta</a>
	  	</div>
	  	<div class="col-sm-12">
	  		<div class="divider b"></div>
  		</div>
  	</div>
  	<div class="row">
        <div class="col-sm-10 col-sm-offset-1 forum_list">
    @foreach($question->messages as $message)
      		<div class="row">
	      		<div class="col-sm-2">
		      		<figure class="ap_figure">
		      		@if($message->user->image)
						<img src='{{url("img/users/{$message->user->image->name}")}}' width="100%">
					@else
						<img src='{{url("img/users/default.png")}}' width="100%">
					@endif
		      		</figure>
				</div>
				<div class="col-sm-10">
					<?php
					if($message->user->type=== 'facilitator'){
						$type = 2;
					}else{
						$type = 1;
					}
					?>
	  				<p class="ap_message_f">{{$message->message}}</p>
						@if($message->user->type==='fellow')
						<p class="author">
							<a href='{{url("tablero/$program->slug/foros/perfil/ver/{$message->user->name}/{$message->user->fellowData->surname}/{$message->user->fellowData->lastname}")}}'>
								Por {{$message->user->name.' '.$message->user->fellowData->surname.' '.$message->user->fellowData->lastname}}
						  </a>
							<span>{{$message->created_at->diffForHumans()}}</span>
						</p>
						@elseif($message->user->type==='facilitator')
						<p class="author">
							<a href='{{url("tablero/$program->slug/foros/perfil/ver/{$message->user->name}/$type")}}'>
							  Por {{$message->user->name.' '.$message->user->facilitatorData->surname.' '.$message->user->facilitatorData->lastname}}
						  </a>
							<span>{{$message->created_at->diffForHumans()}}</span>
						</p>
						@else
	  				<p class="author">
							<a href='{{url("tablero/$program->slug/foros/perfil/ver/{$message->user->name}/$type")}}'>
								Por {{$message->user->name}}
							</a>
							<span>{{$message->created_at->diffForHumans()}}</span></p>
						@endif
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
        <a href='{{ url("tablero/$program->slug/foros/pregunta/$question->slug/agregar-mensaje") }}' class="btn view block sessions_l">[<strong>+</strong>] Agregar Respuesta</a>
      </div>
    </div>
  @else
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2 center">
      <h2>No existen respuestas.</h2>
      <a href='{{ url("tablero/$program->slug/foros/pregunta/$question->slug/agregar-mensaje") }}' class="btn view block sessions_l">[<strong>+</strong>] Agregar Respuesta </a>
    </div>
  </div>
  @endif

@endsection
