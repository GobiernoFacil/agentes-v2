<div class="box session_list last_activity">
	<div class="row">
		<!--icono-->
		<div class="col-sm-2">
			<h3>Semana 1</h3>
		</div>
		<!--título-->
		<div class="col-sm-7">
			<h2><a href='{{url("tablero/aprendizaje/$module_last->slug")}}'>{{$module_last->title}}</a></h2>
			 <p>Duración: {{$module_last->number_hours}} hora </p>
		</div>
		<!-- ir a actividad-->
		<div class="col-sm-3">
		 <a class="btn view block sessions_l" href='{{url("tablero/aprendizaje/$module_last->slug")}}'>Continuar última actividad</a>
		</div>	
	</div>
</div>