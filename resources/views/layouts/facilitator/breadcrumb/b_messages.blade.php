<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero-facilitador')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="messages list")
	<li>Mensajes</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="message view" || $__env->yieldContent('breadcrumb_type') =="message add")
	<li><a href="{{url('tablero-facilitador/mensajes')}}">Mensajes</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="message view")
	<li>Ver Mensaje</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="message add")
	<li>Enviar Mensaje</li>
	@endif
</ul>