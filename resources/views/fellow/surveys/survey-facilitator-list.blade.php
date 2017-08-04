@extends('layouts.admin.a_master')
@section('title', 'Encuestas en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Encuestas en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'fellow')

@section('content')

<div class="row">
	<div class="col-sm-9">
		<h1>Lista de Facilitadores </h1>
	</div>
  <div class="col-sm-12">
    <div class="divider b"></div>
  </div>
  <div class="col-sm-9">
    <h3 class="title">Módulo: {{$session->module->title}}</h3>
  </div>
  <div class="col-sm-9">
    <h3 class="title">Sesión: {{$session->name}}</h3>
  </div>
</div>

@if($facilitators->count() > 0)
<div class="row" id ="aspirants">
	<div class="col-sm-12">
		<div class="box">
		<table class="table">
		  <thead>
		    <tr>
		      <th>Nombre / email</th>
		      <th>Acciones</th>
		    </tr>
		  </thead>
		  <tbody>
		    @foreach ($facilitators as $facilitator)
		      <tr>
		        <td><div class="row">
			        <div class="col-sm-2">
				    @if($facilitator->user->image)
						<img src='{{url("img/users/{$facilitator->image->name}")}}' height="30px">
						@else
						<img src='{{url("img/users/default.png")}}' height="30px">
						@endif
			        </div>
			        <div class="col-sm-10">
			        <h4><a href='{{ url("tablero/encuestas/facilitadores-sesiones/{$session->slug}/{$facilitator->user->name}")}}'>{{$facilitator->user->name}}</a></h4>
					{{$facilitator->user->email}}<br>
			        </div>
		       	 </div>
		        </td>

		        <td>
		          <a href='{{ url("tablero/encuestas/facilitadores-sesiones/{$session->slug}/{$facilitator->user->name}")}}' class="btn xs view">Ver perfil</a>
		         </td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>

		</div>
	</div>
</div>
@else
<div class="box">
	<div class="row">
		<div class="col-sm-12 center">
			<h2>No hay facilitadores.</h2>
		</div>
	</div>
</div>
@endif

@endsection
