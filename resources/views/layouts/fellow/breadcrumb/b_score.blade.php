<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="score list")
	<li>Calificaciones</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="score diagnostic")
	<li><a href="{{url('tablero/calificaciones')}}">Calificaciones</a></li>
	<li>Examen diagnóstico</li>
	@endif
	
</ul>