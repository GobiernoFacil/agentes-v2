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
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
				<p>En caso de tener algún comentario o duda, envía un correo electrónico a Mariana García, coordinadora del proyecto en los teléfonos (55) 4000-9819, o al correo electrónico <a href="{{url('mailto:mariana.garcia@undp.org')}}">mariana.garcia@undp.org</a>.</p>
			<p>Consulta el <a href="{{url('aviso-privacidad')}}">aviso de privacidad</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection