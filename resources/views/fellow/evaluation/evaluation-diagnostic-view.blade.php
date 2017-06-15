@extends('layouts.admin.a_master')
@section('title', 'Calificaciones')
@section('description', 'Calificaciones')
@section('body_class', 'fellow')
@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Ver calificación examen diagnóstico</h1>
  </div>
</div>

<div class="box">
  <div class="row">
    <div class="col-sm-12">
      @if($user->diagnostic)
          @if($user->diagnosticEvaluation)
            <ul>
              <li><strong>Describe brevemente el concepto de Gobierno Abierto, así como su relación con la resolución de problemas públicos y la gestión pública gubernamental.</strong> <br>

                  <p><strong>Respuesta: </strong>{{$user->diagnostic->answer_1}}</p>
                  <p><strong>Puntaje: </strong> {{$user->diagnosticEvaluation->answer_ponderation_1/2}}</p>
                  <p><strong>Comentarios: </strong>{{$user->diagnosticEvaluation->answer_q1_j}}</p>
              </li>

              <li><strong>Menciona dos Objetivos de la Agenda de Desarrollo Sostenible y cómo se relaciona cada uno con los mecanismos de Gobierno Abierto.</strong> <br>

                  <p><strong>Respuesta: </strong>{{$user->diagnostic->answer_2}}</p>
                  <p><strong>Puntaje: </strong> {{$user->diagnosticEvaluation->answer_ponderation_2/2}}</p>
                  <p><strong>Comentarios: </strong>{{$user->diagnosticEvaluation->answer_q2_j}}</p>
              </li>
              <li><strong>Ejemplifica una acción de incidencia en política pública que hayas ejecutado, identificando objetivo(s) de la incidencia, actores relevantes, estrategia para la consecución de dichos objetivos, los resultados obtenidos y deseados, una breve explicación sobre la brecha entre ambos (en caso de existir) y las lecciones aprendidas sobre el proceso.</strong> <br>

                  <p><strong>Respuesta: </strong>{{$user->diagnostic->answer_3}}</p>
                  <p><strong>Puntaje: </strong> {{$user->diagnosticEvaluation->answer_ponderation_3/2}}</p>
                  <p><strong>Comentarios: </strong>{{$user->diagnosticEvaluation->answer_q3_j}}</p>
              </li>
              <li><strong>Menciona los elementos que consideras que integran a una estrategia de comunicación exitosa y sus fases de implementación.</strong> <br>

                  <p><strong>Respuesta: </strong>{{$user->diagnostic->answer_4}}</p>
                  <p><strong>Puntaje: </strong> {{$user->diagnosticEvaluation->answer_ponderation_4/2}}</p>
                  <p><strong>Comentarios: </strong>{{$user->diagnosticEvaluation->answer_q4_j}}</p>
              </li>

              <li><strong>Con respecto al proyecto a generar dentro del marco del fellowship, describe si éste tiene implicaciones presupuestarias para su implementación, así como las potenciales fuentes de financiamiento y la estrategia para la consecución de fondos.</strong> <br>

                  <p><strong>Respuesta: </strong>{{$user->diagnostic->answer_5}}</p>
                  <p><strong>Puntaje: </strong> {{$user->diagnosticEvaluation->answer_ponderation_5/2}}</p>
                  <p><strong>Comentarios: </strong>{{$user->diagnosticEvaluation->answer_q5_j}}</p>
              </li>
            </ul>
          @else
              <p>Aún no cuentas con evaluación</p>
          @endif
        @else
        <p>Aún no has realizado la evaluación</p>
        @endif
    </div>
  </div>
</div>
@endsection
