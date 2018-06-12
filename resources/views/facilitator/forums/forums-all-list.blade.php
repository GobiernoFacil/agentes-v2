@extends('layouts.admin.a_master')
@section('title', 'Foros' )
@section('description','Foros del Programa de Gobierno Abierto desde lo local' )
@section('body_class', 'foros')
@section('breadcrumb_type', 'forums list')
@section('breadcrumb', 'layouts.facilitator.breadcrumb.b_forums')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Foros del programa "{{$program->title}}"</h1>
	</div>
</div>

@include('layouts.forums.all-list')

@endsection
