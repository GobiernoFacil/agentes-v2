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
          {{$answers->answer_1}}
        </li>
        <li><strong>Objetivos de la Agenda de Desarrollo Sostenible</strong><br>
          {{$answers->answer_2}}
        </li>
        <li><strong>Ejemplificación de una acción de incidencia política</strong><br>
          {{$answers->answer_3}}
        </li>
        <li><strong>Elementos que integran una estrategia de comunicación exitosa</strong><br>
          {{$answers->answer_4}}
        </li>
        <li><strong>Descripción de implicaciones presupuestarias del proyecto a generar</strong><br>
          {{$answers->answer_5}}
        </li>
      </ul>
		</div>
	</div>
</div>
@endsection
