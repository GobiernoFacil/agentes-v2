@extends('layouts.admin.a_master')
@section('title', '')
@section('description', 'plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', '')

@section('content')

@if($answers->count() > 0)
<div class="row">
	<div class="col-sm-9">
		<h1>Lista de usuarios con resultados de evaluación diagnóstico</h1>
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
			    @foreach ($answers as $answer)
			      <tr>
			        <td><h4> <a href="{{ url('tablero-facilitador/evaluacion/diagnostico/ver/' . $answer->id) }}">{{$answer->user->name}}</a></h4></td>
			        <td>{{$answer->user->email}}</td>
			        <td>{{$answer->user->fellowData->origin}}</td>
			        <td>
			          <a href="{{ url('tablero-facilitador/evaluacion/diagnostico/ver/' . $answer->id) }}" class="btn xs view">Ver</a>
			         <!-- <a href ="{{ url('tablero-facilitador/facilitadores/eliminar/' . $answer->id) }}"  id ="{{$answer->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>-->
			    </tr>
			    @endforeach
			  </tbody>
			</table>

			{{ $answers->links() }}
		</div>
	</div>
</div>
@else
<div class="row">
	<div class="col-sm-9">
		<h1>Lista de usuarios con resultados de evaluación diagnóstico</h1>
	</div>
</div>
<div class="box">
	<div class="row center">
		<div class="col-sm-10 col-sm-offset-1">
		<h2>Sin usuarios con evaluación</h2>
		</div>
	</div>
</div>
@endif
@endsection
