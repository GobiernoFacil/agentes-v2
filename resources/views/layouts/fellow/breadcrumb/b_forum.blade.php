<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="forum list")
	<li>Foros</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="forum view" || $__env->yieldContent('breadcrumb_type') =="forum add message" )
	<li><a href="{{url('tablero/foros')}}">Foros</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="forum view")
	<li>{{$forum->topic}}</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="forum add message")
	<li><a href="{{url('tablero/foros/'. $forum->session->slug . '/' .$forum->slug . '/ver')}}">{{$forum->topic}}</a></li>  
	<li>Agregar mensaje</li>
	@endif
	

</ul>