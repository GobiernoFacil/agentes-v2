<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="aspirantes list")
	<li>Lista de Aspirantes</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="aspirantes ver")
	<li><a href="{{url('dashboard/aspirantes')}}">Lista de Aspirantes</a></li>
	<li>Ver Aspirante</li>
	@endif
</ul>