@extends('layouts.admin.a_master')
@section('title', 'Foros' )
@section('description','Foros del Programa de Gobierno Abierto desde lo local' )
@section('body_class', 'facilitator foros')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Preguntas del {{$forum->topic}}</h1>
	</div>
  <div class="col-sm-3 center">
		<a href='{{ url("tablero-facilitador/foros/pregunta/crear/$forum->id") }}' class="btn gde"><strong>+</strong> Agregar Pregunta</a>
	</div>
</div>


@if($forums->count()>0)
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
			  <thead>
			    <tr>
			      <th>Tema</th>
			      <th>Descripción</th>
			      <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			    @foreach ($forums as $conversation)
			      <tr>
			        <td><h4> <a href='{{ url("tablero-facilitador/foros/pregunta/ver/$forum->id") }}'>{{$conversation->topic}}</a></h4></td>
              <td>{{str_limit($conversation->description, $limit = 20, $end = '...')}}</td>
			        <td>
			          <a href='{{ url("tablero-facilitador/foros/pregunta/ver/$forum->id") }}' class="btn xs view">Ver</a>
					</tr>
			    @endforeach
			  </tbody>
			</table>

			{{ $forums->links() }}
		</div>
	</div>
</div>
@else
<div class="row">
  <div class="col-sm-12">
    <p>Sin preguntas</p>
  </div>
</div>
@endif

@endsection
