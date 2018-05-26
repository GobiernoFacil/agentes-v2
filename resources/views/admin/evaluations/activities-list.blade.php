@extends('layouts.admin.a_master')
@section('title', 'Lista de actividades que cuentan con evaluación - '.$program->title)
@section('description', 'Plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'evaluation')
@section('breadcrumb_type', 'evaluation list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_evaluation')

@section('content')
@if($activities->count() > 0)
<div class="row">
	<div class="col-sm-12">
		<h1>Evaluaciones</h1>
		<h2>{{$program->title}}</h2>
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
							@if($activity->type==='evaluation' )
								<a href='{{ url("dashboard/programas/$program->id/ver-evaluacion/$activity->id") }}'>{{$activity->name}}</a>
							@elseif($activity->type==='diagnostic')
								<a href='{{ url("dashboard/programas/$program->id/ver-evaluacion/$activity->id") }}'>{{$activity->name}}</a>
							@else
								{{$activity->name}}
							@endif
						</h4>
						<strong>Módulo:</strong> {{$activity->session->module->title}}
					</td>
			        <td>{{$activity->session->name}}</td>
			        <td><strong>{{!empty($activity->end) ? \Carbon\Carbon::createFromTimeStamp(strtotime($activity->end))->diffForHumans() : 'Sin fecha'}}</strong><br>
	            				{{ !empty($activity->end) ? date("j/m/Y", strtotime($activity->end)) : 'Sin fecha'}}</td>
			        <td>{{$activity->files ? 'Archivo' : 'Examen'}}</td>
			        <td>
						@if($activity->files && $activity->type ==='evaluation')
							<a href='{{ url("dashboard/programas/$program->id/ver-evaluacion/$activity->id") }}' class="btn xs view">Ver</a>
					  @elseif($activity->files && $activity->type ==='diagnostic')
						  <a href='{{ url("dashboard/programas/$program->id/ver-diagnostico/$activity->id") }}' class="btn xs view">Ver</a>
						@else
								@if($activity->quizInfo)
									<a href='{{ url("dashboard/programas/$program->id/ver-evaluacion/$activity->id") }}' class="btn xs view">Ver</a>
								@elseif($activity->diagnostic_info)
									<a href='{{ url("dashboard/programas/$program->id/ver-diagnostico/$activity->id") }}' class="btn xs view">Ver</a>
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
		<h1>Evaluaciones</h1>
		<h2>{{$program->title}}</h2>
	</div>
</div>
<div class="box">
	<div class="row center">
		<div class="col-sm-10 col-sm-offset-1">
		<h2>Sin evaluaciones</h2>
		</div>
	</div>
</div>
@endif
@endsection
