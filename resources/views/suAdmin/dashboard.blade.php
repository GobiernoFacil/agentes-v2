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
	<div class="col-sm-9">
		<div class="row">
			<div class="col-sm-6 center">
				<div class="box ">
					<h3 class="sa_title">Super administradores</h3>
					<a href="{{ url('sa/dashboard/super-administradores') }}" class="count_link">{{ $sum_suAdmin }}</a>
					<a href="{{ url('sa/dashboard/super-administradores/agregar') }}" class="btn gde">Agregar superadministrador</a>
				</div>
			</div>
			<div class="col-sm-6 center">
				<div class="box">
					<h3 class="sa_title">Administradores</h3>
					<a href="{{ url('sa/dashboard/administradores') }}" class="count_link">{{ $sum_Admin }}</a>
					<a href="{{ url('sa/dashboard/administradores/agregar') }}" class="btn gde">Agregar administrador</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="box">
			<p>En este tablero podrás consultar, crear y eliminar usuarios de la plataforma del <strong>Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</strong>.</p>
		</div>
	</div>
</div>
@endsection