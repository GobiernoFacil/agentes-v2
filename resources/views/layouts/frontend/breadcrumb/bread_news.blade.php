<ul>
	<li>Estás en:</li>
	<li><a href="{{url('')}}">Inicio</a></li>
	@if ($__env->yieldContent('body_class') =="noticias")
	<li>Noticias</li>
	@endif
	@if ($__env->yieldContent('body_class') =="noticias view")
	<li><a href="{{url('noticias-eventos')}}">Noticias</a></li>
	<li>{{$content->title}}</li>
	@endif

	@if ($__env->yieldContent('body_class') =="noticias blog")
	<li><a href="{{url('noticias-eventos')}}">Noticias</a></li>
	<li>Blog Fellow</li>
	@endif

	@if ($__env->yieldContent('body_class') =="noticias blog view")
	<li><a href="{{url('noticias-eventos/blog-fellow')}}">Blog Fellow</a></li>
	<li>{{$content->title}}</li>
	@endif
</ul>
