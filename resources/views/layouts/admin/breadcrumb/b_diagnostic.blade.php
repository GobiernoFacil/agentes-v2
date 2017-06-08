<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="diagnostic list")
	<li>Lista de Fellows</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') == "diagnostic view" || $__env->yieldContent('breadcrumb_type') == "diagnostic evaluation 1")
	<li><a href="{{url('dashboard/evaluacion/diagnostico')}}">Lista de Fellows</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="diagnostic view")
	<li>Respuestas de examen de diagnóstico</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="diagnostic evaluation 1")
	<li>Evaluación de examen de diagnóstico (1/2)</li>
	@endif
</ul>