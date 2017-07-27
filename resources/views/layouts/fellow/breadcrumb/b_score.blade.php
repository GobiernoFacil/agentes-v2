<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="score list")
	<li>Calificaciones</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="score diagnostic" || $__env->yieldContent('breadcrumb_type') =="score file")
	<li><a href="{{url('tablero/calificaciones')}}">Calificaciones</a></li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="score diagnostic")
	<li>Examen diagnóstico</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="score file")
		<li>
		@if(!empty($score))
		{{$score->activity->title}}
		@else
		Evaluación de ensayo
		@endif
		</li>
	@endif
</ul>