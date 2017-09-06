@extends('layouts.admin.a_master')
@section('title', 'Lista de examen diagnóstico')
@section('description', 'Lista de examen diagnóstico')
@section('body_class', '')

@section('content')


<div class="row">
	<div class="col-sm-9">
		<h1>Lista de exámenes diagnóstico</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
			  <thead>
			    <tr>
			      <th>Nombre</th>
			      <th>Descripción</th>
			      <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
          @foreach($questionnaires as $questionnaire)
			      <tr>
			        <td><h4><a href = '{{url("tablero-facilitador/diagnostico/$questionnaire->id")}}'>{{$questionnaire->title}}</a></h4></td>
			        <td>{{$questionnaire->description}}</td>
			        <td>
								<a href='{{ url("tablero-facilitador/diagnostico/{$questionnaire->id}") }}' class="btn xs view">Ver</a>
			         <!-- <a href="{{ url('dashboard/indicadores/facilitadores/descargar') }}" class="btn xs view">Descargar</a>-->
              </td>
			    </tr>
          @endforeach
			  </tbody>
			</table>
		</div>
	</div>
</div>
@endsection
