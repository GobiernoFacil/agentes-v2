@extends('layouts.admin.a_master')
@section('title', 'Foros del programa '.$program->title )
@section('description','Foros del Programa de Gobierno Abierto desde lo local' )
@section('body_class', 'foros')
@section('breadcrumb_type', 'forums list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_forums')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Foros del programa "{{$program->title}}"</h1>
		@if(isset($module))
		<h2>Módulo "{{$module->title}}"</h2>
		@endif
	</div>
	<div class="col-sm-3">
		<p class="right"><a href='{{ url("dashboard/foros/programa/$program->id/agregar") }}' class="btn ev">[+] Agregar foro</a></p>
	</div>
</div>

@include('layouts.forums.all-list')

@endsection
