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
					<a href="{{ url('tablero-facilitador/actividades') }}" class="count_link">0</a>					
				</div>			
			</div>
			<div class="col-sm-6 center">
				<div class="box">
					<h3 class="sa_title">Mensajes</h3>
					<a href="{{ url('tablero-facilitador/mensajes') }}" class="count_link">0</a>					
				</div>			
			</div>
		</div>
	</div>
	
</div>
@endsection

