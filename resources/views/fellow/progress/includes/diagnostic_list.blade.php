<li class="row">
	<!--activity name--->
	<span class="col-sm-6 activity">
      <strong>{{$activity->name}}</strong>
  </span>
	<!--evaluation type--->

    	<span class="col-sm-3">
        @if($activity->diagnostic_info)
        	<!--si es evaluación-->
            @if($user->check_diagnostic($activity->id))
            	<!--si tiene calificación-->
            	Cuestionario en línea
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
						 {{$user->check_diagnostic($activity->id) ? "Completado" : "No realizado" }}
		 </span>
</li>
