@extends('layouts.admin.a_master')
@section('title', 'Encuestas en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Encuestas en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'fellow')

@section('content')
<div class="row">
	<div class="col-sm-12 ">
		<h1>Encuestas</h1>
	</div>
</div>

<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
			  <thead>
			    <tr>
			      <th>Encuesta</th>
			      <th>Descripción</th>
			      <th>Estatus</th>
            <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
            <td><h4><a href='{{url("tablero/encuestas/encuesta-satisfaccion")}}'>Encuesta de satisfacción</a></h4></td>
            <td>Encuesta de satisfacción Plataforma Apertus</td>
            <td>{{$user->fellow_survey ? 'Completada' : 'Sin contestar'}}</td>
            <td>
              @if($user->fellow_survey)
              Completada
              @else
              <a href="{{ url('tablero/encuestas/encuesta-satisfaccion') }}" class="btn xs view">Contestar</a>
              @endif
            </td>
				</tr>
			  </tbody>
			</table>
		</div>
	</div>
</div>
@endsection
