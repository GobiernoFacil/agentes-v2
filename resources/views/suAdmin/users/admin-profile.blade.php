@extends('layouts.admin.a_master')
@section('title', 'Ver usuario')
@section('description', 'Ver usuario de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'users')
@section('breadcrumb_type', 'users view')
@section('breadcrumb', 'layouts.suAdmin.breadcrumbs.b_users')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Ver Usuario</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-5 col-sm-offset-1">
			<ul class="profile list">
				<li><h2>{{$admin->name}}</h2></li>
				<li><span>email</span>{{$admin->email}}</li>
				<li><span>Asociación</span> {{$admin->institution}}</li>
				<li><span>Tipo de usuario</span>{{$admin->type == "admin" ? "Administrador" : ''}}</li>
				<li><span>Fecha de creación</span>{{ date("d-m-Y, H:i", strtotime($admin->created_at)) }} hrs.</li>
				<li><span>Última actualización</span>{{ date("d-m-Y, H:i", strtotime($admin->updated_at)) }} hrs.</li>
			</ul>
		</div>
		<div class="col-sm-5">
			<ul class="profile list">
				<li class="right">
				<a href="{{ url('sa/dashboard/administradores/editar/' . $admin->id ) }}" class="btn xs view">Editar Usuario</a></li>
			</ul>
		</div>
	</div>
</div>

@endsection
