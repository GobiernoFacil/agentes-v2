@extends('layouts.admin.a_master')
@section('title', $activity->name)
@section('description', 'Plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'evaluacion')
@section('breadcrumb_type', 'evaluation diagnostic view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_evaluation')

@section('content')
@if($fellows->count() > 0)
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
			<h3 class="title center">Lista de usuarios con evaluación diagnóstico</h3>
			<div class="divider b"></div>
			<table class="table">
			  <thead>
			    <tr>
			      <th>Nombre / Email</th>
			      <th>Ciudad / Estado</th>
			      <th>Procedencia</th>
						<th>Fecha de examen</th>
			      <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>

			    @foreach ($fellows as $fellow)

				      <tr>
				        <td><h4> <a href='{{url("dashboard/programas/$program->id/ver-diagnostico/$activity->id/resultados/{$fellow->user->id}")}}'>{{$fellow->user->name}}</a></h4>
				        {{$fellow->user->email}}</td>
				        <td>{{$fellow->user->fellowData->city}} <br> {{$fellow->user->fellowData->state}}</td>
				        <td>{{$fellow->user->fellowData->origin}}</td>
								<td><a title="{{date('d-m-Y H:i', strtotime($fellow->user->new_diagnostic($activity->diagnostic_info->id)->first()->created_at))}}">{{$fellow->user->new_diagnostic($activity->diagnostic_info->id)->first()->created_at->diffForHumans()}}</a> </td>
							  <td>
				          <a href ='{{url("dashboard/programas/$program->id/ver-diagnostico/$activity->id/resultados/{$fellow->user->id}")}}'   class="btn xs view ev">Ver</a>
								</td>
				    </tr>
			    @endforeach
			  </tbody>
			</table>
				{{$fellows->links()}}
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
			<h3 class="title center">Lista de usuarios con evaluación diagnóstico</h3>
			<div class="divider b"></div>
			<h2>Sin usuarios con evaluación</h2>
		</div>
	</div>
</div>
@endif
@endsection
