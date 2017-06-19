<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="news list")
	<li>Noticias</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') == "news view" || $__env->yieldContent('breadcrumb_type') == "news update"  || $__env->yieldContent('breadcrumb_type') == "news add")
	<li><a href="{{url('dashboard/noticias-eventos')}}">Noticias</a></li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') == "news view" )
	<li>{{$content->title}}</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') == "news update" )
	<li>Actualizar: {{$content->title}}</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') == "news add" )
	<li>Agregar noticia o evento</li>
	@endif

</ul>