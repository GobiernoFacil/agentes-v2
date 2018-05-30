<div class="box session_list last_activity">
	<div class="row">
		<!--icono-->
		<div class="col-sm-2">
			<h3>Semana:</h3>
		</div>
		<!--título-->
		<div class="col-sm-7">
			<h2><a href='{{url("tablero/{$program->slug}/aprendizaje/$module_last->slug")}}'>{{$module_last->title}}</a></h2>
			 <p>Duración: {{$module_last->duration_hours() < 1 ? str_replace(".00", "", (string)number_format($module_last->duration_minutes(), 2, ".", "")).' min.' : str_replace(".00", "", (string)number_format($module_last->duration_hours(), 2, ".", "")).' h'}}  </p>
		</div>
		<!-- ir a actividad-->
		@if($last_activity)
		<div class="col-sm-3">
		 <a class="btn view block sessions_l" href='{{url("tablero/{$program->slug}/aprendizaje/$module_last->slug/{$last_activity->activity->session->slug}/{$last_activity->activity->slug}")}}'>Continuar última actividad</a>
		</div>
		@else
		<div class="col-sm-3">
		 <a class="btn view block sessions_l" href='{{url("tablero/{$program->slug}/aprendizaje/$module_last->slug")}}'>Ver</a>
		</div>
		@endif
	</div>
</div>
