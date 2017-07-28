<li class="row">
	<!--activity name--->
	<span class="col-sm-6 activity">
		@if($activity->files === 'Sí')
			<!--si hay archivos-->
            @if($user->fileFellowScore($user->id,$activity->id))
				<a href="{{url('tablero/calificaciones/archivos/ver/' . $activity->slug)}}"><strong>{{$activity->name}}</strong></a>
			@else
            	<strong>{{$activity->name}}</strong>
            @endif
		@else
            @if($activity->slug==='examen-diagnostico')
            	<!--si es diagnóstico-->
                @if($user->diagnostic)
                    <a href="{{url('tablero/calificaciones/ver/' . $activity->slug)}}"><strong>{{$activity->name}}</strong></a>
				@else
                    <strong>{{$activity->name}}</strong>
                @endif
			@else
				<!--si es quiz-->
                @if($activity->quizInfo)
                    @if($activity->fellowScore($activity->quizInfo->id,$user->id))
                    	<!-- si hay calificación-->
                        <a href="{{url('tablero/calificaciones/ver/' . $activity->slug)}}"><strong>{{$activity->name}}</strong></a>
                    @else
                        <strong>{{$activity->name}}</strong>
                    @endif
                @else
                    <strong>{{$activity->name}}</strong>
                @endif
            @endif
        @endif
    </span>
	<!--evaluation type--->
	@if($activity->files === 'Sí')
		<span class="col-sm-3">
		<!--si tiene archivos-->
        @if($user->fileFellowScore($user->id,$activity->id))
        	<!--si fue evaluado-->
			<a href="{{url('tablero/calificaciones/archivos/ver/' . $activity->slug)}}" class="link_a">Revisión de productos</a>
        @else
            Revisión de productos
        @endif
        </span>
        <span class="col-sm-3 right">
    		{{$user->fileFellowScore($user->id,$activity->id) ? number_format($user->fileFellowScore($user->id,$activity->id)->score,2) : "Sin calificación" }}
        </span>
    @else
    	<span class="col-sm-3">
        @if($activity->quizInfo)
        	<!--si es evaluación-->
            @if($activity->fellowScore($activity->quizInfo->id,$user->id))
            	<!--si tiene calificación-->
            	<a href="{{url('tablero/calificaciones/ver/' . $activity->slug)}}" class="link_a">Examen en línea</a>
	        @else
                Examen en línea
            @endif
        @else
            Examen en línea
        @endif
        </span>
        <span class="col-sm-3 right">
        @if($activity->quizInfo)
            @if($activity->fellowScore($activity->quizInfo->id,$user->id))
            	{{$activity->fellowScore($activity->quizInfo->id,$user->id) ? number_format($activity->fellowScore($activity->quizInfo->id,$user->id)->score,2) : "No realizado" }}
            @else
            	<span>No realizado</span>
            @endif
        @else
            <span class="">Sin examen</span>
        @endif
		</span>
	@endif
</li>
