<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="aspirantes list")
	<li>Lista de Aspirantes</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="aspirantes ver" || $__env->yieldContent('breadcrumb_type') =="aspirantes evaluar")
	<li><a href="{{url('dashboard/aspirantes')}}">Lista de Aspirantes</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="aspirantes ver")
	<li>Ver Aspirante</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="aspirantes evaluar")
	<li>Evaluar Aspirante</li>
	@endif
</ul>