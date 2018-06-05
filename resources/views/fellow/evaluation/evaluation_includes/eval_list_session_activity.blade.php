<li class="row">
	<!--activity name--->
	<span class="col-sm-6 activity">
		@if($activity->files)
			<!--si hay archivos-->
      @if($user->fileFellowScore($activity->id))
				<a href='{{url("tablero/$program->slug/calificaciones/archivos/ver/$activity->slug")}}'><strong>{{$activity->name}}</strong></a>
			@else
        <strong>{{$activity->name}}</strong>
      @endif

		@else
				<!--si es quiz-->
        @if($activity->quizInfo)
            @if($activity->fellowScore($activity->quizInfo->id,$user->id))
                <!-- si hay calificación-->
                <a href='{{url("tablero/$program->slug/calificaciones/ver/$activity->slug")}}'><strong>{{$activity->name}}</strong></a>
            @else
                <strong>{{$activity->name}}</strong>
            @endif
        @else
            <strong>{{$activity->name}}</strong>
        @endif
    @endif
    </span>
	<!--evaluation type--->
	@if($activity->files)
		<span class="col-sm-3">
		<!--si tiene archivos-->
        @if($user->fileFellowScore($activity->id))
        	<!--si fue evaluado-->
					<a href='{{url("tablero/$program->slug/calificaciones/archivos/ver/$activity->slug")}}' class="link_a">Revisión de productos</a>
        @else
            Revisión de productos
        @endif
        </span>
        <span class="col-sm-3 right">
    			{{$user->fileFellowScore($activity->id) ? number_format($user->fileFellowScore($activity->id)->score,2)*10 : "Sin calificación" }}
        </span>
    @else
    	<span class="col-sm-3">
        @if($activity->quizInfo)
        	<!--si es evaluación-->
            @if($activity->fellowScore($user->id))
            	<!--si tiene calificación-->
            	<a href='{{url("tablero/$program->slug/calificaciones/ver/$activity->slug")}}' class="link_a">Examen en línea</a>
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
            	{{$activity->fellowScore($user->id) ? number_format($activity->fellowScore($user->id)->score,2)*10 : "No realizado" }}
            @else
            	<span>No realizado</span>
            @endif
        @else
            <span class="">Sin examen</span>
        @endif
		</span>
	@endif
</li>
