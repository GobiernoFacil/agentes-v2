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
<p>Promedio: {{number_format($average,2)}}</p>
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

      <?php $n = 2;?>
      @foreach($modules as $module)
      @if($module->title ==="Examen de diagnóstico" || $module->title ==="Examen diagnóstico")
      <h2 class ="title">Módulo 1</h2>
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
                      <a href="{{url('tablero/calificaciones/ver/' . $activity->slug)}}" class="link_a">{{$activity->hasfiles === 'No' ? 'Examen en línea' : 'Revisión de Productos'}}</a>
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
        @endif
      @endforeach
      @foreach($modules as $module)
      @if($module->title !="Examen de diagnóstico" && $module->title !="Examen diagnóstico")
      <h2 class ="title">Módulo {{$n}}</h2>
      <p><strong>{{$module->title}}</strong></p>
        <ul class="list">
          @foreach($module->sessions as $session)
                <li class="row">
                  <span class="col-sm-12">
                  	<span class="session">Sesión {{$session->order}}</span>
                  </span>
                  <span class="col-sm-12">
                  	<h4>{{$session->name}}</h4>
                  </span>
                    <ul>
                    @foreach($session->activities as $activity)

                       @if($activity->type === 'evaluation')
                       <p>
                         <span><strong>{{$activity->name}}</strong></span>
                          <li>
                            @if($activity->files === 'Sí')
                        	 <span>
                            <a href="{{url('tablero/calificaciones/archivos/ver/' . $activity->slug)}}" class="link_a">Revisión de productos</a>
                        	 </span>
                        	  <span>
                            <span class="score_a">{{$user->fileFellowScore($user->id,$activity->id) ? number_format($user->fileFellowScore($user->id,$activity->id)->score,2) : "Sin calificación" }}</span>
                        	  </span>
                            @else
                            <span>
                             <a href="{{url('tablero/calificaciones/ver/' . $activity->slug)}}" class="link_a">Examen en línea</a>
                            </span>
                             <span>
                              @if($activity->quizInfo)
                             <span class="score_a">{{$activity->fellowScore($activity->quizInfo->id,$user->id) ? number_format($activity->fellowScore($activity->quizInfo->id,$user->id)->score,2) : "Sin calificación" }}</span>
                             @else
                           <span class="score_a">Sin calificación</span>
                             @endif
                             </span>
                            @endif
                        </li>
                      </p>
                        @endif
                    @endforeach
                  </ul>
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
