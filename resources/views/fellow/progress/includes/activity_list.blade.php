<li class="row">
	<!--activity name--->
	<span class="col-sm-6 activity">
      <strong>{{$activity->name}}</strong>
  </span>
	<!--evaluation type--->
	@if($activity->files)
		<span class="col-sm-3">  Revisión de productos</span>
    <span class="col-sm-3 right">
    			{{$user->fellowFiles()->where('activity_id',$activity->id)->where('user_id',$user->id)->first() ? "Completado" : "No realizado" }}
    </span>
    @else
    	<span class="col-sm-3">
        @if($activity->quizInfo)
        	<!--si es evaluación-->
            @if($activity->fellowScore($user->id))
            	<!--si tiene calificación-->
            	Examen en línea
	        @else
                Examen en línea
            @endif
        @else
            Examen en línea
        @endif
        </span>
        <span class="col-sm-3 right">
        @if($activity->quizInfo)
            @if($activity->fellowScore($user->id))
            	{{$activity->fellowScore($user->id) ? "Completado" : "No realizado" }}
            @else
            	<span>No realizado</span>
            @endif
        @else
            <span class="">Sin examen</span>
        @endif
		</span>
	@endif
</li>
