<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="news list")
	<li>Noticias</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') == "news view" )
	<li><a href="{{url('dashboard/noticias-eventos')}}">Noticias</a></li>
	<li>{{$content->title}}</li>
	@endif

</ul>