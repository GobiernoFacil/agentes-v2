@extends('layouts.admin.a_master')
@section('title', 'Foros' )
@section('description','Foros del Programa de Gobierno Abierto desde lo local' )
@section('body_class', 'fellow foros')
@section('breadcrumb_type', 'forum list')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_forum')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Foros</h1>
		<h2>{{$program->title}}
	</div>
</div>


@if($forums->count()>0)
<div class="box forum_list">
	<div class="row">
		<div class="col-sm-12 col-xs-12 right">
			<h5>Tipos de Foros:</h5>
			<ul class="type_list">
				<li><b class="general"></b> General</li>
				<li><b class="module_session"></b> Aprendizaje</li>
				<li><b class="state"></b> Tu Estado</li>
			</ul>
			<div class="divider b"></div>
		</div>
	</div>
	@foreach ($forums as $forum)

	<div class="row">
		<div class="col-sm-1 col-xs-2">
			<h3 class="count_messages">{{ $forum->forum_conversations->count()}}</h3>
		</div>
		<div class="col-sm-11 col-xs-10">
			<h2><a href='{{ url("tablero/$program->slug/foros/$forum->slug") }}'>{{$forum->topic}}</a></h2>
			@if($forum->type === 'activity')
			<!--<p>{{str_limit($forum->description, $limit = 50, $end = '...')}}</p>-->
			<p><span class="type module_session">{{$forum->session->module->title}} > {{$forum->session->name}}</span></p>
			@elseif($forum->type ==='general')
					<p><span class="type general">General</span></p>
			@elseif($forum->type ==='state')
				<p><span class="type state">Estado</span></p>
		  @else
				<p><span class="type general">Soporte Técnico</span></p>
			@endif
			<p class="author">Creado por <strong>{{!empty($forum->user->institution) ? $forum->user->institution : ''}}</strong> <span>{{$forum->created_at->diffForHumans()}}</span></p>
		</div>
		<div class="col-sm-12 col-xs-12">
			<div class="divider"></div>
		</div>
	</div>

	@endforeach
	{{ $forums->links() }}
</div>

@else
<div class="row">
  <div class="col-sm-12">
    <p>Sin foros</p>
  </div>
</div>
@endif


@endsection
