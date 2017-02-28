@extends('layouts.frontend.master')
@section('title', 'Aplica a la Convocatoria Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Aplica a la Convocatoria Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'convocatoria aplicar')
@section('canonical', url('convocatoria/aplicar') )
@section('breadcrumb', 'layouts.frontend.breadcrumb.convocatoria')

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
		<p>El plazo de aplicación se inicia el día <strong>1° de marzo y termina el 10 de abril de 2017 a las 15:00 horas</strong> (tiempo de la Ciudad de México). Para poder aplicar es necesario que radiques en alguna de las 5 entidades federativas participantes (<strong>Coahuila, Coahuila, Chihuahua, Morelos, Nuevo León y Oaxaca</strong>). Antes de aplicar, ten preparados los requisitos mencionados en las <a href="{{url('convocatoria')}}">bases de la convocatoria</a>:</p>
		<ol>
			<li>Ensayo (no mayor a cinco cuartillas).</li>
			<li>Video breve (enlace).</li>
			<li>Perfil curricular actualizado.</li>
			<li>Carta membretada o copia de identificación laboral.</li>
			<li>Copia de comprobante de domicilio.</li>
		</ol>		
		<h2>Paso 1 de 2</h2>
		<p>Todos los campos son obligatorios.</p>
		@include('frontend.convocatoria.forms.register')
	</div>
</div>
@endsection
