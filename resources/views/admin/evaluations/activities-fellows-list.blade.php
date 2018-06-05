@extends('layouts.admin.a_master')
@section('title', $activity->name)
@section('description', 'plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'evaluacion')
@section('breadcrumb_type', 'evaluation activity view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_evaluation')

@section('content')
@if($scores->count() > 0)
<div class="row">
	<div class="col-sm-12">
		<h1>{{$activity->name}}</h1>
		<h2>{{$program->title}}</h2>
		<h3>Módulo: {{$activity->session->module->title}}</h3>
		<h4>Sesión: {{$activity->session->name}}</h4>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="title center">Lista de usuarios con evaluación</h3>
			<div class="divider b"></div>
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
			    @foreach ($scores as $score)
			      <tr>
			        <td><h4> <a href='{{url("dashboard/programas/$program->id/ver-evaluacion/$activity->id/resultados/$score->id")}}'>{{$score->user->name .' '.$score->user->fellowData->surname." ".$score->user->fellowData->lastname}}</a></h4>
			        {{$score->user->email}}</td>
			        <td>{{$score->user->fellowData->city}} <br> {{$score->user->fellowData->state}}</td>
			        <td>{{$score->user->fellowData->origin}}</td>
			        <td><a title="{{date('d-m-Y H:i', strtotime($score->created_at))}}">{{$score->created_at->diffForHumans()}}</a> </td>
							<td>{{$score->user->FellowScoreActivity($score->user->id,$activity->quizInfo->id) ? number_format($score->user->FellowScoreActivity($score->user->id,$activity->quizInfo->id)->score,2)*10  : 'Sin evaluar'}}</td>
			        <td>
			          <a href ='{{url("dashboard/programas/$program->id/ver-evaluacion/$activity->id/resultados/$score->id")}}'   class="btn xs view ev">Ver</a></td>
			    </tr>
			    @endforeach
			  </tbody>
			</table>

			{{ $scores->links() }}
		</div>
	</div>
</div>
@else
<div class="row">
	<div class="col-sm-9">
		<h1>{{$activity->name}}</h1>
		<h2>Módulo: {{$activity->session->module->title}}</h2>
		<h3>Sesión: {{$activity->session->name}}</h3>
	</div>
</div>
<div class="box">
	<div class="row center">
		<div class="col-sm-10 col-sm-offset-1">
			<h3 class="title center">Lista de usuarios con evaluación</h3>
			<div class="divider b"></div>
			<h2>Sin usuarios con evaluación</h2>
		</div>
	</div>
</div>
@endif
@endsection
