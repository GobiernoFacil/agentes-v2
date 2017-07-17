@extends('layouts.admin.a_master')
@section('title', 'Lista de actividades que cuentan con evaluación')
@section('description', 'Plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'evaluation')
@section('breadcrumb_type', 'evaluation list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_evaluation')

@section('content')
@if($activities->count() > 0)
<div class="row">
	<div class="col-sm-12">
		<h1>Lista de actividades con evaluación</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
			  <thead>
			    <tr>
			      <th>Nombre</th>
			      <th>Sesión</th>
			      <th>Fecha límite</th>
			      <th>Tipo</th>
			      <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			    @foreach ($activities as $activity)
			      <tr>
					<td>
						<h4>
						@if($activity->files=='Sí')
						<a href="{{ url('dashboard/evaluacion/actividad/ver/' . $activity->id) }}">{{$activity->name}}</a>
						@else
							@if($activity->quizInfo)
							<a href="{{ url('dashboard/evaluacion/actividad/ver/' . $activity->id) }}">{{$activity->name}}</a>
							@else
							 {{$activity->name}}
							@endif
						@endif
						</h4>	
						<strong>Módulo:</strong> {{$activity->session->module->title}}				
					</td>
			        <td>{{$activity->session->name}}</td>
			        <td><strong>{{!empty($activity->end) ? \Carbon\Carbon::createFromTimeStamp(strtotime($activity->end))->diffForHumans() : 'Sin fecha'}}</strong><br>
	            				{{ !empty($activity->end) ? date("j/m/Y", strtotime($activity->end)) : 'Sin fecha'}}</td>
			        <td>{{$activity->files== 'Sí' ? 'Archivo' : 'Examen'}}</td>
			        <td>
						@if($activity->files=='Sí')
							<a href="{{ url('dashboard/evaluacion/actividad/ver/' . $activity->id) }}" class="btn xs view">Ver</a>
						@else
							@if($activity->quizInfo)
								<a href="{{ url('dashboard/evaluacion/actividad/ver/' . $activity->id) }}" class="btn xs view">Ver</a>
							@else
							 Sin examen
							@endif
						@endif
					</td>
			    </tr>
			    @endforeach
			  </tbody>
			</table>

			{{ $activities->links() }}
		</div>
	</div>
</div>
@else
<div class="row">
	<div class="col-sm-9">
		<h1>Lista de actividades con evaluación</h1>
	</div>
</div>
<div class="box">
	<div class="row center">
		<div class="col-sm-10 col-sm-offset-1">
		<h2>Sin actividades</h2>
		</div>
	</div>
</div>
@endif
@endsection
