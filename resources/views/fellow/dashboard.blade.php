@extends('layouts.admin.a_master')
@section('title', 'Tablero de Control')
@section('description', 'Tablero de control de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'dashboard fellow')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Tablero de control</h1>
	</div>
	<div class="col-sm-12">
		<div class="box">
			<p>Bienvenido {{$user->name}} a la plataforma del <strong>Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</strong>.</p>
		</div>
	</div>
</div>

<!--actividad-->
<div class="row">
	<div class="col-sm-12">
		<h2>Tu última actividad</h2>
		@if($user->log->count()>0)
		<div class="box session_list">
		  <div class="row">
				@if($session)
					@include('fellow.session-dash-view')
				@elseif($activity)
					@include('fellow.activity-dash-view')
				@else
					@include('fellow.module-dash-view')
				@endif
			</div>
		</div>

	@else
	<div class="box session_list">
		<div class="row">
			<div class="col-sm-12">
					<p><strong>Aún no cuentas con actividad, inicia tu curso.</strong></p>
			</div>
			@include('fellow.module-first-dash-view')
		</div>
</div>
	@endif

<!-- avance-->
<div class="row">
	<div class="col-sm-12">
		<h2>Tu avance</h2>
		<div class="box">
		<ul class="timeline">
					<li class="active">Propedeutico</li>
					<li class="disabled">Batman vs Superman</li>
				</ul>
		</div>
  	</div>
</div>


	<div class="row">
		<div class="col-sm-4 center">
				<div class="box ">
					<h3 class="sa_title">Tus Conversaciones</h3>
					<a href="{{ url('tablero/mensajes') }}" class="count_link">{{$user->conversations->count()}}</a>
					<a href="{{ url('tablero/mensajes') }}" class="btn gde">Ver todos los mensajes</a>
				</div>
			</div>
		<div class="col-sm-8">
				<div class="box ">
					<h3 class="sa_title">Tu participación en los foros</h3>
					<ul>
						<li class="row">
							<span class="col-sm-2">
							1 respuesta
							</span>
							<span class="col-sm-10">
							<h3>¿qué comen los pandas?</h3>
							<p class="right">Preguntado hace 2 días</p>
							</span>
						</li>
						<li class="row">
							<span class="col-sm-2">
							89 respuesta
							</span>
							<span class="col-sm-10">
							<h3>¿Qué es el gobierno abierto?</h3>
							<p class="right">Contestado hace 3 días</p>
							</span>
						</li>
						<li class="row">
							<span class="col-sm-2">
							109 respuesta
							</span>
							<span class="col-sm-10">
							<h3>¿Qué leyes obligan al gobierno a garantizar el acceso a la información?</h3>
							<p class="right">Preguntado hace 3 días</p>
							</span>
						</li>
					</ul>
					<a href="{{ url('tablero/foros') }}" class="btn gde center">Ver los foros</a>
				</div>
			</div>
		</div>

		<!--noticias-->
		<div class="col-sm-12">
			<h2>Noticias y avisos</h2>
			@if($newsEvent->count()>0)
			<ul>
				@foreach($newsEvent as $content)
				<li><h3>{{$content->title}}</h3>
				<p>descripción de la noticia</p>
				<p>{{date("d-m-Y", strtotime($content->created_at))}}</p>
				</li>
				@endforeach
			</ul>
			@else
			<div class="box">
				<p>Aún no existen noticias o avisos.</p>
			</div>
			@endif

		</div>

	</div>

</div>
@endsection
