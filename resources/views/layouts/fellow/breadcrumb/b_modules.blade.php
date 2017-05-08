<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="module list")
	<li>Módulos de aprendizaje</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="module view")
	<li><a href="{{url('tablero/aprendizaje')}}">Módulos de aprendizaje</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="module view")
	<li>Ver Módulo</li>
	@endif

</ul>