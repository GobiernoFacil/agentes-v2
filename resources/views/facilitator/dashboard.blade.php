@extends('layouts.admin.a_master')
@section('title', 'Tablero de control de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Tablero de control de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'dashboard')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1 class="center">Programa de Formación de <strong>Agentes Locales de Cambio</strong> en <strong>Gobierno Abierto y Desarrollo Sostenible</strong>. </h1>
		<p class="center">En este tablero podrás consultar las actividades que se te han asignado.</p>
		<div class="divider bg"></div>
	</div>
</div>

<div class="row">
	<div class="col-sm-6">
				<div class="module">
					<div class="m_header">
						<h4>Actividades</h4>
					</div>
					<div class="m_content">
						<div class="row">
							<div class="col-sm-4">
								<h2>{{$user->facilitatorSessions ? $user->facilitatorSessions->count() : '0'}}</h2>
							</div>
							<div class="col-sm-8">
								<a href="{{ url('tablero-facilitador/actividades') }}" class="btn gde download">Ver actividades</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="module">
					<div class="m_header">
						<h4>Conversaciones</h4>
					</div>
					<div class="m_content">
						<div class="row">
							<div class="col-sm-4">
								<h2>{{$conversations}}</h2>
							</div>
							<div class="col-sm-8">
								<a href="{{ url('tablero-facilitador/mensajes') }}" class="btn gde download">Ver conversaciones</a>
							</div>
						</div>
					</div>
				</div>
			</div>
	<div class="col-sm-3">
		<div class="box session_list last_activity">
			<p><a href="{{ url('tablero-facilitador/perfil/editar') }}" class="btn view">Editar información de tu perfil</a></p>
		</div>
	</div>
	<div class="col-sm-9">
		<div class="row">
			
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
