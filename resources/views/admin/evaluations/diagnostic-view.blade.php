@extends('layouts.admin.a_master')
@section('title', 'Respuestas de evaluación diagnóstico de ' . $answers->user->name . ' ' . $answers->user->fellowData->surname)
@section('description', 'Respuestas de evaluación diagnóstico')
@section('body_class', 'diagnostic')
@section('breadcrumb_type', 'diagnostic view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_diagnostic')

@section('content')

<div class="row">
	<div class="col-sm-12">
		<h1>Respuestas de examen de diagnóstico de <strong>{{$answers->user->name.' '.$answers->user->fellowData->surname." ".$answers->user->fellowData->lastname}}</strong></h1>
		<div class="divider top"></div>
	</div>
	<!--info fellow-->
	<div class="col-sm-1 center">
		@if($answers->user->image)
		<img src='{{url("img/users/{$answers->user->image->name}")}}' width="100%">
		@else
		<img src='{{url("img/users/default.png")}}' height="40px">
		@endif
	</div>
	<div class="col-sm-5">
		<p>{{$answers->user->fellowData->city}}, {{$answers->user->fellowData->state}}</p>
	</div>
	<div class="col-sm-3">
		<p>{{$answers->user->fellowData->origin}}</p>
	</div>
	<div class="col-sm-3">
		<p>Contestado <a title="{{date('d-m-Y H:i', strtotime($answers->created_at))}}">{{$answers->created_at->diffForHumans()}}</a></p>
	</div>
</div>

<div class="box">
	<div class="row">
		<div class="col-sm-9">
			@if(!($answers->user->diagnosticEvaluation))
			 <a href ="{{ url('dashboard/evaluacion/diagnostico/evaluar/1/' . $answers->id) }}"   class="btn xs view">Evaluar examen</a>
			@else
			 <a href ="{{ url('dashboard/evaluacion/diagnostico/evaluar/1/' . $answers->id) }}"   class="btn xs view">Evaluar examen</a>
			@endif
		</div>
		<div class="col-sm-3 right">
			<h3>Puntaje total: </h3>
			@if($answers->user->diagnosticEvaluation)
			<h2>{{$answers->user->diagnosticEvaluation->total_score > 0 ? $answers->user->diagnosticEvaluation->total_score/10 . '/10' : '0/0'  }}</h2>
			@endif
		</div>
		<div class="col-sm-12">
			<div class="divider top"></div>
				<ol class="list line">
					<li class="row">
						<span class="col-sm-9">
						<h3>Describe brevemente el concepto de Gobierno Abierto, así como su relación con la resolución de problemas públicos y la gestión pública gubernamental:</h3>
						<p><strong>Respuesta:</strong> {{$answers->answer_1}}</p>
						</span>
						<span class="col-sm-3 right">
								@if($answers->user->diagnosticEvaluation)
								<p><strong>Puntaje: </strong>{{$answers->user->diagnosticEvaluation->answer_ponderation_1 > 0 ? $answers->user->diagnosticEvaluation->answer_ponderation_1/10 : '0' }}</p>
								@endif
						</span>
					</li>
					<li class="row">
						<span class="col-sm-9">
							<h3>Menciona dos Objetivos de la Agenda de Desarrollo Sostenible y cómo se relaciona cada uno con los mecanismos de Gobierno Abierto:</h3>
							<p><strong>Respuesta:</strong> {{$answers->answer_2}}</p>
						</span>
						<span class="col-sm-3 right">
							@if($answers->user->diagnosticEvaluation)
								<p><strong>Puntaje: </strong>{{$answers->user->diagnosticEvaluation->answer_ponderation_2 > 0 ? $answers->user->diagnosticEvaluation->answer_ponderation_2/10 : '0' }}</p>
							@endif
						</span>
					</li>
					<li class="row">
						<span class="col-sm-9">
							<h3>Ejemplificación de una acción de incidencia política</h3>
							<p><strong>Respuesta:</strong> {{$answers->answer_3}}</p>
						</span>
						<span class="col-sm-3 right">
							@if($answers->user->diagnosticEvaluation)
								<p><strong>Puntaje: </strong>{{$answers->user->diagnosticEvaluation->answer_ponderation_3 > 0 ? $answers->user->diagnosticEvaluation->answer_ponderation_3/10 : '0' }}</p>
							@endif
						</span>
					</li>
					<li class="row">
						<span class="col-sm-9">
							<h3>Elementos que integran una estrategia de comunicación exitosa</h3>
							<p><strong>Respuesta:</strong> {{$answers->answer_4}}</p>
						</span>
						<span class="col-sm-3 right">
							@if($answers->user->diagnosticEvaluation)
								<p><strong>Puntaje: </strong>{{$answers->user->diagnosticEvaluation->answer_ponderation_4 > 0 ? $answers->user->diagnosticEvaluation->answer_ponderation_4/10 : '0 ' }}</p>
							@endif
						</span>
					</li>
					<li class="row">
						<span class="col-sm-9">
							<h3>Descripción de implicaciones presupuestarias del proyecto a generar</h3>
							<p><strong>Respuesta:</strong> {{$answers->answer_5}}</p>
						</span>
						<span class="col-sm-3 right">
							@if($answers->user->diagnosticEvaluation)
								<p><strong>Puntaje: </strong>{{$answers->user->diagnosticEvaluation->answer_ponderation_5 > 0 ? $answers->user->diagnosticEvaluation->answer_ponderation_5/10 : '0'}}</p>
							@endif
						</span>
					</li>
				</ol>
				<div class="divider"></div>
				<p class="center">
				@if(!($answers->user->diagnosticEvaluation))
				<a href ="{{ url('dashboard/evaluacion/diagnostico/evaluar/1/' . $answers->id) }}"   class="btn xs view">Evaluar examen</a>
				@else
				<a href ="{{ url('dashboard/evaluacion/diagnostico/evaluar/1/' . $answers->id) }}"   class="btn xs view">Evaluar examen</a>
				@endif
				</p>
		</div>
	</div>
</div>
@endsection
