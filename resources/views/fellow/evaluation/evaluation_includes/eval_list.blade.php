<!--título del módulo-->
<div class="col-sm-9">
	<h4>Módulo</h4>
	<h2 class ="title">{{$module->title}}</h2>
</div>
<!--calificación del módulo-->
<div class="col-sm-3 right">
	<p>Calificación del módulo:
		@if($module->get_all_activities_with_forums()->count() > 0 || $module->get_evaluation_activity_kardex()->count() > 0)
		<span class="score_a block">
			{{$user->module_average($module->id) ? number_format($user->module_average($module->id)->average,2)*10 : 'Sin calificación'}}
		</span>
		<a href='{{ url("tablero/$program->slug/calificaciones/{$module->slug}") }}' class="btn xs view">Ver módulo</a>
		@else
		<span class="score_a block">
			<strong>No aplica</strong>
		</span>
		@endif

	</p>
</div>


<!--divider-->
<div class="col-sm-12">
	<div class="divider"></div>
</div>
