@extends('layouts.admin.a_master')
@section('title', 'Foros del Programa de Gobierno Abierto desde lo local')
@section('description','Foros del Programa de Gobierno Abierto desde lo local' )
@section('body_class', 'foros')
@section('breadcrumb_type', 'forum list')
@section('breadcrumb', 'layouts.facilitator.breadcrumb.b_forums')

@section('content')
@if(Session::has('message'))
	<div class="col-sm-12 message success">
			{{ Session::get('message') }}
	</div>
@endif

@if(Session::has('error'))
	<div class="col-sm-12 message error">
			{{ Session::get('error') }}
	</div>
@endif

@if($program)
	<div class="row">
		<div class="col-sm-9">
			<h1>Foros del programa "{{$program->title}}"</h1>
		</div>
	  <div class="col-sm-12">
	    <div class="divider bg"></div>
	  </div>
	</div>
	<div class="row">
		<div class="col-sm-1">
			<img src="{{ url('img/svg/foro.svg') }}" alt="Foro de actividades" width="100px">
		</div>
		<div class="col-sm-8">
			<h1>Foros de actividades</h1>
			<p>Foros del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible. Aquí podrás encontrar los foros de las actividades y el foro general</p>
		</div>
		<div class="col-sm-2 col-sm-offset-1">
			<a href="{{url('tablero-facilitador/foros/ver-foros/actividades')}}" class="btn view block sessions_l">Ir a foros</a>
		</div>
		<div class="col-sm-12">
			<div class="divider bg"></div>
		</div>
	</div>

	<?php $done = false; ?>
	@foreach ($forums as $forum)
				@if($forum->type ==='support')
				<div class="row">
					<div class="col-sm-1">
						<img src="{{ url('img/svg/herramientas.svg') }}" alt="Foro de actividades" width="100px">
					</div>
					<div class="col-sm-8">
						<h1>Foro técnico</h1>
						<p>Si tienes algún problema, duda o comentario con respecto al funcionamiento de la plataforma, agrega tus preguntas en este foro. <br>Los mensajes son respondidos de lunes a viernes de 9 a 18 horas por <strong>Argentina Velasco</strong> y <strong>Boris Cuapio</strong> de Gobierno Fácil. Los fines de semana las respuestas serán limitadas salvo casos excepcionales relacionados con fallas en la plataforma.</p>
					</div>
					<div class="col-sm-2 col-sm-offset-1">
						<a href='{{ url("tablero-facilitador/foros/ver-foro/$forum->id") }}' class="btn view block sessions_l">Ir a foro</a>
					</div>
					<div class="col-sm-12">
						<div class="divider bg"></div>
					</div>
				</div>
				@endif
				@if($forum->type ==='state' && !$done)
	      <?php $done = true; ?>
				<div class="row">
					<div class="col-sm-1">
						<img src="{{ url('img/svg/estado.svg') }}" alt="Foro de actividades" width="100px">
					</div>
					<div class="col-sm-8">
						<h1>Foros de los estados</h1>
						<p>Aquí se encuentran los foros por estado.</p>
					</div>
					<div class="col-sm-2 col-sm-offset-1">
						<a href="{{url('tablero-facilitador/foros/ver-foros/estados')}}" class="btn view block sessions_l">Ir a foro</a>
					</div>
					<div class="col-sm-12">
						<div class="divider bg"></div>
					</div>
				</div>
				@endif
	@endforeach
@else
<div class="row">
	<div class="col-sm-9">
		<h1>Foros</h1>
	</div>
	<div class="col-sm-12">
		<div class="divider bg"></div>
	</div>
	<div class="col-sm-8">
		<p><strong>Sin foros</strong></p>
	</div>
</div>
@endif

@endsection
