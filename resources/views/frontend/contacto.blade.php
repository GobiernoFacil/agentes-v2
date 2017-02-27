@extends('layouts.frontend.master')
@section('title', 'Contacta al equipo del Programa de fortalecimiento de capacidades para agentes de cambio de Gobierno Abierto')
@section('description', 'Equipo del Programa de fortalecimiento de capacidades para agentes de cambio de Gobierno Abierto')
@section('body_class', 'contacto')
@section('canonical', url('contacto'))

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<div class="box_contact">
			<span class="at">@</span>
			<h1>Contacto</h1>
			<p>En caso de tener algún comentario o duda, envía un correo electrónico a info@apertus.org.mx</p>
			<p>Consulta la<a href="{{url('politica-privacidad')}}"> política de privacidad</a></p>
		</div>
	</div>
</div>
@endsection