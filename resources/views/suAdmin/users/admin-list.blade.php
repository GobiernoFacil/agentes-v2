@extends('layouts.admin.a_master')
@section('title', 'Lista de usuarios')
@section('description', 'Lista de usuarios de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'users')
@section('breadcrumb_type', 'users list')
@section('breadcrumb', 'layouts.suAdmin.breadcrumbs.b_users')
@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Lista de usuarios administradores</h1>
	</div>
	<div class="col-sm-3 center">
		<a href="{{ url('sa/dashboard/administradores/agregar') }}" class="btn gde"><strong>+</strong> Agregar usuario</a>
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
						<th>Estado</th>
			      <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			    @foreach ($admins as $admin)
			      <tr>
			        <td><h4> <a href="{{ url('sa/dashboard/administradores/ver/' . $admin->id) }}">{{$admin->name}}</a></h4></td>
			        <td>{{$admin->email}}</td>
			        <td>{{$admin->institution}}</td>
							<td>{{$admin->enabled ? 'Activo' : 'Deshabilitado'}}</td>
			        <td>
			          <a href="{{ url('sa/dashboard/administradores/ver/' . $admin->id) }}" class="btn xs view">Ver</a>
			          <a href="{{ url('sa/dashboard/administradores/editar/' . $admin->id) }}" class="btn xs ev">Editar</a>
			          <a href ="{{ url('sa/dashboard/administradores/deshabilitar/' . $admin->id) }}"  id ="{{$admin->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>
			    </tr>
			    @endforeach
			  </tbody>
			</table>

			{{ $admins->links() }}
		</div>
	</div>
</div>
@endsection
