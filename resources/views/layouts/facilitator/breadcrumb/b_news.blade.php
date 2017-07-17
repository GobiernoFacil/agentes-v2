<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero-facilitador')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="news list")
	<li>Noticias</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="news view")
	<li><a href="{{url('tablero-facilitador/noticias')}}">Noticias</a></li>
	<li>{{$content->title}}</li>
	@endif
	
</ul>