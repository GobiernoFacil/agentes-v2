<ul>
	<li>Estás en:</li>
	<li><a href="{{url('')}}">Inicio</a></li>
	@if ($__env->yieldContent('body_class') =="convocatoria")
	<li>Convocatoria</li>
	@endif
	@if ($__env->yieldContent('body_class') =="convocatoria proceso" || $__env->yieldContent('body_class') =="convocatoria aplicar" || $__env->yieldContent('body_class') =="convocatoria finalizar")
	<li><a href="{{url('convocatoria')}}">Convocatoria</a></li>
	@endif
	@if ($__env->yieldContent('body_class') =="convocatoria proceso")
	<li>Proceso de Selección</li>
	@endif
	@if ($__env->yieldContent('body_class') =="convocatoria aplicar")
	<li>Aplica a la convocatoria</li>
	@endif
	@if ($__env->yieldContent('body_class') =="convocatoria finalizar")
	<li>Registro terminado</li>
	@endif
</ul>