<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero-facilitador')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="activities list")
	<li>Lista de actividades</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="activity view")
	<li><a href="{{url('tablero-facilitador/actividades')}}">Lista de actividades</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="activity view")
	<li>Ver Actividad</li>
	@endif

</ul>