<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="evaluation list")
	<li>Evaluaciones</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="evaluation activity view" || $__env->yieldContent('breadcrumb_type') =="evaluation single view" ||  $__env->yieldContent('breadcrumb_type') == "evaluation file")
	<li><a href="{{url('dashboard/evaluacion')}}">Evaluaciones</a></li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="evaluation activity view")
	<li>{{$activity->name}}</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="evaluation single view")
	<li>{{!empty($score->quizInfo->title) ? $score->quizInfo->title : 'Ver calificación'}}</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="evaluation file")
	<li>Evaluación de archivos</li>
	@endif
</ul>