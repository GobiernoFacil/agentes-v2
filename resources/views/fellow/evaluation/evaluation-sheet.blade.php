@extends('layouts.admin.a_master')
@section('title', 'Calificaciones')
@section('description', 'Calificaciones')
@section('body_class', 'fellow')
@section('breadcrumb_type', 'score list')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_score')

@section('content')
<div class="row">
  <div class="col-sm-9">
    <h1>Calificaciones</h1>
  </div>
 <div class="col-sm-3 right">
	 <p>Promedio general: <span class="score_a block">{{number_format($average,2)}}</span></p>
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
		<?php $n = 2;?>
		@foreach($modules as $module)
			@if($module->title ==="Examen de diagnóstico" || $module->title ==="Examen diagnóstico")
			<!-- examen diagnóstico-->
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
                  <span class="col-sm-6">
                  	<h4>{{$session->name}}</h4>
                  </span>
                  <span class="col-sm-12">
                    <ul>
                    @foreach($session->activities as $activity)
                       @if($activity->type === 'evaluation')
					   <li class="row">
					   		<!--activity name--->
					   		<span class="col-sm-6">
					   			<p><a href='{{url("tablero/aprendizaje/{$activity->session->slug}/{$activity->session->slug}/$activity->id")}}'><strong>{{$activity->name}}</strong></a></p>
					   		</span>
					   		<!--evaluation type--->

                            @if($activity->files === 'Sí')
                        	<span class="col-sm-3">
                            	<a href="{{url('tablero/calificaciones/archivos/ver/' . $activity->slug)}}" class="link_a">Revisión de productos</a>
                        	</span>
                        	<span class="col-sm-3 right">
  	                          <span class="score_a">{{$user->fileFellowScore($user->id,$activity->id) ? number_format($user->fileFellowScore($user->id,$activity->id)->score,2) : "Sin calificación" }}</span>
                        	  </span>
                            @else
                            @if($activity->quizInfo)
                          	   <span class="col-sm-3">
                               <a href="{{url('tablero/calificaciones/ver/' . $activity->slug)}}" class="link_a">Examen en línea</a>
                              </span>
                              @else
                              <span class="col-sm-3">
                              Examen en línea
                             </span>
                              @endif
                        	<span class="col-sm-2 right">
                              @if($activity->quizInfo)
                             <span class="score_a">{{$activity->fellowScore($activity->quizInfo->id,$user->id) ? number_format($activity->fellowScore($activity->quizInfo->id,$user->id)->score,2) : "Sin calificación" }}</span>
                             @else
                           <span class="">Evaluación no disponible</span>
                             @endif
                             </span>
                            @endif
                        </li>

                        @endif
                    @endforeach
                  </ul>
                  </span>
                  <span class="col-sm-12"></span>
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
