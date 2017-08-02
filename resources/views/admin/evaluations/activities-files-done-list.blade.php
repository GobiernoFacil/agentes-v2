@extends('layouts.admin.a_master')
@section('title', $activity->name)
@section('description', 'Plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'evaluation')
@section('breadcrumb_type', 'evaluation activity view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_evaluation')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>{{$activity->name}}</h1>
		<h2>Módulo: {{$activity->session->module->title}}</h2>
		<h3>Sesión: {{$activity->session->name}}</h3>
	</div>
	<div class="col-sm-3 right">
		<a href='{{ url("dashboard/evaluacion/actividad/archivo/agregar/{$activity->id}") }}' class="btn gde"><strong>+</strong> Agregar Calificación</a>
	</div>
</div>
@if($fellows->count() > 0)
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="title center">Lista de usuarios con archivos evaluados</h3>
			<table class="table">
			  <thead>
			    <tr>
			      	<th>Nombre / Email</th>
			      	<th>Ciudad / Estado</th>
					<th>Fecha de evaluación</th>
					<th>Evaluación</th>
			      <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			    @foreach ($fellows as $fellow)
			      <tr>
			        <td><h4> <a href="{{ url('dashboard/evaluacion/actividad/archivo/evaluar/' . $fellow->id) }}">{{$fellow->name .' '.$fellow->fellowData->surname." ".$fellow->fellowData->lastname}}</a></h4>
			        {{$fellow->email}}</td>
			        <td>{{$fellow->fellowData->city}} <br> {{$fellow->fellowData->state}}</td>
			        <td><a title="{{date('d-m-Y H:i', strtotime($fellow->fileFellowScore($fellow->id,$activity->id)->created_at))}}">{{$fellow->fileFellowScore($fellow->id,$activity->id)->created_at->diffForHumans()}}</a> </td>
							<td>{{$fellow->fileFellowScore($fellow->id,$activity->id) ? $fellow->fileFellowScore($fellow->id,$activity->id)->score : 'Sin evaluar'}}</td>
			        <td>
								@if($fellow->fileFellowScore($fellow->id,$activity->id)->path)
			          <a href="{{ url('dashboard/evaluacion/actividad/archivo/get/' . $fellow->id) }}" class="btn xs view">Descargar</a>
								@endif
								@if($fellow->FellowFileUp($fellow->id,$activity->id))
			          <a href ="{{ url('dashboard/evaluacion/actividad/archivo/evaluar/' . $fellow->FellowFileUp($fellow->id,$activity->id)->id) }}/0"   class="btn xs view ev">Evaluar</a></td>
								@else
								<a href ="{{ url('dashboard/evaluacion/actividad/archivo/evaluar/' . $fellow->fileFellowScore($fellow->id,$activity->id)->id) }}/1"   class="btn xs view ev">Evaluar</a></td>
								@endif
			    </tr>
			    @endforeach
			  </tbody>
			</table>

			{{ $fellows->links() }}
		</div>
	</div>
</div>
@else

<div class="box">
	<div class="row center">
		<div class="col-sm-10 col-sm-offset-1">
			<h3 class="title center">Lista de usuarios evaluados</h3>
			<div class="divider b"></div>
			<h2>Sin usuarios con archivos evaluados</h2>
		</div>
		<div class="col-sm-3 col-sm-offset-4 center">
			<a href='{{ url("dashboard/evaluacion/actividad/ver/{$activity->id}") }}' class="btn gde">Ver usuarios con archivos</a>
		</div>
	</div>
</div>
@endif
@endsection
