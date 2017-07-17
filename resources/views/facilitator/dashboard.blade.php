@extends('layouts.admin.a_master')
@section('title', 'Tablero de Control')
@section('description', 'Tablero de control de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'dashboard')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Tablero de control</h1>
	</div>
</div>

<div class="row">
	<div class="col-sm-3">
		<div class="box">
			<p>En este tablero podrás consultar las actividades que se te han asignado del <strong>Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</strong>.</p>
		</div>
		<div class="box">
			<p><a href="{{ url('tablero-facilitador/perfil/editar') }}" class="btn view">Editar información de tu perfil</a></p>
		</div>
	</div>
	<div class="col-sm-9">
		<div class="row">
			<div class="col-sm-6 center">
				<div class="box">
					<h3 class="sa_title">Actividades</h3>
					<a href="{{ url('tablero-facilitador/actividades') }}" class="count_link">{{$user->facilitatorSessions ? $user->facilitatorSessions->count() : '0'}}</a>
				</div>
			</div>
			<div class="col-sm-6 center">
				<div class="box">
					<h3 class="sa_title">Conversaciones</h3>
					<a href="{{ url('tablero-facilitador/mensajes') }}" class="count_link">{{$conversations}}</a>
				</div>
			</div>
			<!--noticias-->
			<div class="col-sm-12">
				<div class="box news">
					<h3 class="sa_title">Noticias y avisos</h3>
					<p></p>
					@if($newsEvent->count()>0)
					<ul class="list line">
						@foreach($newsEvent as $article)
						@include('layouts.news.dashboard-news-list')
						@endforeach
					</ul>
					<div class="row">
						<div class="col-sm-12">
							<div class="divider"></div>
						</div>
						<div class="col-sm-8 col-sm-offset-2 center">
							<p><a href="{{url('tablero-facilitador/noticias')}}" class="btn view gde ">Ver todas las noticas y avisos</a></p>
						</div>
					@else
					<p>Aún no existen noticias o avisos.</p>
					@endif
				</div>
			</div>
		</div>
	</div>
	

</div>
@endsection
