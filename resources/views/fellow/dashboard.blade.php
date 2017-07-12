@extends('layouts.admin.a_master')
@section('title', 'Tablero de Control')
@section('description', 'Tablero de control de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'dashboard fellow')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Tablero de control</h1>
	</div>
	<div class="col-sm-9">
		<!--proximas actividades-->
<div class="row">
	<div class="col-sm-12">
		<div class="divider b"></div>
		<h2>Próximas evaluaciones</h2>
		@if($next_activities->count()>0)
				@include('fellow.next-activity-dash-view')
		@else
		<div class="box session_list">
			<div class="row">
				<div class="col-sm-12">
					<p><strong>No hay evaluaciones próximas.</strong></p>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>
	</div>
	<div class="col-sm-3">
		<div class="box blue center">
			<h2>Calificaciones</h2>
			<a href="{{url('tablero/calificaciones')}}" class="btn view gde">Ver calificaciones</a></h2>
		</div>
		<div class="box ">
					<h3 class="sa_title">Tus Conversaciones</h3>
					<a href="{{ url('tablero/mensajes') }}" class="count_link">{{$user->conversations->count()}}</a>
					<a href="{{ url('tablero/mensajes') }}" class="btn gde">Ver todos los mensajes</a>
				</div>
	</div>
</div>


<!--actividad-->
<div class="row">
	<div class="col-sm-12">
		<div class="divider b"></div>
		<h2>Tu última actividad</h2>
		@if($user->log->count()>0)
			@if($session)
				@include('fellow.session-dash-view')
			@elseif($activity)
				@include('fellow.activity-dash-view')
			@else
				@include('fellow.module-dash-view')
			@endif
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
	</div>
</div>




<!-- avance-->
<div class="row">
	<div class="col-sm-12">
			<div class="box">
					<h3 class="sa_title">Tu avance</h3>
					<ul class="timeline">
						@if($all_modules->count()>0)
								@foreach($all_modules as $m)
										<li class="{{ $m->public && $today >= $m->start ? 'active' : 'disabled'}}">{{\Illuminate\Support\Str::words($m->title,2,'…')}}</li>
								@endforeach
						@endif
					</ul>
			</div>
  	</div>
</div>


	<div class="row">

		<div class="col-sm-6">
				<div class="box forum_list">
					<h3 class="sa_title">Tu participación en los foros</h3>
					@if($forums->count()>0 || $messagesF->count()>0)
					<ul>
						@foreach($forums as $forum)
						<li class="row">
							<span class="col-sm-2">
								<h3 class="count_messages">{{$forum->messages->count()}}</h3>
							</span>
							<span class="col-sm-10">
								@if($forum->forum)
									@if($forum->forum->session)
									<h2><a href="{{ url('tablero/foros/' .$forum->forum->session->module->slug.'/'.$forum->forum->session->slug) }}">{{$forum->topic}}</a></h2>
									@else
										@if($forum->forum->slug==='foro-general')
										<h2><a href="{{url("tablero/foros/{$forum->forum->slug}")}}">{{$forum->topic}}</a></h2>
										@else
										<h2><a href="{{url("tablero/foros/{$user->fellowData->state}")}}">{{$forum->topic}}</a></h2>
										@endif
									@endif
								@endif
							<p><span>Preguntado {{$forum->created_at->diffForHumans()}}</span></p>
							</span>
						</li>
						@endforeach
						@foreach($messagesF as $mes)
						<li class="row">
							<span class="col-sm-2">
								<h3 class="count_messages">{{$mes->conversation->messages->count()}}</h3>
							</span>
							<span class="col-sm-10">
							@if($mes->conversation->forum->session)
							<h2><a href="{{ url('tablero/foros/' .$mes->conversation->forum->session->module->slug.'/'.$mes->conversation->forum->session->slug) }}">{{$mes->conversation->topic}}</a></h2>
							@else
							<h2><a href="{{url("tablero/foros/{$user->fellowData->state}")}}">{{$mes->conversation->topic}}</a></h2>
							@endif
							<p><span>Creado {{$mes->conversation->forum->created_at->diffForHumans()}}</span></p>
							</span>
						</li>
						@endforeach
					</ul>
					@else
					<p>Aún no cuentas con participación en foros.</p>
					@endif
					<a href="{{ url('tablero/foros') }}" class="btn gde center">Ver los foros</a>
				</div>
			<div class="box ">
							<h3 class="sa_title">Tus archivos</h3>
							<a href="{{ url('tablero/perfil/archivos') }}" class="count_link">{{$user->fellowFiles->count()}}</a>
							<a href="{{ url('tablero/perfil/archivos') }}" class="btn gde">Ver todos los archivos</a>
						</div>
		</div>


		<!--noticias-->
		<div class="col-sm-6">
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
						<p><a href="{{url('tablero/noticias')}}" class="btn view gde ">Ver todas las noticas y avisos</a></p>
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
