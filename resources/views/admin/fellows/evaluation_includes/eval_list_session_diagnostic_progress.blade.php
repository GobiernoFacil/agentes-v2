<li class="row">
	<!--activity name--->
	<span class="col-sm-6 activity">
      <strong>{{$activity->name}}</strong>
  </span>
	<!--evaluation type--->
    	<span class="col-sm-3">
        @if($activity->diagnostic_info)
        	<!--si es evaluación-->
            @if($fellow->check_diagnostic($activity->id))
            	<!--si tiene calificación-->
            	<a href='{{url("dashboard/programas/$program->id/ver-diagnostico/$activity->id/resultados/$fellow->id")}}' class="link_a">Cuestionario en línea</a>
	        @else
                Examen en línea
          @endif
        @else
            Examen en línea
        @endif
        </span>
        <span class="col-sm-3 right">

		</span>
		<span class="col-sm-3 right">
	     			{{$fellow->check_diagnostic($activity->id) ? "Completado" : "No realizado" }}
	   </span>
</li>
