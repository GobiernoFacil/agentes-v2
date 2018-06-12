<li class="row">
	<!--activity name--->
	<span class="col-sm-6 activity">
      <strong>{{$activity->name}}</strong>
  </span>
	<!--evaluation type--->
	@if($activity->files)
		<span class="col-sm-3">  Revisión de productos</span>
    <span class="col-sm-3 right">
    			{{$fellow->fileFellowScore($activity->id) ? number_format($fellow->fileFellowScore($activity->id)->score,2)*10 : "Sin calificación" }}
    </span>
    @else
    	<span class="col-sm-3">
        @if($activity->quizInfo)
        	<!--si es evaluación-->
            @if($activity->fellowScore($fellow->id))
            	<!--si tiene calificación-->
            	<a href='{{url("dashboard/programas/$program->id/ver-evaluacion/$activity->id/resultados/{$activity->fellowScore($fellow->id)->id}")}}' class="link_a">Examen en línea</a>
	        @else
                Examen en línea
            @endif
        @else
            Examen en línea
        @endif
        </span>
        <span class="col-sm-3 right">
        @if($activity->quizInfo)
            @if($activity->fellowScore($fellow->id))
            	{{$activity->fellowScore($fellow->id) ? number_format($activity->fellowScore($fellow->id)->score,2)*10 : "No realizado" }}
            @else
            	<span>No realizado</span>
            @endif
        @else
            <span class="">Sin examen</span>
        @endif
		</span>
	@endif
</li>
