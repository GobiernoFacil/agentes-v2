@extends('layouts.admin.a_master')
@section('title', $forum->topic )
@section('description',$forum->topic  )
@section('body_class', 'fellow foros')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
	<!-- título-->
	<div class="col-sm-9">
		<h1>{{$forum->topic}}</h1>		
		
	</div>
	<!-- agregar pregunta-->
	<div class="col-sm-3 center">
		@if($session)
		<a href='{{ url("tablero/foros/{$session->slug}/pregunta/crear") }}' class="btn gde download">Agregar Pregunta o Tema al foro [<strong>+</strong>]</a>
		@else
		<a href='{{ url("tablero/foros/pregunta/estado/{$user->FellowData->state}/crear") }}' class="btn gde download">Agregar Pregunta o Tema [<strong>+</strong>]</a>
		@endif
	</div>
	<!-- descripción-->
	<div class="col-sm-12 forum_list">
		<div class="divider top"></div>
		@if($session)
		<p><span class="type module_session">{{$forum->session->module->title}} / {{$forum->session->name}}</span></p>
		@else
		<p><span class="type state">Estado</span></p>
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
		<div class="col-sm-12">
			<table class="table">
			  <thead>
			    <tr>
			      <th>Tema</th>
			      <th>Descripción</th>
			      <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			    @foreach ($forums as $conversation)
			      <tr>
							@if($session)
			        <td><h4> <a href="{{ url('tablero/foros/pregunta/'.$session->slug.'/'.$conversation->slug.'/ver') }}">{{$conversation->topic}}</a></h4></td>
							@else
							<td><h4> <a href="{{ url('tablero/foros/'.$user->FellowData->state.'/'.$conversation->slug.'/ver') }}">{{$conversation->topic}}</a></h4></td>
							@endif
              <td>{{str_limit($conversation->description, $limit = 20, $end = '...')}}</td>
			        <td>
								@if($session)
			          <a href="{{ url('tablero/foros/pregunta/'.$session->slug.'/'.$conversation->slug.'/ver') }}" class="btn xs view">Ver</a>
								@else
								<a href="{{ url('tablero/foros/'.$user->FellowData->state.'/'.$conversation->slug.'/ver') }}" class="btn xs view">Ver</a>
								@endif
					</tr>
			    @endforeach
			  </tbody>
			</table>

			{{ $forums->links() }}
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
			@if($session)
				<a href='{{ url("tablero/foros/{$session->slug}/pregunta/crear") }}' class="btn gde download">Agregar Pregunta o Tema al foro[<strong>+</strong>]</a>
			@else
				<a href='{{ url("tablero/foros/pregunta/estado/{$user->FellowData->state}/crear") }}' class="btn gde download">Agregar Pregunta o Tema al foro[<strong>+</strong>]</a>
			@endif
  		</div>
	</div>
</div>
@endif
@endsection
