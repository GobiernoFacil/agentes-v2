@extends('layouts.admin.a_master')
@section('title', 'Perfil')
@section('description', 'Ver perfil')
@section('body_class', 'profile fellow')
@section('breadcrumb_type', 'profile view')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Tu Perfil</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<ul class="profile list">
				<li class="right">
				<a href="{{ url('tablero/perfil/editar') }}" class="btn xs view">Editar tu perfil</a></li>
			</ul>
		</div>
		<div class="col-sm-10 col-sm-offset-1 center">
			<p class="">
				@if($user->image)
				<img src='{{url("img/users/{$user->image->name}")}}' height="150px">
				@else
				<img src='{{url("img/users/default.png")}}' height="150px">
				@endif
			</p>
			<h2>{{$user->name}} {{$user->fellowData->surname}} {{$user->fellowData->lastname}}</h2>
			<h3>Procedencia: {{$user->fellowData->origin}} </h3>
			<p>{{$user->fellowData->city}}, {{$user->fellowData->state}}</p>
			<div class="divider"></div>
			<ul class="profile list row">
				<li class="col-sm-4"><span>Grado de estudios</span>{{$user->fellowData->degree}}</li>
				<li class="col-sm-4"><span>email</span>{{$user->email}}</li>
				<li class="col-sm-4"><span>Sitio Web</span>{{$user->fellowData->web ? $user->fellowData->web : "Sin información" }}</li>

			</ul>
			<p>
			@if($user->fellowData->twitter)
			<a href="{{$user->fellowData->twitter}}" class="facilitador_i tw"></a>
			@endif
			@if($user->fellowData->facebook)
			<a href="{{$user->fellowData->facebook}}" class="facilitador_i fb"></a>
			@endif
			@if($user->fellowData->linkedin)
			<a href="{{$user->fellowData->linkedin}}" class="facilitador_i lk"></a>
			@endif
			@if($user->fellowData->other)
			{{$user->fellowData->other}}
			@endif
			</p>

			<h3>Semblanza</h3>
			<p>{{$user->fellowData->semblance ? $user->fellowData->semblance : "Sin información" }}</p>
			<div class="divider"></div>
			<h3>Archivos</h3>
			<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<a href="{{ url('tablero/perfil/archivos') }}" class="btn gde view">Ver ({{$user->fellowFiles->count()}})</a>
			</div>
			</div>
			<div class="divider"></div>
		</div>

	</div>
</div>
@endsection
