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
			@if($fellow->module_average($module->id))
				{{$fellow->module_average($module->id)->average ? number_format($fellow->module_average($module->id)->average,2)*10 : 'En revisión'}}
			@else
				Sin calificación
			@endif
		</span>
		<a href='{{ url("dashboard/fellows/programa/$program->id/ver-calificaciones/$module->id/$fellow->id") }}' class="btn xs view">Ver módulo</a>
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
