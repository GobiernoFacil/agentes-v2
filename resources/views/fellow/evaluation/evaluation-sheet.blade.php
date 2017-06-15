@extends('layouts.admin.a_master')
@section('title', 'Calificaciones')
@section('description', 'Calificaciones')
@section('body_class', 'fellow')
@section('breadcrumb_type', 'score list')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_score')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Calificaciones</h1>
  </div>
</div>

<div class="box score">
  <div class="row">
	  <div class="col-sm-3 col-sm-offset-6">
		  <h5>Tipo de evaluación</h5>
	  </div>
	  <div class="col-sm-2 right">
	  	<h5>Calificación</h5>
	  </div>
    <div class="col-sm-12">
	            <div class="divider b"></div>

      <?php $n = 1;?>
      @foreach($modules as $module)
      @if($module->title ==="Examen de diagnóstico" || $module->title ==="Examen diagnóstico")
      <h2 class ="title">Módulo {{$n}}</h2>
      <p><strong>{{$module->title}}</strong></p>
        <ul class="list">
          @foreach($module->sessions as $session)
                <li class="row">
                  <span class="col-sm-12">
                  	<span class="session">Sesión {{$session->order}}</span>
                  </span>
                  <span class="col-sm-6">
                  	<h4>{{$session->name}}</h4>
                  </span>
                  @foreach($session->activities as $activity)
                  	 <span class="col-sm-3">
                      @if($activity->type === 'evaluation')
                      <span>{{$activity->hasfiles === 'No' ? 'Examen en línea' : 'Revisión de Productos'}}</span>
                      @endif
                  	 </span>
                  	  <span class="col-sm-2 right">
                      @if($activity->name ==="Examen diagnóstico")
                      <span class="score_a">{{$user->diagnosticEvaluation ? $user->diagnosticEvaluation->total_score/10 : "Sin calificación" }}</span>
                      @endif
                  	  </span>
                  @endforeach
                </li>
          @endforeach
        </ul>
        <div class="divider b"></div>
        <?php $n++;?>
        @endif
      @endforeach
    </div>
  </div>
</div>
@endsection
