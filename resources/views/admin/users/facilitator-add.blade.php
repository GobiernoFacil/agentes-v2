@extends('layouts.admin.a_master')
@section('title', 'Agregar usuario facilitador')
@section('description', 'Agregar usuario a la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Agregar usuario facilitador</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
      @include('admin.users.form.facilitator-add-form')
		</div>
	</div>
</div>
@endsection
