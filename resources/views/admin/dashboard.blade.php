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
		<div class="box blue">
			<h3 class="sa_title">Aspirantes totales</h3>
			<a class="count_link"  href="{{ url('dashboard/aspirantes') }}">{{$aspirants}}</a>
			<a href="{{ url('dashboard/aspirantes') }}" class="btn gde">Lista de Aspirantes</a>
		</div>
		<div class="box">
			<p>En este tablero podrás consultar si existen aspirantes a la convocatoria del <strong>Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</strong>.</p>
		</div>
	</div>
	<div class="col-sm-9">
		<div class="row">
			<div class="col-sm-6">
				<div class="box">
					<h3 class="sa_title">Módulos</h3>
					<a class="count_link" href="{{url('dashboard/modulos')}}">{{$modules_count}}</a>
					<a href="{{url('dashboard/modulos')}}" class="btn gde">Lista de Módulos</a>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="box">
					<h3 class="sa_title">Facilitadores</h3>
					<a class="count_link" href="{{url('dashboard/facilitadores')}}">{{$facilitators_count}}</a>
					<a href="{{url('dashboard/facilitadores')}}" class="btn gde">Lista de Facilitadores</a>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="box">
					<h2>Aspirantes por Estado</h2>
					<ul class="inline">
						<li>Chihuahua: <strong>{{$chihuahua_number}}</strong></li>
						<li>Morelos: <strong>{{$morelos_number}}</strong></li>
						<li>Nuevo León: <strong>{{$leon_number}}</strong></li>
						<li>Oaxaca: <strong>{{$oaxaca_number}}</strong></li>
						<li>Sonora: <strong>{{$sonora_number}}</strong></li>
					</ul>
					<div id="bar"></div>					
				</div>
				<div class="box">
					<h2>Aspirantes por Sector</h2>
					<ul class="inline">
						<li>Gobierno: <strong>{{$gobierno_number}}</strong></li>
						<li>Sociedad Civil: <strong>{{$civil_number}}</strong></li>
						<li>Sector Privado: <strong>{{$privado_number}}</strong></li>
						<li>Sector Académico: <strong>{{$academico_number}}</strong></li>
					</ul>
					<div id="bar2"></div>					
				</div>
			</div>
			<?php /*
			<div class="col-sm-4 center">
				<div class="box ">
					<h3 class="sa_title">Chihuahua</h3>
					<div class="count_link">{{$chihuahua_number}}</div>
				</div>
			</div>
			<div class="col-sm-4 center">
				<div class="box ">
					<h3 class="sa_title">Morelos</h3>
					<div class="count_link">{{$morelos_number}}</div>
				</div>
			</div>
			<div class="col-sm-4 center">
				<div class="box ">
					<h3 class="sa_title">Nuevo León</h3>
					<div class="count_link">{{$leon_number}}</div>
				</div>
			</div>
			<div class="col-sm-4 center">
				<div class="box ">
					<h3 class="sa_title">Oaxaca</h3>
					<div class="count_link">{{$oaxaca_number}}</div>
				</div>
			</div>
			<div class="col-sm-4 center">
				<div class="box ">
					<h3 class="sa_title">Sonora</h3>
					<div class="count_link">{{$sonora_number}}</div>
				</div>
			</div>
			*/?>
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
		"estado": "Chihuahua",
		"total" : {{$chihuahua_number}}
	},
	{
		"estado": "Morelos",
		"total" : {{$morelos_number}}
	},
	{
		"estado": "Nuevo León",
		"total" : {{$leon_number}}
	},
	{
		"estado": "Oaxaca",
		"total" : {{$oaxaca_number}}
	},
	{
		"estado": "Sonora",
		"total" : {{$sonora_number}}
	}
	];
	var dataorigin = [
	{
		"origin": "Gobierno",
		"total" : {{$gobierno_number}}
	},
	{
		"origin": "Sociedad Civil",
		"total" : {{$civil_number}}
	},
	{
		"origin": "Sector Privado",
		"total" : {{$privado_number}}
	},
	{
		"origin": "Sector Académico",
		"total" : {{$academico_number}}
	}
	];
</script>
<script src="{{ url('js/dashboard.js') }}"></script>
@endsection