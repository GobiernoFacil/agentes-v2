@extends('layouts.admin.a_master')
@section('title', $activity->name)
@section('description', 'plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'evaluation')
@section('breadcrumb_type', 'evaluation activity view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_evaluation')

@section('content')
@if($fellows->count() > 0)
<div class="row">
	<div class="col-sm-12">
		<h1>{{$activity->name}}</h1>
		<h2>Módulo: {{$activity->session->module->title}}</h2>
		<h3>Sesión: {{$activity->session->name}}</h3>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="title center">Lista de usuarios con archivos para evaluar</h3>
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
			    @foreach ($fellows as $fellow)
			      <tr>
			        <td><h4> <a href="{{ url('dashboard/evaluacion/actividad/archivo/ver/' . $fellow->id) }}">{{$fellow->user->name .' '.$fellow->user->fellowData->surname." ".$fellow->user->fellowData->lastname}}</a></h4>
			        {{$fellow->user->email}}</td>
			        <td>{{$fellow->user->fellowData->city}} <br> {{$fellow->user->fellowData->state}}</td>
			        <td>{{$fellow->user->fellowData->origin}}</td>
			        <td><a title="{{date('d-m-Y H:i', strtotime($fellow->created_at))}}">{{$fellow->created_at->diffForHumans()}}</a> </td>
							<td>{{$fellow->user->fileFellowScore($fellow->user->id,$activity->id) ? $fellow->user->fileFellowScore($fellow->user->id,$activity->id)->score : 'Sin evaluar'}}</td>
			        <td>
			          <a href="{{ url('dashboard/evaluacion/actividad/archivo/get/' . $fellow->id) }}" class="btn xs view">Descargar</a>
			          <a href ="{{ url('dashboard/evaluacion/actividad/archivo/evaluar/' . $fellow->id) }}"   class="btn xs view ev">Evaluar</a></td>
			    </tr>
			    @endforeach
			  </tbody>
			</table>

			{{ $fellows->links() }}
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
			<h3 class="title center">Lista de usuarios con archivos para evaluar</h3>
			<div class="divider b"></div>
			<h2>Sin usuarios con archivos</h2>
		</div>
	</div>
</div>
@endif
@endsection
