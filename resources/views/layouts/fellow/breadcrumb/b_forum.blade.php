<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="forum list")
	<li>Foros</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="forum view" || $__env->yieldContent('breadcrumb_type') =="forum add" )
	<li><a href="{{url('tablero/foros')}}">Foros</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="forum view")
	<li>Ver Foro</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="forum add")
	<li>Agregar Foro</li>
	@endif
	

</ul>