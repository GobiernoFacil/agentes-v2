@extends('layouts.admin.a_master')
@section('title', 'Lista de Actividades')
@section('description', 'Lista de actividades asignadas a ti')
@section('body_class', 'actividades')
@section('breadcrumb_type', 'activities list')
@section('breadcrumb', 'layouts.facilitator.breadcrumb.b_activity')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Actividades</h1>
		<div class="box center">
			<h2>Aún no te han asignado actividades</h2>
		</div>
	</div>
</div>
@endsection