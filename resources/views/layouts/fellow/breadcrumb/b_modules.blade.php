<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="module list")
	<li>Módulos de aprendizaje</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="module view" || $__env->yieldContent('breadcrumb_type') =="session view" || $__env->yieldContent('breadcrumb_type') =="activity view")
	<li><a href="{{url('tablero/aprendizaje')}}">Módulos de aprendizaje</a></li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="module view")
	<!--ver módulo.-->
	<li>{{$module->title}}</li>
	@endif
	
	
	@if ($__env->yieldContent('breadcrumb_type') =="session view" || $__env->yieldContent('breadcrumb_type') =="activity view")
	<!--ver módulo.-->
	<li><a href="{{ url('tablero/aprendizaje/' .$session->module->slug ) }}">{{$session->module->title}}</a></li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="session view" )
	<!--ver sessión.-->
	<li>Sesión {{$session->order . ': ' . $session->name}}</li>
	@endif

	@if ($__env->yieldContent('breadcrumb_type') =="activity view" )
	<!--ver sessión.-->
	<li><a href="{{ url('tablero/aprendizaje/' .$session->module->slug .'/' . $session->slug ) }}">Sesión {{$session->order . ': ' . $session->name}}</a></li>
	<li>Actividad: {{$activity->name}}</li>
	@endif
	
</ul>