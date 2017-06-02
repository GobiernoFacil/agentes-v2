@extends('layouts.admin.a_master')
@section('title', '' )
@section('description','' )
@section('body_class', 'fellow foros')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Foros de la sesión: {{$session->name}}</h1>
	</div>
  <div class="col-sm-3 center">
		<a href='{{ url("tablero/foros/{$session->module->slug}/{$session->slug}/pregunta/crear") }}' class="btn gde"><strong>+</strong> Agregar Pregunta</a>
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
			        <td><h4> <a href="{{ url('tablero/foros/'.$session->slug.'/'.$forum->slug.'/$conversation->slug/ver') }}">{{$conversation->topic}}</a></h4></td>
              <td>{{str_limit($conversation->description, $limit = 20, $end = '...')}}</td>
			        <td>
			          <a href="{{ url('tablero/foros/'.$session->slug.'/'.$forum->slug.'/$conversation->slug/ver') }}" class="btn xs view">Ver</a>
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
