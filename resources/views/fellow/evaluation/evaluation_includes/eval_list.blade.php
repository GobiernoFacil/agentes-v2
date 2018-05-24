<!--título del módulo-->
<div class="col-sm-9">
	<h4>Módulo {{$n}}</h4>
	<h2 class ="title">{{$module->title}}</h2>
</div>
<!--calificación del módulo-->
<div class="col-sm-3 right">
	<p>Calificación del módulo:
		<span class="score_a block">
			{{$user->module_average($user->id,$module->id) ? $user->module_average($user->id,$module->id)->type !='sin' ? number_format($user->module_average($user->id,$module->id)->average,2) : 'No aplica'  : 'Sin calificación'}}
		</span>
		<a href='{{ url("tablero/$program->slug/calificaciones/{$module->slug}") }}' class="btn xs view">Ver módulo</a>
<?php
/*
		@if(!$module->check_last_activity($module->id))
		<strong>No se toma en consideración</strong>
		@endif
*/
?>
	</p>
</div>


<!--divider-->
<div class="col-sm-12">
	<div class="divider"></div>
</div>
