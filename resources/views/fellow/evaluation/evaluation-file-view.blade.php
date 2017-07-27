@extends('layouts.admin.a_master')
@section('title', 'Calificaciones')
@section('description', 'Calificaciones')
@section('body_class', 'fellow')
@section('content')

@if(!empty($score))
<div class="row">
  <div class="col-sm-12">
    <h1>Ver calificación {{$score->activity->title}}</h1>
  </div>
</div>

<div class="box">
  <div class="row">
	   		<div class="col-sm-3 col-sm-offset-9 right">
				<h3>Puntaje total: </h3>
				<h2>{{$score->score > 0 ? number_format($score->score,2) . '/10' : '0/0'  }}</h2>
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
						<a href="{{ url('tablero/calificaciones/archivo/get/' . $score->id) }}" class="btn xs view">Descargar</a>
						</span>
						<span class="col-sm-3 right">
						</span>
					</li>
          @endif
        </ul>
		    </div>
  </div>
</div>
@else
<div class="row">
	<div class="col-sm-12">
    	<h1>Tu ensayo aún no has sido evaluado por el equipo de Prosociedad.</h1>
  </div>
</div>

@endif
@endsection
