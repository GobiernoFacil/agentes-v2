@extends('layouts.admin.a_master')
@section('title', 'Agregar super administrador')
@section('description', 'Agregar super administrador a la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'suAdmin')
@section('breadcrumb_type', 'users sua add')
@section('breadcrumb', 'layouts.suAdmin.breadcrumbs.b_suAdmins')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Agregar super administrador</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			@include('suAdmin.users.forms.suAdmin-add-form')
		</div>
	</div>
</div>
@endsection