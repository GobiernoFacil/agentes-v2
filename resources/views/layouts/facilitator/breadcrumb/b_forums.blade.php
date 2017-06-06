<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero-facilitador')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="forums list")
	<li>Foros</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="forum view" || $__env->yieldContent('breadcrumb_type') =="question view")
	<li><a href="{{url('tablero-facilitador/foros')}}">Foros</a></li>
	<li>{{$forum->topic}}</li>
	@endif

</ul>