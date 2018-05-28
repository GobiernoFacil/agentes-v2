@extends('layouts.admin.a_master')
@section('title', $activity->name)
@section('description', 'Plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'evaluacion')
@section('breadcrumb_type', 'evaluation diagnostic view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_evaluation')

@section('content')

<div class="row">
	<div class="col-sm-12">
		<h1>Cuestionario diagnóstico</h1>
    <h2><strong>{{$activity->diagnostic_info->title}}</strong></h2>
    <h3>{{$fellow->name.' '.$fellow->fellowData->username.' '.$fellow->fellowData->lastname}}</h3>
  <div class="divider top"></div>
	</div>
<?php /*
<div class="col-sm-12 right">
    <a href='{{ url("dashboard/diagnostico/descargar/pdf/{$questionnaire->id}")}}' class="btn xs view">Descargar PDF</a>
    <a href='{{ url("dashboard/diagnostico/descargar/xlsx/{$questionnaire->id}") }}' class="btn xs view">Descargar XLSX</a>
</div>
*/

?>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<div class="divider top"></div>
				<ol class="list line">
          @foreach($activity->diagnostic_info->questions as $question)
          <li class="row">
            <span class="col-sm-9"><h3>{{$question->question}}</h3>
              @if($question->type==='open')
                <p>{{$question->get_open_fellow_answer($fellow->id)->answer}}</p>
              @elseif($question->type==='answers')
              <ul>
                @foreach($question->answers as $answer)
                  @if($ans = $fellow->new_diagnostic($activity->diagnosticInfo->id)->where('question_id',$question->id)->where('answer_id',$answer->id)->first())
                  <li>{{$answer->answer}}</li>
                  @endif
                @endforeach
              </ul>
              @elseif($question->type==='radio')

              @endif

            </span>
          </li>
          @endforeach
				</ol>
				<div class="divider"></div>
		</div>
	</div>
</div>

@endsection
