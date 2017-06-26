<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="view questions")
	<li><a href="{{url('tablero/aprendizaje')}}">Módulos de aprendizaje</a></li>
	<li><a href="{{url('tablero/aprendizaje/'. $activity->session->module->slug)}}">{{$activity->session->module->title}}</a></li>
	<li><a href="{{url('tablero/aprendizaje/'. $activity->session->module->slug .'/'. $activity->session->slug)}}">Sesión {{$activity->session->order}}</a></li>
	<li><a href="{{url('tablero/aprendizaje/'. $activity->session->module->slug .'/'. $activity->session->slug .'/'. $activity->id)}}">{{$activity->name}}</a></li>
	<li>Responder Evaluación</li>
	@endif

	
</ul>