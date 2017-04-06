@extends('layouts.admin.a_master')
@section('title', 'Ver requerimiento')
@section('description', 'Ver requerimientos')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Información de recurso y requerimiento técnico</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-6">
			<ul class="profile list">
				<li><span>Nombre:</span> <h2>{{$activityR->name}}</h2></li>
				<li><span>Número de requerimiento:</span> {{$activityR->order}}</li>
				<li><span>Descripción:</span>{{$activityR->description}}</li>
        <li><span>URL de recurso o material:</span>{{$activityR->material_link ? $activityR->material_link : 'Sin información'}}</li>
			</ul>
		</div>
	</div>
</div>
@endsection
