@extends('layouts.frontend.master')
@section('title', 'Aplica a la Convocatoria Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Aplica a la Convocatoria Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'convocatoria finalizar')
@section('canonical', url('convocatoria/aplicar/fin') )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_convocatoria')

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1><strong>Gracias</strong>, tu registro ha terminado</h1>
		@if(Session::has('success'))
		<div class="message success">
	      {{ Session::get('success') }}
	  	</div>
	  	@endif
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		<p>Los candidatos seleccionados serán notificadas por vía electrónica y los resultados serán publicados en el sitio <a href="{{url('')}}">{{url('')}}</a>, a más tardar el 19 de mayo de 2017.</p>

	</div>
</div>
@endsection