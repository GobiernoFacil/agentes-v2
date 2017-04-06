@extends('layouts.admin.a_master')
@section('title', 'Ver temática')
@section('description', 'Ver temática')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Información de temática</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-6">
			<ul class="profile list">
				<li><span>Nombre:</span> <h2>{{$topic->name}}</h2></li>
				<li><span>Número de temática:</span> {{$topic->order}}</li>
				<li><span>Conocimientos:</span>{{$topic->knowledge ? $topic->knowledge : "Sin información" }}</li>
        <li><span>Valores:</span>{{$topic->values ? $topic->values : "Sin información" }}</li>
        <li><span>Habilidades:</span>{{$topic->abilities ? $topic->abilities : "Sin información" }}</li>
        <li><span>Productos:</span>{{$topic->products ? $topic->products : "Sin información" }}</li>
			</ul>
		</div>
	</div>
</div>
@endsection
