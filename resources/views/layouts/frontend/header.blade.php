<div class="row">
	<div class="col-sm-6">
		@if ( $__env->yieldContent('body_class') == 'home')
		<h1 class="apertus">Gobierno Abierto desde lo local para el desarrollo sostenible</h1>
		@else
		<a class="apertus" href="{{url('')}}" title="Regresar a inicio">Gobierno Abierto desde lo local para el desarrollo sostenible</a>
		@endif
	</div>
</div>
<nav class="cd-stretchy-nav">
	<a class="cd-nav-trigger" href="#0">
		Menú
		<span aria-hidden="true"></span>
	</a>
 
	<ul>
		<li><a href="{{url('')}}" class="btn_home {{ $__env->yieldContent('body_class') == 'home' ? 'active' : ''}}"><span>Inicio</span></a></li>
		<li><a href="{{url('programa-gobierno-abierto')}}" class="{{ $__env->yieldContent('body_class') == 'programa' ? 'active' : ''}}"><span>Programa</span></a></li>
		<li><a href="{{url('convocatoria')}}" class="btn_convocatoria {{ $__env->yieldContent('body_class') == 'convocatoria' ? 'active' : ''}}"><span>Convocatoria</span></a></li>
		<li><a href="{{url('gobierno-abierto')}}" class="btn_abierto {{ $__env->yieldContent('body_class') == 'abierto' ? 'active' : ''}}"><span>Gobierno Abierto</span></a></li>
		<li><a href="{{url('contacto')}}" class="btn_contacto {{ $__env->yieldContent('body_class') == 'contacto' ? 'active' : ''}}"><span>Contacto</span></a></li>
	</ul>
 
	<span aria-hidden="true" class="stretchy-nav-bg"></span>
</nav>