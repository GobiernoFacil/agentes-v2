@extends('layouts.admin.a_master')
@section('title', '' )
@section('description','' )
@section('body_class', 'fellow foros')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
	<div class="col-sm-9">
		@if($session)
		<h1>Preguntas de la sesión: {{$session->name}}</h1>
		@else
		<h1>Preguntas del {{$forum->topic}}</h1>
		@endif
	</div>
  <div class="col-sm-3 center">
		@if($session)
		<a href='{{ url("tablero/foros/{$session->slug}/pregunta/crear") }}' class="btn gde"><strong>+</strong> Agregar Pregunta</a>
		@else
		<a href='{{ url("tablero/foros/pregunta/estado/{$user->FellowData->state}/crear") }}' class="btn gde"><strong>+</strong> Agregar Pregunta</a>
		@endif
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
							@if($session)
			        <td><h4> <a href="{{ url('tablero/foros/pregunta/'.$session->slug.'/'.$conversation->slug.'/ver') }}">{{$conversation->topic}}</a></h4></td>
							@else
							<td><h4> <a href="{{ url('tablero/foros/'.$user->FellowData->state.'/'.$conversation->slug.'/ver') }}">{{$conversation->topic}}</a></h4></td>
							@endif
              <td>{{str_limit($conversation->description, $limit = 20, $end = '...')}}</td>
			        <td>
								@if($session)
			          <a href="{{ url('tablero/foros/pregunta/'.$session->slug.'/'.$conversation->slug.'/ver') }}" class="btn xs view">Ver</a>
								@else
								<a href="{{ url('tablero/foros/'.$user->FellowData->state.'/'.$conversation->slug.'/ver') }}" class="btn xs view">Ver</a>
								@endif
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
