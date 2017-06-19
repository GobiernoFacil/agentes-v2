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
			<h3 class="sa_title">Fellows totales</h3>
			<a class="count_link"  href="{{ url('dashboard/fellows') }}">{{$fellows}}</a>
			<a href="{{ url('dashboard/fellows') }}" class="btn gde">Lista de Fellows</a>
		</div>
		<div class="box blue">
			<h3>Evaluar Examen de diagnóstico</h3>
			<p></p>
			<a href="{{ url('dashboard/evaluacion/diagnostico') }}" class="btn gde">Ir a Evaluación</a>
		</div>
	</div>
	<div class="col-sm-9">
		<div class="row">
			<div class="col-sm-6">
				<div class="box center">
					<h3 class="sa_title">Módulos</h3>
					<a class="count_link" href="{{url('dashboard/modulos')}}">{{$modules_count}}</a>
					<a href="{{url('dashboard/modulos')}}" class="btn gde">Lista de Módulos</a>
					<a href="{{url('dashboard/modulos/agregar')}}" class="btn gde download">[+] Agregar Módulo</a>
				</div>
			</div>
			<!-- facilitadores-->
			<div class="col-sm-6">
				<div class="box center">
					<h3 class="sa_title">Facilitadores</h3>
					<a class="count_link" href="{{url('dashboard/facilitadores')}}">{{$facilitators_count}}</a>
					<a href="{{url('dashboard/facilitadores')}}" class="btn gde">Lista de Facilitadores</a>
					<a href="{{url('dashboard/facilitadores/agregar')}}" class="btn gde download">[+] Agregar Facilitador</a>
				</div>
			</div>
			<!-- noticias -->
			<div class="col-sm-12">
				<div class="box news">
					<h3 class="sa_title">Noticias, eventos y avisos</h3>
					@if($news->count() > 0)
					<ul class="list line">
					@foreach($news as $article)
						<li>
						<div class="row">
							<div class="col-sm-9">
					 			@if($article->type==='event')
					 			<h4 class="type_n {{$article->type}}">Evento</h4>
					 			@elseif($article->type==='news')
					 			<h4 class="type_n {{$article->type}}">Noticia</h4>
					 			@else
					 			<h4 class="type_n {{$article->type}}">Aviso</h4>
					 			@endif
					 		</div>
					 		<div class="col-sm-3 right">
					  			<p class="author">{!! $article->public == 1 ? '<span class="published_ s">Publicado</span>' : '<span class="published_ n">Sin publicar</span>' !!} <a href="{{url('dashboard/noticias-eventos/editar/' . $article->id)}}" class="btn view">Editar {{$article->type==='event' ? "evento" : "noticia"}}</a></p>
					  		</div>
						</div>
						<h3><a href="{{url('dashboard/noticias-eventos/ver/' . $article->id)}}">{{$article->title}}</a></h3>
						<p class="author">Por {{$article->user->name}} <span>{{$article->created_at->diffForHumans()}}</span></p>
						</li>
					@endforeach
					</ul>
					@else
					<h3 class="center">No hay noticias, eventos o avisos</h3>
					@endif
					<a href="{{url('dashboard/noticias-eventos')}}" class="btn gde">Lista de Noticias, Eventos y Avisos</a>
					<a href="{{url('dashboard/noticias-eventos/agregar')}}" class="btn gde download">[+] Agregar Noticia, Evento o Aviso</a>
				</div>
			</div>
		</div>
	</div>
	
</div>
@endsection