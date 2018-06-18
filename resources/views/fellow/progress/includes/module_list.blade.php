<!--título del módulo-->
<div class="col-sm-9">
	<h4>Módulo</h4>
	<h2 class ="title">{{$module->title}}</h2>
</div>
<!--calificación del módulo-->
<div class="col-sm-3 right">
	<p>Estatus:
		<span class="score_a block">
			{{$user->complete_module($module->id) && $user->check_progress($module->slug,0) ? "Completado" : 'Sin completar'}}
		</span>
		<a href='{{ url("tablero/$program->slug/progreso/{$module->slug}") }}' class="btn xs view">Ver módulo</a>
	</p>
</div>


<!--divider-->
<div class="col-sm-12">
	<div class="divider"></div>
</div>
