@extends('layouts.admin.a_master')
@section('title', 'Lista de examen diagnóstico')
@section('description', 'Lista de examen diagnóstico')
@section('body_class', '')

@section('content')


<div class="row">
	<div class="col-sm-12">
		<h1>Cuestionario diagnóstico</h1>
    <h2><strong>{{$questionnaire->title}}</strong></h2>
  <div class="divider top"></div>
	</div>
<div class="col-sm-12 right">
    <a href='{{ url("dashboard/diagnostico/descargar/pdf/{$questionnaire->id}")}}' class="btn xs view">Descargar PDF</a>
    <a href='{{ url("dashboard/diagnostico/descargar/xlsx/{$questionnaire->id}") }}' class="btn xs view">Descargar XLSX</a>
</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<div class="divider top"></div>
				<ol class="list line">
          @foreach($questionnaire->questions as $question)
          <li class="row">
            <span class="col-sm-9">
            <h3>{{$question->question}}</h3>
						<small>Respuestas: {{$question->answers_fellows->count()}}</small>
						@foreach($question->answers_fellows as $answer)
							<p>{{$answer->answer}}</p>
						@endforeach
            </span>
          </li>
          @endforeach
				</ol>
				<div class="divider"></div>
		</div>
	</div>
</div>
@endsection
