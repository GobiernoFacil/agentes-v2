@extends('layouts.admin.a_master')
@section('title', 'Perfil')
@section('description', 'Ver perfil')
@section('body_class', 'profile')
@section('breadcrumb_type', 'profile view')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Mensajes Privados</h1>
	</div>
  <div class="col-sm-3 center">
		<a href="{{ url('tablero/mensajes/agregar') }}" class="btn gde"><strong>+</strong> Crear Mensaje</a>
	</div>
</div>

@if($conversations->count()>0)
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
			        <td><h4> <a href="{{ url('sa/dashboard/administradores/ver/' . $admin->id) }}">{{$admin->name}}</a></h4></td>
			        <td>{{$admin->email}}</td>
			        <td></td>
			        <td>
			          <a href="{{ url('sa/dashboard/administradores/ver/' . $admin->id) }}" class="btn xs view">Ver</a>
			          <a href="{{ url('sa/dashboard/administradores/editar/' . $admin->id) }}" class="btn xs ev">Editar</a>
			          <a href ="{{ url('sa/dashboard/administradores/eliminar' . $admin->id) }}"  id ="{{$admin->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>
			    </tr>
			    @endforeach
			  </tbody>
			</table>

			{{ $admins->links() }}
		</div>
	</div>
</div>
@else
<div class="row">
  <div class="col-sm-12">
    <p>Sin mensajes</p>
  </div>
</div>
@endif
@endsection
