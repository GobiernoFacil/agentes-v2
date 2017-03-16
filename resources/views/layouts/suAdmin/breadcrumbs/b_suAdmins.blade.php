<ul>
	<li>Estás en:</li>
	<li><a href="{{url('sa/dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="users sua list")
	<li>Lista de usuarios</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="users sua view" || $__env->yieldContent('breadcrumb_type') =="users sua edit" || $__env->yieldContent('breadcrumb_type') =="users sua add")
	<li><a href="{{ url('sa/dashboard/administradores') }}">Lista de usuarios</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="users sua view")
	<li>Ver usuario</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="users sua edit")
	<li>Editar usuario</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="users sua add")
	<li>Agregar usuario</li>
	@endif

</ul>