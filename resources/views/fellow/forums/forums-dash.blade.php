@extends('layouts.admin.a_master')
@section('title', 'Foros del ' .$program->title)
@section('description','Foros del Programa de Gobierno Abierto desde lo local' )
@section('body_class', 'fellow foros')
@section('breadcrumb_type', 'forum list')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_forum')

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
<div class="row">
	<div class="col-sm-1">
		<img src="{{ url('img/svg/foro.svg') }}" alt="Foro de actividades" width="100px">
	</div>
	<div class="col-sm-8">
		<h1>Foros de actividades</h1>
		<p>Foros del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible. Si tienes alguna duda sobre el contenido del programa, agrega una pregunta en el foro general</p>
	</div>
	<div class="col-sm-2 col-sm-offset-1">
		<a href="{{url('tablero/' . $program->slug . '/foros/actividades')}}" class="btn view block sessions_l">Ir a foros</a>
	</div>
	<div class="col-sm-12">
		<div class="divider bg"></div>
	</div>
</div>
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
					<a href='{{ url("tablero/$program->slug/foros/$forum->slug") }}' class="btn view block sessions_l">Ir a foro</a>
				</div>
				<div class="col-sm-12">
					<div class="divider bg"></div>
				</div>
			</div>
			@endif
			@if($forum->type ==='state')
			<div class="row">
				<div class="col-sm-1">
					<img src="{{ url('img/svg/estado.svg') }}" alt="Foro de actividades" width="100px">
				</div>
				<div class="col-sm-8">
					<h1>Foro de tu estado</h1>
					<p>En este foro podrás comunicarte con personas de tu mismo estado.</p>
				</div>
				<div class="col-sm-2 col-sm-offset-1">
					<a href='{{ url("tablero/$program->slug/foros/$forum->slug") }}' class="btn view block sessions_l">Ir a foro</a>
				</div>
				<div class="col-sm-12">
					<div class="divider bg"></div>
				</div>
			</div>
			@endif
@endforeach

@endsection
