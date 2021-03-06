@extends('layouts.admin.a_master')
@section('title', 'Calificaciones')
@section('description', 'Calificaciones')
@section('body_class', '')
@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Ver calificación {{$score->activity->title}}</h1>
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
				<ul class="list">
					<li class="row">
						<span class="col-sm-9">
						<h3>Comentarios</h3>
						<p>{{$score->comments}}</p>
						</span>
						<span class="col-sm-3 right">
						</span>
					</li>

          <li class="row">
						<span class="col-sm-9">
						<h3>Url</h3>
						<p>{{$score->url}}</p>
						</span>
						<span class="col-sm-3 right">
						</span>
					</li>
          @if($score->path)
          <li class="row">
						<span class="col-sm-9">
						<h3>Descargar archivo corregido</h3>
						<a href="{{ url('dashboard/evaluacion/actividad/archivo-corregido/get/' . $score->id) }}" class="btn xs view">Descargar</a>
						</span>
						<span class="col-sm-3 right">
						</span>
					</li>
          @endif
        </ul>
		    </div>
  </div>
</div>
@endsection
