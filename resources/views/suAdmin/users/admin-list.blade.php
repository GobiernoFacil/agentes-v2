@extends('layouts.admin.a_master')
@section('title', 'Lista de usuarios')
@section('description', 'Lista de usuarios de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'users')
@section('breadcrumb_type', 'users list')
@section('breadcrumb', 'layouts.suAdmin.breadcrumbs.b_users')
@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Lista de usuarios</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
			  <thead>
			    <tr>
			      <th>Nombre</th>
			      <th>Email</th>
			      <th>Institución</th>
			      <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			    @foreach ($admins as $admin)
			      <tr>
			        <td><h4>{{$admin->name}}</h4></td>
			        <td>{{$admin->email}}</td>
			        <td></td>
			        <td>
			          <a href="{{ url('sa/dashboard/administradores/ver/' . $admin->id) }}" class="btn xs view">Ver</a>
			          <a href ="{{ url('sa/dashboard/administradores/eliminar' . $admin->id) }}"  id ="{{$admin->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>
			    </tr>
			    @endforeach
			  </tbody>
			</table>
			
			{{ $admins->links() }}
		</div>
	</div>
</div>
@endsection