<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="profile view")
	<li>Ver perfil</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="profile edit")
	<li><a href="{{url('tablero/perfil')}}">Ver perfil</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="profile edit")
	<li>Editar Perfil</li>
	@endif

</ul>