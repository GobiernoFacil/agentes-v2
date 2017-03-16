<ul>
	<li>Estás en:</li>
	<li><a href="{{url('sa/dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="profile")
	<li>Tu perfil</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="profile edit")
	<li><a href="{{ url('sa/dashboard/perfil') }}">Tu perfil</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="profile edit")
	<li>Editar perfil</li>
	@endif
</ul>