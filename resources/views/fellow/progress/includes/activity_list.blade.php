<div class="row">
	<!--activity name--->
	<div class="col-sm-6">
      <p><strong>{{$activity->name}}</strong></p>
  	</div>
	<!--evaluation type--->
	@if($activity->files)
		<div class="col-sm-4">  
			<p>Revisión de productos</p>
		</div>
		<div class="col-sm-2">
    		<p>
	    		@if($user->fellowFiles()->where('activity_id',$activity->id)->where('user_id',$user->id)->first())
	    		<span class="ap_success">Completado</span>
	    		@else
	    		<span class="ap_error">No realizado</span>
	    		@endif
	    	</p>
		</div>
    @else
    	<div class="col-sm-4">
	    	<p>
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
	    	</p>
        </div>
        <div class="col-sm-2">
	        <p>
			@if($activity->quizInfo)
			    @if($activity->fellowScore($user->id))
			    	<span class="ap_success">Completado</span>
			    @else
			    	<span class="ap_error">No realizado</span>
			    @endif
			@else
			    <span class="ap_noaplica">Sin examen</span>
			@endif
	        </p>
		</div>
	@endif
	@if($r > $f)
	<div class="col-sm-12">
		<div class="divider nm"></div>
	</div>
	@endif
</div>