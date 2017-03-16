@extends('layouts.admin.a_master')
@section('title', 'Actualizar super administrador')
@section('description', 'Actualizar super administrador a la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'suAdmin')
@section('breadcrumb_type', 'users sua edit')
@section('breadcrumb', 'layouts.suAdmin.breadcrumbs.b_suAdmins')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Editar super adminsitrador: <strong>{{$suAdmin->name}}</strong></h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			@include('suAdmin.users.forms.suAdmin-update-form')
		</div>
	</div>
</div>
@endsection