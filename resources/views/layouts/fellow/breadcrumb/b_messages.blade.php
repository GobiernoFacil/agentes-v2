<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="messages list")
	<li>Mensajes</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="message view" || $__env->yieldContent('breadcrumb_type') =="message add")
	<li><a href="{{url('tablero/mensajes')}}">Mensajes</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="message view")
	<li>Ver Conversación con {{$conversation->user_to->name}}</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="message add")
	<li>Enviar Mensaje</li>
	@endif

</ul>