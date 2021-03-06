<div class="left">
	@if($user->type == "admin")
	<a href="{{ url('dashboard/programas/' . $activity->session->module->program->id . '/modulos/ver/' . $activity->session->module->id) }}"><strong>&lt;</strong> Regresar {{ $activity->session->module->title }}</a>
	@elseif($user->type == "facilitator")
	<a href='{{url("tablero-facilitador/actividades/sesion/{$activity->session->id}")}}'><strong>&lt;</strong> Regresar {{ $activity->session->module->title }}</a>
	@else
		@if(isset($activity))
			<a href='{{url("tablero/{$activity->session->module->program->slug}/aprendizaje/{$activity->session->module->slug}")}}'><strong>&lt;</strong> Regresar {{ $activity->session->module->title }}</a>
		@else
		  <a href='{{url("tablero/{$session->module->program->slug}/aprendizaje/{$session->module->slug}")}}'><strong>&lt;</strong> Regresar {{ $session->module->title }}</a>
		@endif
	@endif
	@if(isset($activity))
		<a href='{{url("tablero/{$activity->session->module->program->slug}/aprendizaje/{$activity->session->module->slug}")}}' id="display-week-menu" class="btn_sessions hide"><b></b> Sesiones</a>
	@else
		<a href='{{url("tablero/{$session->module->program->slug}/aprendizaje/{$session->module->slug}")}}' id="display-week-menu" class="btn_sessions hide"><b></b> Sesiones</a>
	@endif
</div>
@if($user->type == "admin")
	<div class="right">
		<a {{$prev ? 'href='.url("dashboard/sesiones/actividades/ver/$prev") : ''}}><strong>&lt;</strong> Anterior</a>
		<a {{$next ? 'href='.url("dashboard/sesiones/actividades/ver/$next") : ''}}>Siguiente <strong>&gt;</strong></a>
	</div>
@elseif($user->type == "facilitator")
<div class="right">
	<a {{$prev ? 'href='.url("tablero-facilitador/actividades/ver/$prev") : ''}}><strong>&lt;</strong> Anterior</a>
	<a {{$next ? 'href='.url("tablero-facilitador/actividades/ver/$next") : ''}}>Siguiente <strong>&gt;</strong></a>
</div>
@else
	<div class="right">
		@if(isset($activity))
		<a {{$prev ? 'href='.url("tablero/{$activity->session->module->program->slug}/aprendizaje/{$activity->session->module->slug}/{$activity->session->slug}/$prev") : ''}}><strong>&lt;</strong> Anterior</a>
		<a {{$next ? 'href='.url("tablero/{$activity->session->module->program->slug}/aprendizaje/{$activity->session->module->slug}/{$activity->session->slug}/$next") : 'href='.url("tablero/{$activity->session->module->program->slug}/aprendizaje/{$activity->session->module->slug}/{$activity->session->slug}/fin-modulo/ver")}}>Siguiente <strong>&gt;</strong></a>
		@else
		<a {{$prev ? 'href='.url("tablero/{$session->module->program->slug}/aprendizaje/{$session->module->slug}/{$session->slug}/$prev") : ''}}><strong>&lt;</strong> Anterior</a>	
		@endif
	</div>

@endif
