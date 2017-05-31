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
	</div>
</div>


@if($forums->count()>0)
@foreach ($forums as $forum)
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
	
	<div class="row">
		<div class="col-sm-1 col-xs-2">
			<h3 class="count_messages">{{ $forum->forum_messages->count()}}</h3>
		</div>
		<div class="col-sm-11 col-xs-10">
			<h2><a href="{{ url('tablero/foros/' .$forum->session->slug.'/'.$forum->slug.'/ver') }}">{{$forum->topic}}</a></h2>
			<!--<p>{{str_limit($forum->description, $limit = 50, $end = '...')}}</p>-->
			<p><span class="type">{{$forum->session->module->title}} > {{$forum->session->name}}</span></p>
			<p class="author">Creado por <strong>{{!empty($forum->user->institution) ? $forum->user->institution : ''}}</strong> <span>{{$forum->created_at->diffForHumans()}}</span></p>
		</div>
		<div class="col-sm-12 col-xs-12">
			<div class="divider"></div>
		</div>
	</div>

</div>
@endforeach

<?php /**
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			@foreach ($forums as $forum)
				<p>{{$forum->topic}}</p>
				<p>{{$forum->user->institution}}</p>
			 @endforeach
			<table class="table">
			  <thead>
			    <tr>
			      <th>Tema</th>
						<th>Sesión</th>
			      <th>Descripción</th>
			      <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			    @foreach ($forums as $forum)
			 
						@if($forum->session)
				      <tr>
				        <td><h4> <a href="{{ url('tablero/foros/'.$forum->session->slug.'/'.$forum->slug.'/ver') }}">{{$forum->topic}}</a></h4></td>
							  <td>{{$forum->session->name}}</td>
	              <td>{{str_limit($forum->description, $limit = 20, $end = '...')}}</td>
				        <td>
				          <a href="{{ url('tablero/foros/' .$forum->session->slug.'/'.$forum->slug.'/ver') }}" class="btn xs view">Ver</a>
				        </td>
						</tr>
						@else
						<tr>
							<td><h4> <a href='{{url("tablero/foros/{$user->fellowData->state}")}}'>{{$forum->topic}}</a></h4></td>
							<td>Sin sesión</td>
							<td>{{str_limit($forum->description, $limit = 20, $end = '...')}}</td>
							<td>
								<a href='{{url("tablero/foros/{$user->fellowData->state}")}}' class="btn xs view">Ver</a>
							</td>
					</tr>
						@endif
						   
			    @endforeach
			  </tbody>
			</table>

			{{ $forums->links() }}
		</div>
	</div>
</div>
**/?>

@else
<div class="row">
  <div class="col-sm-12">
    <p>Sin foros</p>
  </div>
</div>
@endif
@endsection
