<ul>
	<li>Estás en:</li>
	<li><a href="{{url('')}}">Inicio</a></li>
	@if ($__env->yieldContent('body_class') =="convocatoria")
	<li>Convocatoria</li>
	@endif
	@if ($__env->yieldContent('body_class') =="convocatoria closed")
		<li><a href="{{url('convocatoria')}}">Convocatoria</a></li>
		<li>Convocatoria cerrada</li>
	@endif
	@if ($__env->yieldContent('body_class') =="convocatoria proceso" || $__env->yieldContent('body_class') =="convocatoria aplicar" || $__env->yieldContent('body_class') =="convocatoria finalizar" || $__env->yieldContent('body_class') =="convocatoria resultado17" || $__env->yieldContent('body_class') =="convocatoria metodologia" || $__env->yieldContent('body_class') =="convocatoria 2017" || $__env->yieldContent('body_class') =="convocatoria faqs" )
	<li><a href="{{url('convocatoria')}}">Convocatoria</a></li>
	@endif
	@if ($__env->yieldContent('body_class') =="convocatoria 2017")
	<li>2017</li>
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
	@if ($__env->yieldContent('body_class') =="convocatoria resultado17")
	<li>Resultados 2017</li>
	@endif
	@if ($__env->yieldContent('body_class') =="convocatoria metodologia")
	<li><a href="{{url('convocatoria/resultados-2017')}}">Resultados 2017</a></li>
	<li>Metodología</li>
	@endif
	@if ($__env->yieldContent('body_class') =="convocatoria faqs")
	<li>Preguntas Frecuentes</li>
	@endif
</ul>
