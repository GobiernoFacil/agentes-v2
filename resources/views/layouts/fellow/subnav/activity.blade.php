<div class="left">
	@if($user->type == "admin")
	<a href="{{ url('dashboard/programas/' . $activity->session->module->program->id . '/modulos/ver/' . $activity->session->module->id) }}"><strong>&lt;</strong> Regresar {{ $activity->session->module->title }}</a>
	@else
	<a href=""><strong>&lt;</strong> Regresar {{ $activity->session->module->title }}</a>
	@endif
	<a href="#" id="display-week-menu" class="btn_sessions hide"><b></b> Sesiones</a>
</div>
@if($user->type == "admin")
	<div class="right">
		<a {{$prev ? 'href='.url("dashboard/sesiones/actividades/ver/$prev") : ''}}><strong>&lt;</strong> Anterior</a>
		<a {{$next ? 'href='.url("dashboard/sesiones/actividades/ver/$next") : ''}}>Siguiente <strong>&gt;</strong></a>
	</div>
@else
	<div class="right">
		<a href=""><strong>&lt;</strong> Anterior</a>
		<a href="">Siguiente <strong>&gt;</strong></a>
	</div>

@endif
