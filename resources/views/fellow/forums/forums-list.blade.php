@extends('layouts.admin.a_master')
@section('title', $forum->topic )
@section('description',$forum->topic  )
@section('body_class', 'fellow foros')
@section('breadcrumb_type', 'forum view')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_forum')

@section('content')
<div class="row">
	<!-- título-->
	<div class="col-sm-8">
		<h1>{{$forum->topic}}</h1>
	</div>
	<!-- agregar pregunta-->
	<div class="col-sm-4 center">
		<a href='{{ url("tablero/{$program->slug}/foros/{$forum->slug}/agregar-pregunta") }}' class="btn view block sessions_l">[<strong>+</strong>] Agregar pregunta o tema al foro </a>
	</div>
	<!-- descripción-->
	<div class="col-sm-12 forum_list">
		@if($forum->type === 'activity')
		<p><span class="type module_session">{{$forum->session->module->title}} / {{$forum->session->name}}</span></p>
		@elseif($forum->type ==='general')
			<p><span class="type general">General</span></p>
		@elseif($forum->type ==='state')
			
		@else
			<p><span class="type state">Soporte</span></p>
		@endif
		<p class="author">Creado por <strong>{{!empty($forum->user->institution) ? $forum->user->institution : ''}}</strong> <span>{{$forum->created_at->diffForHumans()}}</span></p>
		<div class="divider bg nm"></div>
	</div>
	<!-- descripción-->
	<div class="col-sm-12">
		<p>{{$forum->description}}</p>
	</div>
</div>


@if($forums->count()>0)
<div class="box session_list last_activity">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			@foreach ($forums as $conversation)
				<div class="row forum_list">
					<div class="col-sm-1">
						@if($conversation->user->image)
						<img src='{{url("img/users/{$conversation->user->image->name}")}}' width="100%">
						@else
						<img src='{{url("img/users/default.png")}}' width="100%">
						@endif
					</div>
					<div class="col-sm-9">
						<h2> <a href='{{ url("tablero/$program->slug/foros/$forum->slug/ver-pregunta/$conversation->slug") }}'>{{$conversation->topic}}</a></h2>
						<!--fellow data -->
						<?php
						if($conversation->user->type=== 'facilitator'){
							$type = 2;
						}else{
							$type = 1;
						}
						?>
						@if($conversation->user->fellowData)
						<p class="author">
							<a href='{{url("tablero/$program->slug/foros/perfil/ver/{$conversation->user->name}/{$conversation->user->fellowData->surname}/{$conversation->user->fellowData->lastname}")}}'>
							Por {{$conversation->user->name." ".$conversation->user->fellowData->surname." ".$conversation->user->fellowData->lastname}}
						  </a>
							 <span> | {{$conversation->created_at->diffForHumans()}}</span>
						</p>
						@elseif($conversation->user->facilitatorData)
						<!--facilitator data -->
						<p class="author">
							<a href='{{url("tablero/$program->slug/foros/perfil/ver/{$conversation->user->name}/$type")}}'>
							Por {{$conversation->user->name." ".$conversation->user->facilitatorData->surname." ".$conversation->user->facilitatorData->lastname}}
						  </a>
							<span> | {{$conversation->created_at->diffForHumans()}}</span>
						</p>
						@else
						<!--super user data -->
						<p class="author">
							<a href='{{url("tablero/$program->slug/foros/perfil/ver/{$conversation->user->name}/$type")}}'>
							Por {{$conversation->user->name}}
						  </a>
							<span>{{$conversation->created_at->diffForHumans()}}</span>
						</p>
						@endif



					</div>
					<div class="col-sm-2">
						<h3 class="count_messages">{{$conversation->messages->count()}}</h3>
					</div>
					<div class="col-sm-12">
					<div class="divider b"></div>
					</div>
				</div>
			@endforeach
			{{ $forums->links() }}
		</div>

		<div class="col-sm-8 col-sm-offset-2 center">
			<a href='{{ url("tablero/{$program->slug}/foros/{$forum->slug}/agregar-pregunta") }}' class="btn view block sessions_l">[<strong>+</strong>] Agregar pregunta o tema al foro </a>
		</div>
	</div>
</div>
@else
<div class="box">
	<div class="row center">
		<div class="col-sm-12">
			<h2>Sin preguntas o temas en el foro</h2>
		</div>
		<div class="col-sm-6 col-sm-offset-3">
				<a href='{{ url("tablero/{$program->slug}/foros/{$forum->slug}/agregar-pregunta") }}' class="btn view block sessions_l">[<strong>+</strong>] Agregar pregunta o tema al foro</a>
  		</div>
	</div>
</div>
@endif
@endsection
