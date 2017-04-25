@extends('layouts.admin.a_master')
@section('title', 'Actualizar facilitador: ' . $facilitator->name)
@section('description', 'Actualizar facilitador en la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'facilitadores')
@section('breadcrumb_type', 'facilitadores edit')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_facilitadores')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Actualizar usuario facilitador: <strong>{{$facilitator->name}}</strong></h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
      @include('admin.users.form.facilitator-update-form')
		</div>
	</div>
</div>
@endsection
