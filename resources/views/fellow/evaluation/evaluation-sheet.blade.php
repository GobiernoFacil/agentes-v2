@extends('layouts.admin.a_master')
@section('title', 'Calificaciones')
@section('description', 'Calificaciones')
@section('body_class', 'fellow')
@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Calificaciones</h1>
  </div>
</div>

<div class="box">
  <div class="row">
    <div class="col-sm-12">
      <?php $n = 1;?>
      @foreach($modules as $module)
      @if($module->title ==="Examen de diagnóstico")
      <h2 class ="title">Módulo {{$n}}</h2>
      <p>{{$module->title}}</p>
        <ul>
          @foreach($module->sessions as $session)
                <li>Sesión {{$session->order}}
                  <p>{{$session->name}}</p>
                  @foreach($session->activities as $activity)
                      @if($activity->type === 'evaluation')
                      <span>{{$activity->hasfiles === 'No' ? 'Examen en línea' : 'Revisión de Productos'}}</span>
                      @endif
                      @if($activity->name ==="Examen diagnóstico")
                      <span>{{$user->diagnosticEvaluation ? $user->diagnosticEvaluation->total_score/10 : "Sin calificación" }}</span>
                      @endif
                  @endforeach
                </li>
          @endforeach
        </ul>
        <?php $n++;?>
        @endif
      @endforeach
    </div>
  </div>
</div>
@endsection
