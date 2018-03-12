<div class="left">
	@if($user->type == "admin")
	<a href="{{ url('dashboard/programas/' . $activity->session->module->program->id . '/modulos/ver/' . $activity->session->module->id) }}"><strong>&lt;</strong> Regresar {{ $activity->session->module->title }}</a>
	@else
	<a href=""><strong>&lt;</strong> Regresar {{ $activity->session->module->title }}</a>
	@endif
	<a href="#" id="display-week-menu" class="btn_sessions hide"><b></b> Sesiones</a>
</div>
<div class="right">
	<a href=""><strong>&lt;</strong> Anterior</a>
	<a href="">Siguiente <strong>&gt;</strong></a>
</div>