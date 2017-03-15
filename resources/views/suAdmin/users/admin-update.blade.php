@extends('layouts.admin.a_master')
@section('title', 'Editar usuario')
@section('description', 'Editar usuario de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'users')
@section('breadcrumb_type', 'users edit')
@section('breadcrumb', 'layouts.suAdmin.breadcrumbs.b_users')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Editar usuario</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			@include('suAdmin.users.forms.admin-update-form')
		</div>
	</div>
</div>
@endsection
