@extends('layouts.admin.a_master')
@section('title', '')
@section('description', 'plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', '')

@section('content')

@if($fellows->count() > 0)
<div class="row">
	<div class="col-sm-12">
		<h1>Lista de usuarios con evaluación</h1>
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
			    @foreach ($fellows as $fellow)
			      <tr>
			        <td><h4> <a href="{{ url('dashboard/evaluacion/actividad/archivo/ver/' . $fellow->id) }}">{{$fellow->user->name .' '.$fellow->user->fellowData->surname." ".$fellow->user->fellowData->lastname}}</a></h4>
			        {{$fellow->user->email}}</td>
			        <td>{{$fellow->user->fellowData->city}} <br> {{$fellow->user->fellowData->state}}</td>
			        <td>{{$fellow->user->fellowData->origin}}</td>
			        <td><a title="{{date('d-m-Y H:i', strtotime($fellow->created_at))}}">{{$fellow->created_at->diffForHumans()}}</a> </td>
							<td>{{$fellow->user->FellowScoreActivity($fellow->user->id,$activity->quizInfo->id) ? number_format($fellow->user->FellowScoreActivity($fellow->user->id,$activity->quizInfo->id)->score,2)  : 'Sin evaluar'}}</td>
			        <td>
			          <a href ="{{ url('dashboard/evaluacion/actividad/resultados/ver/' . $fellow->id) }}"   class="btn xs view ev">Ver</a></td>
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
		<h1>Lista de usuarios con evaluación</h1>
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
