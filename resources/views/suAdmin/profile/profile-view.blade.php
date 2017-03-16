@extends('layouts.admin.a_master')
@section('title', 'Perfil de ' . $user->name)
@section('description', 'Perfil de ' . $user->name)
@section('body_class', 'profile')
@section('breadcrumb_type', 'profile')
@section('breadcrumb', 'layouts.suAdmin.breadcrumbs.b_profile')
@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Tu perfil</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-6">
			<ul class="profile list">
				<li><h3>{{$user->name}}</h3></li>
				<li><span>email</span>{{$user->email}}</li>
				<li><span>Asociación</span> {{$user->institution}}</li>
				<li><span>Tipo de usuario</span>{{$user->type == "admin" ? "Administrador" : ''}}</li>
				<li><span>Fecha de creación</span>{{ date("d-m-Y, H:i", strtotime($user->created_at)) }} hrs.</li>
				<li><span>Última actualización</span>{{ date("d-m-Y, H:i", strtotime($user->updated_at)) }} hrs.</li>
			</ul>
		</div>
		<div class="col-sm-5">
			<ul class="profile list">
				<li class="right">
				<a href="{{ url('sa/dashboard/perfil/editar' ) }}" class="btn xs view">Editar Perfil</a></li>
			</ul>
		</div>
	</div>
</div>
@endsection