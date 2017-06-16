@extends('layouts.admin.a_master')
@section('title', 'Calificaciones')
@section('description', 'Calificaciones')
@section('body_class', 'fellow')
@section('breadcrumb_type', 'score diagnostic')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_score')
@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Ver calificación examen diagnóstico</h1>
  </div>
</div>

<div class="box">
  <div class="row">
      @if($user->diagnostic)
       		@if($user->diagnosticEvaluation)
	   		<div class="col-sm-3 col-sm-offset-9 right">
				<h3>Puntaje total: </h3>
				<h2>{{$user->diagnosticEvaluation->total_score > 0 ? $user->diagnosticEvaluation->total_score/10 . '/10' : '0/0'  }}</h2>
			</div>
		    <div class="col-sm-12">
				<div class="divider top"></div>
				<ol class="list line">
					<li class="row">
						<span class="col-sm-9">
						<h3>Describe brevemente el concepto de Gobierno Abierto, así como su relación con la resolución de problemas públicos y la gestión pública gubernamental:</h3>
						<p><strong>Respuesta:</strong> {{$user->diagnostic->answer_1}}</p>
						</span>
						<span class="col-sm-3 right">
							<p><strong>Puntaje: </strong>{{$user->diagnosticEvaluation->answer_ponderation_1 > 0 ? $user->diagnosticEvaluation->answer_ponderation_1/10 : '0' }} de 2</p>
						</span>
					<!--<p><strong>Comentarios: </strong>{{$user->diagnosticEvaluation->answer_q1_j}}</p>-->
					</li>

					<li class="row">
						<span class="col-sm-9">
							<h3>Menciona dos Objetivos de la Agenda de Desarrollo Sostenible y cómo se relaciona cada uno con los mecanismos de Gobierno Abierto.</h3> 
							<p><strong>Respuesta:</strong> {{$user->diagnostic->answer_2}}</p>
						</span>
						<span class="col-sm-3 right">
							<p><strong>Puntaje: </strong>{{$user->diagnosticEvaluation->answer_ponderation_2 > 0 ? $user->diagnosticEvaluation->answer_ponderation_2/10 : '0' }} de 2</p>
						</span>
               
					</li>
					<li class="row">
						<span class="col-sm-9">
							<h3>Ejemplifica una acción de incidencia en política pública que hayas ejecutado, identificando objetivo(s) de la incidencia, actores relevantes, estrategia para la consecución de dichos objetivos, los resultados obtenidos y deseados, una breve explicación sobre la brecha entre ambos (en caso de existir) y las lecciones aprendidas sobre el proceso.</h3>
							<p><strong>Respuesta:</strong> {{$user->diagnostic->answer_3}}</p>
						</span>
						<span class="col-sm-3 right">
							<p><strong>Puntaje: </strong>{{$user->diagnosticEvaluation->answer_ponderation_3 > 0 ? $user->diagnosticEvaluation->answer_ponderation_3/10 : '0' }} de 2</p>
						</span>
					</li>
					<li class="row">
						<span class="col-sm-9">
							<h3>Menciona los elementos que consideras que integran a una estrategia de comunicación exitosa y sus fases de implementación.</h3>
							<p><strong>Respuesta:</strong> {{$user->diagnostic->answer_4}}</p>
						</span>
						<span class="col-sm-3 right">
							<p><strong>Puntaje: </strong>{{$user->diagnosticEvaluation->answer_ponderation_4 > 0 ? $user->diagnosticEvaluation->answer_ponderation_4/10 : '0' }} de 2</p>
						</span>
					</li>
					<li class="row">
						<span class="col-sm-9">
							<h3>Con respecto al proyecto a generar dentro del marco del fellowship, describe si éste tiene implicaciones presupuestarias para su implementación, así como las potenciales fuentes de financiamiento y la estrategia para la consecución de fondos.</h3>
							<p><strong>Respuesta:</strong> {{$user->diagnostic->answer_5}}</p>
						</span>
						<span class="col-sm-3 right">
							<p><strong>Puntaje: </strong>{{$user->diagnosticEvaluation->answer_ponderation_5 > 0 ? $user->diagnosticEvaluation->answer_ponderation_5/10 : '0' }} de 2</p>
						</span>
					</li>
            	</ol>
		    </div>
          @else
          	<div class="col-sm-12">
              <p>Aún no cuentas con evaluación</p>
          	</div>
          @endif
    @else
    	<div class="col-sm-12">
       	 <p>Aún no has realizado la evaluación</p>
    	</div>
    @endif
  </div>
</div>
@endsection
