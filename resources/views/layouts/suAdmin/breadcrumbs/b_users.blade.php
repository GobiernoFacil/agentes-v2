<ul>
	<li>Estás en:</li>
	<li><a href="{{url('sa/dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="users list")
	<li>Lista de usuarios</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="users view")
	<li><a href="{{ url('sa/dashboard/administradores') }}">Lista de usuarios</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="users view")
	<li>Ver usuario</li>
	@endif

</ul>