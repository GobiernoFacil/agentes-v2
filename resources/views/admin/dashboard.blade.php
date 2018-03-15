@extends('layouts.admin.a_master')
@section('title', 'Tablero de Control')
@section('description', 'Tablero de control de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'dashboard')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Tablero de control</h1>
		<div class="divider"></div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
 				<div class="box">
 					<h2>Aspirantes por Estado</h2>
 					<ul class="inline">
 						<li>Campeche: <strong>{{$campeche_number}}</strong></li>
 						<li>Durango: <strong>{{$durango_number}}</strong></li>
 						<li>Estado de México: <strong>{{$edomex_number}}</strong></li>
 						<li>Guanajuato: <strong>{{$guanajuato_number}}</strong></li>
 						<li>Quintana Roo: <strong>{{$quintana_number}}</strong></li>
 						<li>San Luis Potosí: <strong>{{$sanluis_number}}</strong></li>
 						<li>Sinaloa: <strong>{{$sinaloa_number}}</strong></li>
 						<li>Tabasco: <strong>{{$tabasco_number}}</strong></li>
 						<li>Tlaxcala: <strong>{{$tlaxcala_number}}</strong></li>
 						<li>Veracruz: <strong>{{$veracruz_number}}</strong></li>
 					</ul>
 					<div id="bar"></div>					
 				</div>
 	</div>
	<div class="col-sm-6">
		<div class="module">
			<div class="m_header">
				<div class="row">
					<div class="col-sm-6">
						<h4>Programas</h4>
					</div>
					<div class="col-sm-6">
						
					</div>
				</div>
			</div>
			<!--content-->
			<div class="m_content">
				<div class="row">
					<div class="col-sm-6">
						<h2>{{$programs}}</h2>
					</div>
					<div class="col-sm-6">
						<a href="{{ url('dashboard/programas') }}" class="btn gde download">Ver programas</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="col-sm-6">
		<div class="module">
			<div class="m_header">
				<div class="row">
					<div class="col-sm-6">
						<h4>Aspirantes</h4>
					</div>
					<div class="col-sm-6">
						
					</div>
				</div>
			</div>
			<!--content-->
			<div class="m_content">
				<div class="row">
					<div class="col-sm-6">
						<h2>{{$aspirants}}</h2>
					</div>
					<div class="col-sm-6">
						<a href="{{ url('dashboard/aspirantes') }}" class="btn gde download">Ver aspirantes</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--facilitadores-->
<div class="row">
	<div class="col-sm-6">
		<div class="module">
			<div class="m_header">
				<div class="row">
					<div class="col-sm-6">
						<h4>Facilitadores</h4>
					</div>
					<div class="col-sm-6">
						
					</div>
				</div>
			</div>
			<!--content-->
			<div class="m_content">
				<div class="row">
					<div class="col-sm-6">
						<h2>{{$facilitators_count}}</h2>
					</div>
					<div class="col-sm-6">
						<a href="{{ url('dashboard/facilitadores') }}" class="btn gde download">Ver facilitadores</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="module">
			<div class="m_header">
				<div class="row">
					<div class="col-sm-6">
						<h4>Tus sesiones</h4>
					</div>
					<div class="col-sm-6">
						
					</div>
				</div>
			</div>
			<!--content-->
			<div class="m_content">
				<div class="row">
					<div class="col-sm-6">
						<h2>{{$sessions_count}}</h2>
					</div>
					<div class="col-sm-6">
						<a href="{{ url('dashboard/sesiones-asignadas/') }}" class="btn gde download">Ver sesiones</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="row">
	<div class="col-sm-3">
		<!--
		<div class="box">
			<h3 class="sa_title">Fellows totales</h3>
			<a class="count_link"  href="{{ url('dashboard/fellows') }}">{{$fellows}}</a>
			<a href="{{ url('dashboard/fellows') }}" class="btn gde">Lista de Fellows</a>
		</div>
		<div class="box blue">
			<h3>Evaluaciones</h3>
			<p></p>
			<a href="{{ url('dashboard/evaluacion') }}" class="btn gde">Ir a Evaluaciones</a>
		</div>-->
		<div class="box">
			<h3>Encuestas</h3>
			<p></p>
			<a href="{{ url('dashboard/encuestas') }}" class="btn gde">Ir a Encuestas</a>
		</div>
		<div class="box">
			<h3>Indicadores</h3>
			<p></p>
			<a href="{{ url('dashboard/indicadores') }}" class="btn gde">Ir a Indicadores</a>
		</div>
	</div>
	<div class="col-sm-9">
			<!--módulos
			<div class="col-sm-6">
				<div class="box center">
					<h3 class="sa_title">Módulos</h3>
					<a class="count_link" href="{{url('dashboard/modulos')}}">{{$modules_count}}</a>
					<a href="{{url('dashboard/modulos')}}" class="btn gde">Lista de Módulos</a>
					<a href="{{url('dashboard/modulos/agregar')}}" class="btn gde download">[+] Agregar Módulo</a>
				</div>
			</div>-->
			
			<!--mensajes
			<div class="col-sm-6">
				<div class="box center">
					<h3 class="sa_title">Mensajes</h3>
					<a class="count_link"  href="{{ url('dashboard/mensajes') }}">{{$conversations_count}}</a>
					<a href="{{ url('dashboard/mensajes') }}" class="btn gde">Lista de Mensajes</a>
				</div>
			</div>-->
			
			<!-- noticias -->
			<div class="module">
			<div class="m_header">
				<div class="row">
					<div class="col-sm-6">
						<h4>Noticias, eventos y avisos</h4>
					</div>
					<div class="col-sm-6">
						
					</div>
				</div>
			</div>
			<!--content-->
			<div class="m_content">
				<div class="row">
					<div class="col-sm-12">
						@if($news->count() > 0)
						<ul class="list line">
						@foreach($news as $article)
							@include('layouts.news.dashboard-news-list')
						@endforeach
						</ul>
						@else
						<h3 class="center">No hay noticias, eventos o avisos</h3>
						@endif
					</div>
					<div class="col-sm-6">
						<a href="{{url('dashboard/noticias-eventos')}}" class="btn gde">Lista de Noticias, Eventos y Avisos</a>
					</div>
					<div class="col-sm-6">
						<a href="{{url('dashboard/noticias-eventos/agregar')}}" class="btn gde download">[+] Agregar Noticia, Evento o Aviso</a>
					</div>
				</div>
			</div>
		</div>
		
		</div>
</div>
@endsection

@section('js-content')
<!-- load the d3.js library -->    	
<script src="{{ url('js/d3/d3.v4.min.js')}}"></script>
<script>
	var data = [
	{
		"estado": "Campeche",
		"total" : {{$campeche_number}}
	},
	{
		"estado": "Durango",
		"total" : {{$durango_number}}
	},
	{
		"estado": "Estado de México",
		"total" : {{$edomex_number}}
	},
	{
		"estado": "Guanajuato",
		"total" : {{$guanajuato_number}}
	},
	{
		"estado": "Quintana Roo",
		"total" : {{$quintana_number}}
	},
	{
		"estado": "San Luis Potosí",
		"total" : {{$sanluis_number}}
	},
	{
		"estado": "Sinaloa",
		"total" : {{$sinaloa_number}}
	},
	{
		"estado": "Tabasco",
		"total" : {{$tabasco_number}}
	},
	{
		"estado": "Tlaxcala",
		"total" : {{$tlaxcala_number}}
	},
	{
		"estado": "Veracruz",
		"total" : {{$veracruz_number}}
	},
	];
</script>
<script src="{{ url('js/dashboard.js') }}"></script>
@endsection
