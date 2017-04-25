<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="facilitadores")
	<li>Lista de Facilitadores</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="facilitadores add" || $__env->yieldContent('breadcrumb_type') =="facilitadores view" || $__env->yieldContent('breadcrumb_type') =="facilitadores edit")
	<li><a href="{{url('dashboard/facilitadores')}}">Lista de Facilitadores</a></li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="facilitadores add")
	<li>Agregar Facilitador</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="facilitadores view")
	<li>Ver Facilitador</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="facilitadores edit")
	<li>Actualizar Facilitador</li>
	@endif
</ul>