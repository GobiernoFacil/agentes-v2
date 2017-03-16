@extends('layouts.admin.a_master')
@section('title', 'Ver super administrador')
@section('description', 'Ver super administrador a la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'suAdmin')
@section('breadcrumb_type', 'users sua view')
@section('breadcrumb', 'layouts.suAdmin.breadcrumbs.b_suAdmins')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Ver super administrador</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-5 col-sm-offset-1">
			<ul class="profile list">
				<li><h2>{{$suAdmin->name}}</h2></li>
				<li><span>email</span>{{$suAdmin->email}}</li>
				<li><span>Asociación</span> {{$suAdmin->institution}} Gobierno Fácil</li>
				<li><span>Tipo de usuario</span>{{$suAdmin->type == "admin" ? "Administrador" : 'Super Administrador'}}</li>
				<li><span>Fecha de creación</span>{{ date("d-m-Y, H:i", strtotime($suAdmin->created_at)) }} hrs.</li>
				<li><span>Última actualización</span>{{ date("d-m-Y, H:i", strtotime($suAdmin->updated_at)) }} hrs.</li>
			</ul>
		</div>
		<div class="col-sm-5">
			<ul class="profile list">
				<li class="right">
				<a href="{{ url('sa/dashboard/super-administradores/editar/' . $suAdmin->id ) }}" class="btn xs view">Editar Usuario</a></li>
			</ul>
		</div>

	</div>
</div>
@endsection