<ul>
	<li>Estás en:</li>
	<li><a href="{{url('')}}">Inicio</a></li>
	@if ($__env->yieldContent('body_class') =="abierto")
	<li>Gobierno Abierto</li>
	@endif
	@if ($__env->yieldContent('body_class') =="abierto lecturas")
	<li><a href="{{url('gobierno-abierto')}}">Gobierno Abierto</a></li>
	<li>Lecturas</li>
	@endif
</ul>