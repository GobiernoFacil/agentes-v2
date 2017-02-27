@extends('layouts.frontend.master')
@section('title', 'Aplica a la Convocatoria Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Aplica a la Convocatoria Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'convocatoria')
@section('canonical', url('convocatoria/aplicar') )

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1><strong>Aplica</strong> a la Convocatoria Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</h1>
		@if(Session::has('success'))
		<div class="message success">
	      {{ Session::get('success') }}
	  	</div>
	  	@endif
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		<p>Todos los campos son obligatorios.</p>
		@include('frontend.convocatoria.forms.register')
	</div>
</div>
@endsection
