<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="add questions")
	<li><a href="{{url('dashboard/modulos')}}">Módulos</a></li>
	<li><a href="{{url('dashboard/modulos/ver/' . $activity->session->module->id)}}">{{$activity->session->module->title}}</a></li>
	<li><a href="{{url('dashboard/sesiones/ver/' . $activity->session->id)}}">Sesión {{$activity->session->order}}</a></li>
	<li><a href="{{url('dashboard/sesiones/actividades/ver/' . $activity->id)}}">{{$activity->name}}</a></li>
	<li>Agregar preguntas</li>
	@endif


</ul>