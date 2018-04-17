@extends('layouts.admin.a_master')
@section('title', 'Foros' )
@section('description','Foros del Programa de Gobierno Abierto desde lo local' )
@section('body_class', 'fellow foros')
@section('breadcrumb_type', 'forum act list')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_forum')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Foros de actividades</h1>
	</div>
</div>


@if($forums->count()>0)
<div class="box forum_list">

	@foreach ($forums as $forum)
	@if($forum->type === 'activity' || $forum->type ==='general')
	<div class="row">
		<div class="col-sm-1 col-xs-2">
			<h3 class="count_messages">{{ $forum->forum_conversations->count()}}</h3>
		</div>
		<div class="col-sm-11 col-xs-10">
			<h2><a href='{{ url("tablero/$program->slug/foros/$forum->slug") }}'>{{$forum->topic}}</a></h2>
			@if($forum->type === 'activity')
			<!--<p>{{str_limit($forum->description, $limit = 50, $end = '...')}}</p>-->
			<p><span class="type module_session">{{$forum->session->module->title}} > {{$forum->session->name}}</span></p>
			@else($forum->type ==='general')
					<p><span class="type general">General</span></p>

			@endif
			<p class="author">Creado por <strong>{{!empty($forum->user->institution) ? $forum->user->institution : ''}}</strong> <span>{{$forum->created_at->diffForHumans()}}</span></p>
		</div>
		<div class="col-sm-12 col-xs-12">
			<div class="divider"></div>
		</div>
	</div>
	@endif
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
