@extends('layouts.admin.a_master')
@section('title', $activity->name)
@section('description', 'Plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'evaluation')
@section('breadcrumb_type', 'evaluation activity view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_evaluation')

@section('content')
<div class="row">
	<div class="col-sm-8">
		<h1>{{$activity->name}}</h1>
		<h2>{{$program->title}}</h2>
	</div>
	<div class="col-sm-4 right">
		<a href='{{ url("dashboard/programas/$program->id/ver-evaluacion/$activity->id/archivos/agregar-evaluacion") }}' class="btn gde"><strong>+</strong> Agregar Calificación a Fellow</a>
	</div>
	<div class="col-sm-12">
		<div class="divider b"></div>
		<h3 class="title">Módulo: <strong>{{$activity->session->module->title}}</strong></h3>
		<h4>Sesión: {{$activity->session->name}}</h4>
	</div>
</div>
@if($files->count() > 0)
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="title center">Lista de usuarios con archivos evaluados</h2>
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
			    @foreach ($files as $file)
						@if($file->user->fileFellowScore($activity->id))
					      <tr>
					        <td><h4> <a href='{{url("dashboard/programas/$program->id/ver-evaluacion/$activity->id/archivos/agregar-evaluacion/$file->id")}}' >{{$file->user->name .' '.$file->user->fellowData->surname." ".$file->user->fellowData->lastname}}</a></h4>
					        {{$file->user->email}}</td>
					        <td>{{$file->user->fellowData->city}} <br> {{$file->user->fellowData->state}}</td>
					        <td><a title="{{date('d-m-Y H:i', strtotime($file->user->fileFellowScore($activity->id)->created_at))}}">{{$file->user->fileFellowScore($activity->id)->created_at->diffForHumans()}}</a> </td>
									<td>{{$file->user->fileFellowScore($activity->id) ? number_format($file->user->fileFellowScore($activity->id)->score,2)*10 : 'Sin evaluar'}}</td>
					        <td>
										<a href='{{url("dashboard/programas/$program->id/ver-evaluacion/$activity->id/archivos/get/$file->id")}}' class="btn xs view">Descargar</a>
	  			          <a href ='{{url("dashboard/programas/$program->id/ver-evaluacion/$activity->id/archivos/agregar-evaluacion/$file->id")}}'   class="btn xs view ev">Evaluar</a>
									</td>
					    	</tr>
							@endif
			    @endforeach
			  </tbody>
			</table>

			{{ $files->links() }}
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
