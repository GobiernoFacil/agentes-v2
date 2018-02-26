@extends('layouts.frontend.master')
@section('title', 'Alcance del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Alcance del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'programa alcance')
@section('canonical', url('programa-gobierno-abierto/alcance') )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_programa')
@section('css-custom','js/bower_components/leaflet/dist/leaflet.css')

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1><strong>Alcance</strong> del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</h1>
		<p>En este componente del proyecto se desarrollará un piloto para el impulso de los espacios institucionalizados de diálogo y co-creación de compromisos alineados a los Objetivos de Desarrollo Sostenible, con las siguientes entidades federativas: Chihuahua, Morelos, Nuevo León, Oaxaca y Sonora. La selección de las entidades federativas se realizó otorgando prioridad a aquellos estados que estén participando desde 2015 en los ejercicios de gobierno abierto local promovidos por el <strong>INAI</strong>, y procurando garantizar representación geográfica. Asimismo, se consideraron estados en diferentes momentos de avance en cuanto a la instalación de sus Secretariados Tripartitas Locales y en relación al diseño e implementación de sus planes de acción.</p>
	</div>
	<div class="col-sm-4 col-sm-offset-2">
		<h3>Edición 2018</h3>
		<ol>
			<li><a href="{{ url('programa-gobierno-abierto/alcance/campeche')}}">Campeche</a></li>
			<li><a href="{{ url('programa-gobierno-abierto/alcance/durango')}}">Durango</a></li>
			<li><a href="{{ url('programa-gobierno-abierto/alcance/estado-de-mexico')}}">Estado de México</a></li>
			<li><a href="{{ url('programa-gobierno-abierto/alcance/guanajuato')}}">Guanajuato</a></li>
			<li><a href="{{ url('programa-gobierno-abierto/alcance/quintana-roo')}}">Quintana Roo</a></li>
			<li><a href="{{ url('programa-gobierno-abierto/alcance/san-luis-potosi')}}">San Luis Potosí</a></li>
			<li><a href="{{ url('programa-gobierno-abierto/alcance/sinaloa')}}">Sinaloa</a></li>
			<li><a href="{{ url('programa-gobierno-abierto/alcance/tabasco')}}">Tabasco</a></li>
			<li><a href="{{ url('programa-gobierno-abierto/alcance/tlaxcala')}}">Tlaxcala</a></li>
			<li><a href="{{ url('programa-gobierno-abierto/alcance/veracruz')}}">Veracruz</a></li>
		</ol>
	</div>
	<div class="col-sm-4">
		<h3>Edición 2017</h3>
		<ol>
			<li><a href="{{ url('programa-gobierno-abierto/alcance/chihuahua')}}">Chihuahua</a></li>
			<li><a href="{{ url('programa-gobierno-abierto/alcance/morelos')}}">Morelos</a></li>
			<li><a href="{{ url('programa-gobierno-abierto/alcance/nuevo-leon')}}">Nuevo León</a></li>
			<li><a href="{{ url('programa-gobierno-abierto/alcance/oaxaca')}}">Oaxaca</a></li>
			<li><a href="{{ url('programa-gobierno-abierto/alcance/sonora')}}">Sonora</a></li>
		</ol>
	</div>
</div>

@endsection
