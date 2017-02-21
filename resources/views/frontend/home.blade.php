@extends('layouts.frontend.master')
@section('title', 'Gobierno Abierto desde lo local para el desarrollo sostenible')
@section('description', 'Plataforma en línea de vinculación, aprendizaje continuo, intercambio de experiencias y acción coordinada de los agentes de cambio formados en el fellowship')
@section('body_class', 'home')
@section('canonical', '' )

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<div class="bgdimg">
			<figure>
				<img src="{{url('img/home_bgd.jpg')}}" alt="Gobierno Abierto desde lo local para el desarrollo sostenible">
			</figure>
			<div class="cta">
				<div class="col-sm-8 col-sm-offset-2">
				<h1>SÉ UN <strong>AGENTE DE CAMBIO</strong></h1>
				<h2>Programa de Fortalecimiento de Capacidades para <strong>Agentes de Cambio</strong> de <strong>Gobierno Abierto</strong></h2>
				<h3>Convocatoria abierta del <span><strong>3 al 31 de marzo de 2017</strong></span></h3>
				<a href="#" class="btn">Participa</a>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
		<h2 class="title">PROGRAMA DE FORTALECIMIENTO DE CAPACIDADES PARA <strong>AGENTES DE CAMBIO</strong> DE <strong>GOBIERNO ABIERTO</strong></h2>
	</div>
	<div class="col-sm-10 col-sm-offset-1">
		<p>El objetivo del Programa es contribuir al fortalecimiento de una buena gobernanza en México a partir de prácticas de <strong>Gobierno Abierto</strong>, participación ciudadana, transparencia y anticorrupción; con esquemas innovadores de desarrollo de capacidades y de vinculación social que permitan el empoderamiento de agentes de cambio, así como el impulso de espacios de diálogo y co creación a nivel subnacional.</p>
		<p>Esta es una iniciativa del <a href="http://www.mx.undp.org/">Programa de las Naciones Unidas para el Desarrollo (PNUD)</a> y estará apoyado permanentemente por actores tanto del gobierno como de la sociedad civil: el <a href="http://inicio.ifai.org.mx">Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales (INAI)</a>, <a href="http://www.gesoc.org.mx/site/">Gestión Social y Cooperación (GESOC)</a>, <a href="https://gobiernofacil.com">Gobierno Fácil</a> y <a href="http://www.prosociedad.org/">ProSociedad Hacer el Bien</a>. Conoce más sobre el proyecto:</p>
		<div class="row">
			<div class="col-sm-4">
				<h3>PROGRAMA</h3>
			</div>
			<div class="col-sm-4">
				<h3>CONVOCATORIA</h3>
			</div>
			<div class="col-sm-4">
				<h3>ALCANCE</h3>
			</div>
		</div>
	</div>
</div>
<div class="map_container">
  <!-- el mapa! -->
  <div id="map"></div>
</div>
@endsection