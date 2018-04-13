<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="programs list")
	<li>Programas</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="messages list")
	<li><a href="{{url('dashboard/mensajes')}}">Programas</a></li>
	<li>{{$program->title}}</li>
	<li>Mensajes</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="message view" || $__env->yieldContent('breadcrumb_type') =="message add"  || $__env->yieldContent('breadcrumb_type') =="message send" || $__env->yieldContent('breadcrumb_type') =="messages storaged list" )
	<li><a href="{{url('dashboard/mensajes')}}">Programas</a></li>
	<li>{{$program->title}}</li>
	<li><a href="{{url('dashboard/mensajes/programa/'.$program->id.'/ver-mensajes')}}">Mensajes</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="messages storaged list")
	<li>Mensajes archivados</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="message view")
	<li>Conversación con {{$conversation->user_to->name}}</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="message add")
	<li>Enviar Mensaje</li>
	@endif

	@if ( $__env->yieldContent('breadcrumb_type') =="message send")
	<li><a href='{{ url("dashboard/mensajes/programa/$program->id/ver-mensajes/".$conversation->id)}}'>Conversación con {{$conversation->user_to->name}}</a></li>
	<li>Enviar Mensaje</li>
	@endif

</ul>
