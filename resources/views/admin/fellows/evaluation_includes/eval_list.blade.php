<!--título del módulo-->
<div class="col-sm-9">
	<h2 class ="title">Módulo {{$n}}</h2>
	<p><strong>{{$module->title}}</strong></p>
</div>
<div class="col-sm-3 right">
	<p>Calificación:
		<span class="score_a block">{{$fellow->module_average($fellow->id,$module->id) ? $fellow->module_average($fellow->id,$module->id)->type !='sin' ? number_format($fellow->module_average($fellow->id,$module->id)->average,2) : 'No aplica'  : 'Sin calificación'}}</span>
	</p>
</div>
<div class="col-sm-12">
	<div class="divider b"></div>
</div>

<ul class="list">
	@foreach($module->sessions as $session)
    <li class="row">
    	<!--nombre de sesión-->
        <span class="col-sm-8">
            <span class="session">Sesión {{$session->order}}</span>
            <h4>{{$session->name}}</h4>
        </span>
        <!--calificación de sesión-->
        <span class="col-sm-3 right">
        	Calificación: <br>
        	<strong>{{$fellow->session_average($fellow->id,$session->id) ? $fellow->session_average($fellow->id,$session->id)->type !='sin' ? number_format($fellow->session_average($fellow->id,$session->id)->average,2) : 'No aplica' : 'Sin calificación'}}</strong>
        </span>
        <span class="col-sm-11">
			<div class="divider b"></div>
		</span>
        
        <!--foros-->
        <span class="col-sm-12">
            <ul>
	            
            </ul>
        </span>
        
        <!--evaluaciones-->
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
                    <!--- foros-->
                    <li class="row">
	            	<span class="col-sm-6">
	            		<p><strong>Foros</strong></p>
	            	</span>
	            	<span class="col-sm-3">
	            		Participaciones
	            	</span>
	            	<span class="col-sm-2 right">
	            		{{$fellow->forum_participation($fellow->id,$session->id) > 0  ? $fellow->forum_participation($fellow->id,$session->id) : 'Sin participación' }}
	            	</span>
	            </li>
                  </ul>
                  </span>
                  <span class="col-sm-12"></span>
                </li>
          @endforeach
        </ul>
<div class="divider"></div>