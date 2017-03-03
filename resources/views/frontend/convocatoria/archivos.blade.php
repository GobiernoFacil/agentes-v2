@extends('layouts.frontend.master')
@section('title', 'Aplica a la Convocatoria Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Aplica a la Convocatoria Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'convocatoria aplicar paso2')
@section('canonical', url('convocatoria/aplicar') )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_convocatoria')

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>Se ha validada tu dirección de correo</h1>
		<h2>Paso 2 de 2</h2>
		<p>Todos los campos son obligatorios</p>
		@if(Session::has('success'))
		  <div class="col-sm-12 message success">
		      {{ Session::get('success') }}
		  </div>
		@endif
	</div>
	<div class="col-sm-8 col-sm-offset-2">	
		@include('frontend.convocatoria.forms.files')
	</div>
</div>
@endsection
