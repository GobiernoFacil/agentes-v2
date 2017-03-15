@extends('layouts.admin.a_master')
@section('title', 'Agregar usuario administrador')
@section('description', 'Agregar usuario a la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'users')
@section('breadcrumb_type', 'users add')
@section('breadcrumb', 'layouts.suAdmin.breadcrumbs.b_users')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Agregar usuario administrador</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
@include('suAdmin.users.forms.admin-add-form')
		</div>
	</div>
</div>
@endsection