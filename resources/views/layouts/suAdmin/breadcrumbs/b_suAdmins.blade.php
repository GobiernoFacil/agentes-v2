<ul>
	<li>Estás en:</li>
	<li><a href="{{url('sa/dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="users sua list")
	<li>Super Administradores</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="users sua view" || $__env->yieldContent('breadcrumb_type') =="users sua edit" || $__env->yieldContent('breadcrumb_type') =="users sua add")
	<li><a href="{{ url('sa/dashboard/super-administradores') }}">Super Adminsitradores</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="users sua view")
	<li>Ver super administrador</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="users sua edit")
	<li>Editar super administrador</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="users sua add")
	<li>Agregar super administrador</li>
	@endif

</ul>