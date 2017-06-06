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
				<div class="box center">
					<h3 class="sa_title">Módulos</h3>
					<a class="count_link" href="{{url('dashboard/modulos')}}">{{$modules_count}}</a>
					<a href="{{url('dashboard/modulos')}}" class="btn gde">Lista de Módulos</a>
					<a href="{{url('dashboard/modulos/agregar')}}" class="btn gde download">[+] Agregar Módulo</a>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="box center">
					<h3 class="sa_title">Facilitadores</h3>
					<a class="count_link" href="{{url('dashboard/facilitadores')}}">{{$facilitators_count}}</a>
					<a href="{{url('dashboard/facilitadores')}}" class="btn gde">Lista de Facilitadores</a>
					<a href="{{url('dashboard/facilitadores/agregar')}}" class="btn gde download">[+] Agregar Facilitador</a>
				</div>
			</div>
			
		</div>
	</div>
	
</div>
@endsection