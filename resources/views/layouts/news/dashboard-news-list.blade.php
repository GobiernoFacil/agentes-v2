<li>
	<div class="row">
		<div class="col-sm-9">
			@if($article->type==='event')
			<h4 class="type_n {{$article->type}}">Evento</h4>
			@elseif($article->type==='news')
			<h4 class="type_n {{$article->type}}">Noticia</h4>
			@else
			<h4 class="type_n {{$article->type}}">Aviso</h4>
			@endif
		</div>
		<div class="col-sm-3 right">
			@if($user->type == "admin")
			<p class="author">{!! $article->public == 1 ? '<span class="published_ s">Publicado</span>' : '<span class="published_ n">Sin publicar</span>' !!} <a href="{{url('dashboard/noticias-eventos/editar/' . $article->id)}}" class="btn view">Editar {{$article->type==='event' ? "evento" : "noticia"}}</a></p>
			@endif
		</div>
	</div>
	@if($user->type == "admin")
	<h3><a href="{{url('dashboard/noticias-eventos/ver/' . $article->id)}}">{{$article->title}}</a></h3>
	@endif
	@if($user->type == "fellow")
	<h3><a href="{{url('tablero/noticias/' . $article->slug)}}">{{$article->title}}</a></h3>
	@endif
	<p class="author">Por {{$article->user->name}} <span>{{$article->created_at->diffForHumans()}}</span></p>
</li>
