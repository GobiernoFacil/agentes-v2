@extends('layouts.admin.a_master')
@section('title', 'Encuestas en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Encuestas en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'fellow')

@section('content')
@if($sessions->count() > 0)
<div class="box">
	<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
			<h3 class="title center">Lista de sesiones</h3>
			<div class="divider b"></div>
		</div>
    <div class="col-sm-12">
  		<div class="divider b"></div>
  	</div>
  	<div class="col-sm-9">
  		<h3 class="title">Módulo: {{$module->title}}</h3>
  	</div>
		<div class="col-sm-12">
			<table class="table">
			  <thead>
			    <tr>
			      <th>Nombre</th>
			      <th>Descripción</th>
			      <th>Fecha</th>
            <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
        @foreach($sessions as $session)
			    <tr>
            <td><h4><a href='{{url("tablero/encuestas/facilitadores-sesiones/{$session->slug}")}}'>{{$session->name}}</a></h4></td>
            <td>{{$session->objective}}</td>
            <td> {{$session->created_at->diffForHumans()}}</td>
            <td>
              <a href='{{url("tablero/encuestas/facilitadores-sesiones/{$session->slug}")}}' class="btn xs view">Seleccionar</a>
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
	<div class="row center">
		<div class="col-sm-10 col-sm-offset-1">
			<h3 class="title center">Lista de sesiones</h3>
			<div class="divider b"></div>
		</div>
		<div class="col-sm-3 col-sm-offset-4 center">
			<p>Sin sesiones</p>
		</div>
	</div>
</div>
@endif
@endsection
