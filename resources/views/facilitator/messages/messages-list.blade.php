@extends('layouts.admin.a_master')
@section('title', 'Lista de Mensajes')
@section('description', 'Lista de mensajes')
@section('body_class', 'mensajes')
@section('breadcrumb_type', 'messages list')
@section('breadcrumb', 'layouts.facilitator.breadcrumb.b_messages')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Mensajes</h1>
		<div class="box center">
			<h2>Aún no has recibido mensajes.</h2>
			
			<p><a class="btn add">Enviar mensaje</a></p>
		</div>
	</div>
</div>
@endsection