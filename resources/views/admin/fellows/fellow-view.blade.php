@extends('layouts.admin.a_master')
@section('title', 'Lista de Aspirantes')
@section('description', 'Lista de Aspirantes')
@section('body_class', 'fellows')
@section('breadcrumb_type', 'fellow ver')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_fellows')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Perfil de Aspirante</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-6">
			<ul class="profile list">
				<li><span>Nombre:</span> 
				@if($user->image)
				<img src='{{url("img/users/{$user->image->name}")}}' height="50px">
				@else
				<img src='{{url("img/users/default.png")}}' height="50px">
				@endif<h2>{{$fellow->name." ".$fellow->surname." ".$fellow->lastname}}</h2></li>
				<li><span>Email:</span> {{$fellow->email}}</li>
				<li><span>Nivel de estudios:</span> {{$fellow->degree}}</li>
				<li><span>Procedencia:</span> {{$fellow->origin ? $fellow->origin : "Sin información"}}</li>
				<li><span>Ciudad:</span> {{$fellow->city}}</li>
				<li><span>Estado:</span> {{$fellow->state}}</li>
				<li><span>Fecha de creación</span>{{ date("d-m-Y, H:i", strtotime($fellow->created_at)) }} hrs.</li>
			</ul>
		</div>
	</div>
</div>

@endsection
