@extends('layouts.admin.a_master')
@section('title', 'Lista de usuarios')
@section('description', 'Lista de usuarios de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'suAdmin')
@section('breadcrumb_type', 'users sua list')
@section('breadcrumb', 'layouts.suAdmin.breadcrumbs.b_suAdmins')

@section('content')
<div class="row">
	<div class="col-sm-8">
		<h1>Lista de super adminsitradores</h1>
	</div>
	<div class="col-sm-4 center">
		<a href="{{ url('sa/dashboard/super-administradores/agregar') }}" class="btn gde"><strong>+</strong> Agregar super administrador</a>
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
				  <tr>
					  <td><h3>{{$user->name}}</h3></td>
					  <td>{{$user->email}}</td>
					  <td>Gobierno Fácil</td>
					  <td>
			          <a href="{{ url('sa/dashboard/perfil') }}" class="btn xs view">Ver tu perfil</a>
			     </td>
				  </tr>
			    @foreach ($suAdmins as $user_a)
			      <tr>
			        <td><h3>{{$user_a->name}}</h3></td>
			        <td>{{$user_a->email}}</td>
			        <td>{{$user_a->institution}}</td>
			        <td>
			          <a href="{{ url('sa/dashboard/super-administradores/ver/' . $user_a->id) }}" class="btn xs view">Ver</a>
			          <a href="{{ url('sa/dashboard/super-administradores/editar/' . $user_a->id) }}" class="btn xs ev">Editar</a>
			          <a href ="{{ url('sa/dashboard/super-administradores/eliminar' . $user_a->id) }}"  id ="{{$user_a->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>
			    </tr>
			    @endforeach
			  </tbody>
			</table>
			
			{{ $suAdmins->links() }}
		</div>
	</div>
</div>
@endsection