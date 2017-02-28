<ul>
	<li>Estás en:</li>
	<li><a href="{{url('')}}">Inicio</a></li>
	@if ($__env->yieldContent('body_class') =="convocatoria")
	<li>Convocatoria</li>
	@endif
	@if ($__env->yieldContent('body_class') =="convocatoria proceso")
	<li><a href="{{url('convocatoria')}}">Convocatoria</a></li>
	<li>Proceso de Selección</li>
	@endif
	@if ($__env->yieldContent('body_class') =="convocatoria aplicar")
	<li><a href="{{url('convocatoria')}}">Convocatoria</a></li>
	<li>Aplica a la convocatoria</li>
	@endif
</ul>