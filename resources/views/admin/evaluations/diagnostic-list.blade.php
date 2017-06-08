@extends('layouts.admin.a_master')
@section('title', 'Lista de fellows que respondieron el examen diagnóstico')
@section('description', 'plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'diagnostic')
@section('breadcrumb_type', 'diagnostic list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_diagnostic')

@section('content')

@if($answers->count() > 0)
<div class="row">
	<div class="col-sm-12">
		<h1>Lista de fellows que respondieron el examen diagnóstico</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
			  <thead>
			    <tr>
			      <th>Nombre / Email</th>
			      <th>Ciudad / Estado</th>
			      <th>Procedencia</th>
				  <th>Fecha de examen</th>
				  <th>Evaluación</th>
			      <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			    @foreach ($answers as $answer)
			      <tr>
			        <td><h4> <a href="{{ url('dashboard/evaluacion/diagnostico/ver/' . $answer->id) }}">{{$answer->user->name}}</a></h4>
			        {{$answer->user->email}}</td>
			        <td>{{$answer->user->fellowData->city}} <br> {{$answer->user->fellowData->state}}</td>
			        <td>{{$answer->user->fellowData->origin}}</td>
			        <td><a title="{{date('d-m-Y H:i', strtotime($answer->created_at))}}">{{$answer->created_at->diffForHumans()}}</a> </td>
							@if($answer->user->diagnosticEvaluation)
							<td>{{$answer->user->diagnosticEvaluation->total_score}}</td>
							@else
							<td>Sin evaluar</td>
							@endif
			        <td>
			          <a href="{{ url('dashboard/evaluacion/diagnostico/ver/' . $answer->id) }}" class="btn xs view">Ver</a>
			          <a href ="{{ url('dashboard/evaluacion/diagnostico/evaluar/1/' . $answer->id) }}"   class="btn xs view ev">Evaluar</a></td>
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
