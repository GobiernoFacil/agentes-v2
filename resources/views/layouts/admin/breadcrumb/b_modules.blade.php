<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="module list")
	<li>Módulos</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="module add")
	<li><a href="{{url('dashboard/modulos')}}">Módulos</a></li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="module add")
	<li>Agregar módulo</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="module view")
	<li>Ver módulo</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="module edit")
	<li><a href="{{url('dashboard/modulo')}}">Ver módulo</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="module edit")
	<li>Editar módulo</li>
	@endif

</ul>