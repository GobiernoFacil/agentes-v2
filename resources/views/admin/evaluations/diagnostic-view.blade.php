@extends('layouts.admin.a_master')
@section('title', '')
@section('description', 'plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', '')

@section('content')

<div class="row">
	<div class="col-sm-9">
		<h1>Respuestas de evaluación diagnóstico - {{$answers->user->name.' '.$answers->user->fellowData->surname." ".$answers->user->fellowData->lastname}}</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
      <ul>
        <li><strong>Concepto de Gobierno Abierto</strong><br>
          {{$answers->answer_1}}<br>
					@if($answers->user->diagnosticEvaluation)
					<strong>Puntaje: </strong>{{$answers->user->diagnosticEvaluation->answer_ponderation_1}}
					@endif
        </li>
        <li><strong>Objetivos de la Agenda de Desarrollo Sostenible</strong><br>
          {{$answers->answer_2}}<br>
					@if($answers->user->diagnosticEvaluation)
					<strong>Puntaje: </strong>{{$answers->user->diagnosticEvaluation->answer_ponderation_2}}
					@endif
        </li>
        <li><strong>Ejemplificación de una acción de incidencia política</strong><br>
          {{$answers->answer_3}}<br>
					@if($answers->user->diagnosticEvaluation)
					<strong>Puntaje: </strong>{{$answers->user->diagnosticEvaluation->answer_ponderation_3}}
					@endif
        </li>
        <li><strong>Elementos que integran una estrategia de comunicación exitosa</strong><br>
          {{$answers->answer_4}}<br>
					@if($answers->user->diagnosticEvaluation)
					<strong>Puntaje: </strong>{{$answers->user->diagnosticEvaluation->answer_ponderation_4}}
					@endif
        </li>
        <li><strong>Descripción de implicaciones presupuestarias del proyecto a generar</strong><br>
          {{$answers->answer_5}}<br>
					@if($answers->user->diagnosticEvaluation)
					<strong>Puntaje: </strong>{{$answers->user->diagnosticEvaluation->answer_ponderation_5}}
					@endif
        </li>
				@if($answers->user->diagnosticEvaluation)
				<li><strong>Puntaje Total: </strong>{{$answers->user->diagnosticEvaluation->total_score}}
				</li>
				@endif
      </ul>
		</div>
	</div>
</div>
@endsection
