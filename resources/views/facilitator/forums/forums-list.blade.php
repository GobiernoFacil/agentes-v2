@extends('layouts.admin.a_master')
@section('title', $forum->topic )
@section('description','Foros del Programa de Gobierno Abierto desde lo local' )
@section('body_class', 'foros')
@section('breadcrumb_type', 'forum view')
@section('breadcrumb', 'layouts.facilitator.breadcrumb.b_forums')

@section('content')
<div class="row">
<!-- título-->
	<div class="col-sm-9">
		<h1>{{$forum->topic}}</h1>
	</div>
	<!-- agregar pregunta-->
	<div class="col-sm-3 center">
		<a href='{{ url("tablero-facilitador/foros/pregunta/crear/$forum->id") }}' class="btn gde">Agregar Pregunta o Tema al foro [<strong>+</strong>]</a>
	</div>
	<!-- descripción-->
	<div class="col-sm-12 forum_list">
		<div class="divider top"></div>
		@if($forum->session)
		<p><span class="type module_session">{{$forum->session->module->title}} / {{$forum->session->name}}</span></p>
		@else
			@if($forum->slug ==='foro-general')
			<p><span class="type general">General</span></p>
			@else
			<p><span class="type state">Estado</span></p>
			@endif
		@endif
		<p class="author">Creado por <strong>{{!empty($forum->user->institution) ? $forum->user->institution : ''}}</strong> <span>{{$forum->created_at->diffForHumans()}}</span></p>
		<div class="divider top"></div>
	</div>
	<!-- descripción-->
	<div class="col-sm-10 col-sm-offset-1">
		<h4>Descripción</h4>
		<p>{{$forum->description}}</p>
	</div>
</div>


@if($forums->count()>0)
<div class="box">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			@foreach ($forums as $conversation)
				<div class="row forum_list">
					<div class="divider b"></div>
					<div class="col-sm-1">
						<img src='{{url("img/users/default.png")}}' width="100%">
					</div>
					<div class="col-sm-9">

						<h2><a href='{{ url("tablero-facilitador/foros/pregunta/ver/$conversation->id") }}'>{{$conversation->topic}}</a></h2>
						<p class="author">Por {{$conversation->user_id}} <span>{{$conversation->created_at->diffForHumans()}}</span></p>
					</div>
					<div class="col-sm-2">
						<h3 class="count_messages">{{$conversation->messages->count()}}</h3>
					</div>
				</div>
			@endforeach
			{{ $forums->links() }}
		</div>
		<div class="col-sm-10 col-sm-offset-1">
			<div class="divider b"></div>
		</div>
		<div class="col-sm-8 col-sm-offset-2 center">
		<a href='{{ url("tablero-facilitador/foros/pregunta/crear/$forum->id") }}' class="btn gde">Agregar Pregunta o Tema al foro [<strong>+</strong>]</a>
		</div>

	</div>
</div>
@else
<div class="row">
  <div class="col-sm-12">
    <p>Sin preguntas</p>
  </div>
</div>
@endif

@endsection
