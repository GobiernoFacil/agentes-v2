@extends('layouts.admin.a_master')
@section('title', 'Foros' )
@section('description','Foros del Programa de Gobierno Abierto desde lo local' )
@section('body_class', 'foros')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Foros</h1>
	</div>
	<div class="col-sm-3">
		<p class="right"><a href="{{ url('dashboard/foros/agregar') }}" class="btn ev">[+] Agregar foro</a></p>
	</div>
</div>

@include('layouts.forums.all-list')

@endsection