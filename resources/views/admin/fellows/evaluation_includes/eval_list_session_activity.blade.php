<li class="row">
	<!--activity name--->
	<span class="col-sm-6 activity">
		@if($activity->files === 'Sí')
			<!--si hay archivos-->
            @if($fellow->fileFellowScore($fellow->id,$activity->id))
				<a href='{{url("dashboard/evaluacion/actividad/archivos/resultados/ver/{$fellow->fileFellowScore($fellow->id,$activity->id)->id}")}}'><strong>{{$activity->name}}</strong></a>
			@else
            	<strong>{{$activity->name}}</strong>
            @endif
		@else
            @if($activity->slug==='examen-diagnostico')
            	<!--si es diagnóstico-->
                @if($fellow->diagnostic)
                    <a href='{{url("dashboard/evaluacion/diagnostico/ver/{$fellow->diagnostic->id}")}}'><strong>{{$activity->name}}</strong></a>
				@else
                    <strong>{{$activity->name}}</strong>
                @endif
			@else
				<!--si es quiz-->
                @if($activity->quizInfo)
                    @if($activity->fellowScore($activity->quizInfo->id,$fellow->id))
                    	<!-- si hay calificación-->
                        <a href='{{url("dashboard/evaluacion/actividad/resultados/ver/{$activity->fellowScore($activity->quizInfo->id,$fellow->id)->id}")}}'><strong>{{$activity->name}}</strong></a>
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
        @if($fellow->fileFellowScore($fellow->id,$activity->id))
        	<!--si fue evaluado-->
			<a href='{{url("dashboard/evaluacion/actividad/archivos/resultados/ver/{$fellow->fileFellowScore($fellow->id,$activity->id)->id}")}}' class="link_a">Revisión de productos</a>
        @else
            Revisión de productos
        @endif
        </span>
        <span class="col-sm-3 right">
    		{{$fellow->fileFellowScore($fellow->id,$activity->id) ? number_format($fellow->fileFellowScore($fellow->id,$activity->id)->score,2) : "Sin calificación" }}
        </span>
    @else
    	<span class="col-sm-3">
        @if($activity->quizInfo)
        	<!--si es evaluación-->
            @if($activity->fellowScore($activity->quizInfo->id,$fellow->id))
            	<!--si tiene calificación-->
            	<a href='{{url("dashboard/evaluacion/actividad/resultados/ver/{$activity->fellowScore($activity->quizInfo->id,$fellow->id)->id}")}}' class="link_a">Examen en línea</a>
	        @else
                Examen en línea
            @endif
        @else
            Examen en línea
        @endif
        </span>
        <span class="col-sm-3 right">
        @if($activity->quizInfo)
            @if($activity->fellowScore($activity->quizInfo->id,$fellow->id))
            	{{$activity->fellowScore($activity->quizInfo->id,$fellow->id) ? number_format($activity->fellowScore($activity->quizInfo->id,$fellow->id)->score,2) : "Sin calificación" }}
            @else
            	<span>Sin calificación</span>
            @endif
        @else
            <span class="">Sin examen</span>
        @endif
		</span>
	@endif
</li>