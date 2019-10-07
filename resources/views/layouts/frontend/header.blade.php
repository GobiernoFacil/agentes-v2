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
		<li><a href="{{url('programa-gobierno-abierto/programa-2018/ver-contenido')}}" class="btn_contenido {{ $__env->yieldContent('body_class') == 'program_content' ? 'active' : ''}}"><span>Programa de Formación</span></a></li>
		<li><a href="{{url('proyectos')}}" class="{{ $__env->yieldContent('body_class') == 'projects' ? 'active' : ''}}"><span>Proyectos</span></a></li>
		<li><a href="{{url('programa-gobierno-abierto/programa-2018/ver-generacion')}}" class="btn_cfellow {{ $__env->yieldContent('body_class') == 'programa' ? 'active' : ''}}"><span>Conoce a los Fellows</span></a></li>
		<li><a href="{{url('gobierno-abierto')}}" class="btn_abierto {{ $__env->yieldContent('body_class') == 'abierto' ? 'active' : ''}}"><span>Gobierno Abierto</span></a></li>
		<li><a href="{{url('noticias-eventos')}}" class="btn_noticias {{ $__env->yieldContent('body_class') == 'noticias' ? 'active' : ''}}"><span>Noticias</span></a></li>
		<li><a href="{{url('noticias-eventos/blog-fellow')}}" class="btn_bfellow {{ $__env->yieldContent('body_class') == 'noticias' ? 'active' : ''}}"><span>Blog de Fellows</span></a></li>
		<li><a href="{{url('contacto')}}" class="btn_contacto {{ $__env->yieldContent('body_class') == 'contacto' ? 'active' : ''}}"><span>Contacto</span></a></li>
	</ul>

	<span aria-hidden="true" class="stretchy-nav-bg"></span>
</nav>
