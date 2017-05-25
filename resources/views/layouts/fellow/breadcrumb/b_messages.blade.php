<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="messages list")
	<li>Mensajes</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="message view" || $__env->yieldContent('breadcrumb_type') =="message add"  || $__env->yieldContent('breadcrumb_type') =="message send")
	<li><a href="{{url('tablero/mensajes')}}">Mensajes</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="message view")
	<li>Conversación con {{$conversation->user_to->name}}</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="message add")
	<li>Enviar Mensaje</li>
	@endif
	
	@if ( $__env->yieldContent('breadcrumb_type') =="message send")
	<li><a href="{{ url('tablero/mensajes/ver/' . $conversation->id)}}">Conversación con {{$conversation->user_to->name}}</a></li>
	<li>Enviar Mensaje</li>
	@endif

</ul>