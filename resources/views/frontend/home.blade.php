@extends('layouts.frontend.master')
@section('title', 'Gobierno Abierto desde lo local para el Desarrollo Sostenible')
@section('description', 'Plataforma en línea de vinculación, aprendizaje continuo, intercambio de experiencias y acción coordinada de los agentes de cambio formados en el fellowship')
@section('body_class', 'home')
@section('canonical', '' )
@section('css-custom','js/bower_components/leaflet/dist/leaflet.css')


@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<div class="bgdimg">
			<figure>
				<img src="{{url('img/home_bgd3.JPG')}}" alt="Gobierno Abierto desde lo local para el desarrollo sostenible">
			</figure>
			<div class="cta">
				<div class="col-sm-8 col-sm-offset-2">
					<h2>Programa de Formación de <strong>Agentes Locales de Cambio</strong> en <strong>Gobierno Abierto</strong> y Desarrollo Sostenible</h2>
					<h1></h1>
					<a href="{{url('programa-gobierno-abierto')}}" class="btn blue">¿Qué es el Programa de Formación?</a>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<div class="row">
			<div class="col-sm-4 col-xs-4">
				<a href="{{url('programa-gobierno-abierto')}}" class="icon i_programa">
					<span>PROGRAMA</span>
				</a>
			</div>
			<div class="col-sm-4 col-xs-4">
				<a href="{{url('noticias-eventos')}}" class="icon i_news">
					<span>NOTICIAS</span>
				</a>
			</div>
			<div class="col-sm-4 col-xs-4">
				<a href="{{url('gobierno-abierto')}}" class="icon i_ga">
					<span>GOBIERNO ABIERTO</span>
				</a>
			</div>
		</div>
	</div>
</div>
@endsection