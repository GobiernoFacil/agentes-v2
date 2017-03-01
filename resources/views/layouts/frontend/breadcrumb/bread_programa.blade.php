<ul>
	<li>Estás en:</li>
	<li><a href="{{url('')}}">Inicio</a></li>
	@if ($__env->yieldContent('body_class') =="programa")
	<li>Programa de Gobierno Abierto</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa aliados" || $__env->yieldContent('body_class') =="programa alcance" || $__env->yieldContent('body_class') =="programa alcance chihuahua" || $__env->yieldContent('body_class') =="programa alcance sonora"
	|| $__env->yieldContent('body_class') =="programa alcance leon" || $__env->yieldContent('body_class') =="programa alcance oaxaca" || $__env->yieldContent('body_class') =="programa alcance morelos")
	<li><a href="{{url('programa-gobierno-abierto')}}">Programa de Gobierno Abierto</a></li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa aliados")
	<li>Aliados</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance")
	<li>Alcance</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance chihuahua" || $__env->yieldContent('body_class') =="programa alcance sonora"
	|| $__env->yieldContent('body_class') =="programa alcance leon" || $__env->yieldContent('body_class') =="programa alcance oaxaca" || $__env->yieldContent('body_class') =="programa alcance morelos")
	<li><a href="{{url('programa-gobierno-abierto/alcance')}}">Alcance</a></li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance chihuahua")
	<li>Chihuahua</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance sonora")
	<li>Sonora</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance leon")
	<li>Nuevo León</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance oaxaca")
	<li>Oaxaca</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance morelos")
	<li>Morelos</li>
	@endif
</ul>