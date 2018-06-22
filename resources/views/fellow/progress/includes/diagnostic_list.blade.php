<div class="row">
	<!--activity name--->
	<div class="col-sm-6 activity">
       <p><a href ='{{url("tablero/{$activity->session->module->program->slug}/aprendizaje/{$activity->session->module->slug}/{$activity->session->slug}/{$activity->slug}")}}' class="ap_link_module">{{$activity->name}}</a></p>
  </div>
	<!--evaluation type--->

    	<div class="col-sm-4">
	    	<p>
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
	    	</p>
        </div>

		<div class="col-sm-2">
			<p>
				@if($user->check_diagnostic($activity->id))
				<span class="ap_success">Completado</span>
				@else
				<span class="ap_error">No realizado</span>
				@endif
			</p>
		 </div>
</div>
