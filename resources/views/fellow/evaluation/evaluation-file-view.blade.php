@extends('layouts.admin.a_master')
@section('title', 'Calificaciones')
@section('description', 'Calificaciones')
@section('body_class', 'fellow')
@section('breadcrumb_type', 'score file')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_score')


@section('content')

@if(!empty($score))
<div class="row">
  <div class="col-sm-12">
    <h1>Ver calificación de <strong>{{$score->activity->name}}</strong></h1>
    <h2>Módulo: {{$score->activity->session->module->title}}</h2>
    <h3>Sesión: {{$score->activity->session->name}}</h3>
  </div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-3 col-sm-offset-9 right">
			<h3>Puntaje total: </h3>
			<h2>{{$score->score > 0 ? number_format($score->score,2)*10 . '/100' : '0/0'  }}</h2>

		</div>
		<div class="col-sm-12">
			<div class="divider top"></div>
		</div>
		<div class="col-sm-10 col-sm-offset-1">
			<h3>Comentarios</h3>
			<p>{{$score->comments}}</p>
			<div class="divider b"></div>
			<h3>Url</h3>
			<p>{{$score->url ? $score->url : 'Sin enlace'}}</p>
			<div class="divider b"></div>
			@if($score->path)
			<h3>Descargar archivo corregido</h3>
			<a href='{{url("tablero/$program->slug/calificaciones/archivo/get/$score->id")}}' class="btn xs view">Descargar</a>
			@endif
		</div>
  </div>
</div>
@else
<div class="row">
	<div class="col-sm-12">
    	<h1>Tu ensayo aún no ha sido evaluado.</h1>
  </div>
</div>

@endif
@endsection
