@extends('layouts.admin.a_master')
@section('title', '' )
@section('description','' )
@section('body_class', '')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Foros de la sesión: {{$session->name}}</h1>
	</div>
  <div class="col-sm-3 center">
		<a href='{{ url("tablero/foros/{$session->module->slug}/{$session->slug}/crear") }}' class="btn gde"><strong>+</strong> Crear Foro</a>
	</div>
</div>

@endsection
