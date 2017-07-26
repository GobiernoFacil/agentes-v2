@extends('layouts.admin.a_master')
@section('title', 'Calificaciones de ' . $fellow->name.' '.$fellow->fellowData->surname.' '.$fellow->fellowData->lastname)
@section('description', 'Calificaciones')
@section('body_class', 'fellows')
@section('breadcrumb_type', 'fellow ver calificaciones')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_fellows')

@section('content')
<div class="row">
  <div class="col-sm-9">
    <h1>Calificaciones de {{$fellow->name.' '.$fellow->fellowData->surname.' '.$fellow->fellowData->lastname}}</h1>
  </div>
 <div class="col-sm-3 right">
	 <p>Promedio general: <span class="score_a block">{{$fellow->total_average($fellow->id) ? number_format($fellow->total_average($fellow->id)->average,2) : 'Sin promedio'}}</span></p>
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
            @if($fellow->diagnosticEvaluation)
            <h4><a href='{{url("dashboard/evaluacion/diagnostico/ver/{$fellow->diagnosticEvaluation->id}")}}' class="link_a">{{$session->name}}</a></h4>
            @else
				  	     <h4>{{$session->name}}</h4>
            @endif
				  </span>
				  @foreach($session->activities as $activity)
				  	 <span class="col-sm-3">
				      @if($activity->type === 'evaluation')
                @if($fellow->diagnosticEvaluation)
  				      <a href='{{url("dashboard/evaluacion/diagnostico/ver/{$fellow->diagnosticEvaluation->id}")}}' class="link_a">{{$activity->hasfiles === 'No' ? 'Examen en línea' : 'Revisión de Productos'}}</a>
                @else
                  Examen en línea
                @endif
              @endif
				  	 </span>
				  	  <span class="col-sm-2 right">
				      @if($activity->name ==="Examen diagnóstico")
				      <span class="score_a">{{$fellow->diagnosticEvaluation ? $fellow->diagnosticEvaluation->total_score/10 : "Sin calificación" }}</span>
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
			<p><strong>{{$module->title}}</strong><br>
        <span class="note"><strong>Calificación: </strong> {{$fellow->module_average($fellow->id,$module->id) ? $fellow->module_average($fellow->id,$module->id)->type !='sin' ? number_format($fellow->module_average($fellow->id,$module->id)->average,2) : 'No aplica'  : 'Sin calificación'}}</span>
      </p>
			<ul class="list">
				@foreach($module->sessions as $session)
                <li class="row">
                  <span class="col-sm-12">
                  	<span class="session">Sesión {{$session->order}}</span>
                  </span>
                  <span class="col-sm-6">
                  	<h4>{{$session->name}}</h4>
                    <span class="note"><strong>Calificación: </strong> {{$fellow->session_average($fellow->id,$session->id) ? $fellow->session_average($fellow->id,$session->id)->type !='sin' ? number_format($fellow->session_average($fellow->id,$session->id)->average,2) : 'No aplica' : 'Sin calificación'}}</span>
                  </span>
                  <span class="col-sm-12">
                    <ul>
                    @foreach($session->activities as $activity)
                       @if($activity->type === 'evaluation')
					   <li class="row">
					   		<!--activity name--->
					   		<span class="col-sm-6">
                  <p>
                  @if($activity->files === 'Sí')
                        @if($fellow->fileFellowScore($fellow->id,$activity->id))
					   			             <a href='{{url("dashboard/evaluacion/actividad/archivos/resultados/ver/{$fellow->fileFellowScore($fellow->id,$activity->id)->id}")}}'><strong>{{$activity->name}}</strong></a>
                         @else
                          <strong>{{$activity->name}}</strong>
                         @endif

                  @else
                    @if($activity->slug==='examen-diagnostico')
                      @if($fellow->diagnostic)
                      <a href='{{url("dashboard/evaluacion/diagnostico/ver/{$fellow->diagnostic->id}")}}'><strong>{{$activity->name}}</strong></a>

                      @else
                      <strong>{{$activity->name}}</strong>
                      @endif
                    @else
                        @if($activity->quizInfo)
                          @if($activity->fellowScore($activity->quizInfo->id,$fellow->id))
                            <a href='{{url("dashboard/evaluacion/actividad/resultados/ver/{$activity->fellowScore($activity->quizInfo->id,$fellow->id)->id}")}}'><strong>{{$activity->name}}</strong></a>
                          @else
                            <strong>{{$activity->name}}</strong>
                          @endif
                        @else
                            <strong>{{$activity->name}}</strong>
                        @endif
                    @endif
                  @endif
                  </p>
					   		</span>
					   		<!--evaluation type--->

                         @if($activity->files === 'Sí')
                               @if($fellow->fileFellowScore($fellow->id,$activity->id))
                              	<span class="col-sm-3">
                                  	<a href='{{url("dashboard/evaluacion/actividad/archivos/resultados/ver/{$fellow->fileFellowScore($fellow->id,$activity->id)->id}")}}' class="link_a">Revisión de productos</a>
                              	</span>
                                @else
                                <span class="col-sm-3">
                                  	Revisión de productos
                              	</span>
                                @endif
                          	<span class="col-sm-3 right">
    	                          <span class="score_a">{{$fellow->fileFellowScore($fellow->id,$activity->id) ? number_format($fellow->fileFellowScore($fellow->id,$activity->id)->score,2) : "Sin calificación" }}</span>
                          	  </span>
                          @else
                              <span class="col-sm-3">
                                  @if($activity->quizInfo)
                                    @if($activity->fellowScore($activity->quizInfo->id,$fellow->id))
                                    <a href='{{url("dashboard/evaluacion/actividad/resultados/ver/{$activity->fellowScore($activity->quizInfo->id,$fellow->id)->id}")}}' class="link_a">Examen en línea</a>
                                    @else
                                    Examen en línea
                                    @endif
                                  @else
                                  Examen en línea
                                  @endif
                                </span>
                          	<span class="col-sm-2 right">
                                @if($activity->quizInfo)
                                  @if($activity->fellowScore($activity->quizInfo->id,$fellow->id))
                                  <span class="score_a">{{$activity->fellowScore($activity->quizInfo->id,$fellow->id) ? number_format($activity->fellowScore($activity->quizInfo->id,$fellow->id)->score,2) : "Sin calificación" }}</span>
                                  @else
                                    <span>Sin calificación</span>
                                  @endif
                                 @else
                                 <span class="">Sin examen</span>
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
