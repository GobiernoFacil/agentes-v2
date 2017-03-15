@extends('layouts.admin.a_master')
@section('title', 'Perfil')
@section('description', 'Ver perfil')
@section('body_class', 'profile')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Tu Perfil</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-5 col-sm-offset-1">
			<ul class="profile list">
				<li><h2>{{$user->name}}</h2></li>
				<li><span>email</span>{{$user->email}}</li>
				<li><span>Asociación</span> Gobierno Fácil</li>
				<li><span>Tipo de usuario</span>{{$user->type == "admin" ? "Administrador" : ''}}</li>
				<li><span>Fecha de creación</span>{{ date("d-m-Y, H:i", strtotime($user->created_at)) }} hrs.</li>
				<li><span>Última actualización</span>{{ date("d-m-Y, H:i", strtotime($user->updated_at)) }} hrs.</li>
			</ul>
		</div>
		<div class="col-sm-5">
			<ul class="profile list">
				<li class="right">
				<a href="{{ url('dashboard/perfil/editar') }}" class="btn xs view">Editar Perfil</a></li>
			</ul>
		</div>
	</div>
</div>
@endsection