<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero-facilitador')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="activities list")
	<li>Lista de actividades</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="activity view" || $__env->yieldContent('breadcrumb_type') =="session view")
	<li><a href="{{url('tablero-facilitador/actividades')}}">Lista de actividades</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="activity view")
	<li><a href="{{url('tablero-facilitador/actividades/sesion/' . $session->id)}}">{{$session->name}}</a></li>
	<li>{{$activity->name}}</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="session view")
	<li>{{$session->name}}</li>
	@endif

</ul>