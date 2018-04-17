<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero')}}">Programa</a></li>
	

	@if ($__env->yieldContent('breadcrumb_type') =="module view")
	<!--ver módulo.-->
	<li>{{$module->title}}</li>
	@endif


	@if ($__env->yieldContent('breadcrumb_type') =="session view" || $__env->yieldContent('breadcrumb_type') =="activity view")
	<!--ver módulo.-->
	<li><a href="{{ url('tablero/'.$session->module->program->slug.'/aprendizaje/' .$session->module->slug ) }}">{{$session->module->title}}</a></li>
	@endif

	@if ($__env->yieldContent('breadcrumb_type') =="session view" )
	<!--ver sessión.-->
	<li>Sesión {{$session->order . ': ' . $session->name}}</li>
	@endif

	@if ($__env->yieldContent('breadcrumb_type') =="activity view" )
	<!--ver sessión.-->
	<li><a href="{{ url('tablero/'.$session->module->program->slug.'/aprendizaje/' .$session->module->slug .'/' . $session->slug ) }}">Sesión {{$session->order . ': ' . $session->name}}</a></li>
	<li>Actividad: {{$activity->name}}</li>
	@endif

	@if ($__env->yieldContent('breadcrumb_type') =="evaluation list" )
	<li>Lista de Evaluaciones - Ensayos</li>
	@endif

	@if ($__env->yieldContent('breadcrumb_type') =="module test" )
	<!--ver módulo.-->
	<li><a href="{{ url('tablero/'.$activity->session->module->program->slug.'/aprendizaje/' .$activity->session->module->slug ) }}">{{$activity->session->module->title}}</a></li>
	<!--ver sessión.-->
	<li><a href="{{ url('tablero/'.$activity->session->module->program->slug.'/aprendizaje/' .$activity->session->module->slug .'/' . $activity->session->slug ) }}">Sesión {{$activity->session->order . ': ' . $activity->session->name}}</a></li>
	<li><a href="{{ url('tablero/'.$activity->session->module->program->slug.'/aprendizaje/' .$activity->session->module->slug .'/' . $activity->session->slug . '/' . $activity->id) }}">Actividad: {{$activity->name}}</a></li>
	<!--ver test.-->
	<li>Evaluar</li>
	@endif
</ul>
