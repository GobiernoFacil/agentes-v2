@extends('layouts.admin.a_master')
@section('title', 'Ver mecanismo de monitoreo y evaluación')
@section('description', 'Ver mecanismo de monitoreo y evaluación')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Información de mecanismo de monitoreo y evaluación</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-6">
			<ul class="profile list">
				<li><span>Conocimiento:</span> <h2>{{$monitoring->knowledge}}</h2></li>
				<li><span>Competencia:</span> {{$monitoring->competitions}}</li>
				<li><span>Actitud:</span>{{$monitoring->attitude}}</li>
        <li><span>Rol del mentor:</span>{{$monitoring->role ? $monitoring->role : 'Sin información'}}</li>
			</ul>
		</div>
	</div>
</div>
@endsection
