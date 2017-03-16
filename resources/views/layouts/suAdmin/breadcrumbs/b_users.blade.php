<ul>
	<li>Estás en:</li>
	<li><a href="{{url('sa/dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="users list")
	<li>Administradores</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="users view" || $__env->yieldContent('breadcrumb_type') =="users edit" || $__env->yieldContent('breadcrumb_type') =="users add")
	<li><a href="{{ url('sa/dashboard/administradores') }}">Administradores</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="users view")
	<li>Ver administrador</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="users edit")
	<li>Editar administrador</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="users add")
	<li>Agregar administrador</li>
	@endif

</ul>