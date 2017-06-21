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

</ul>