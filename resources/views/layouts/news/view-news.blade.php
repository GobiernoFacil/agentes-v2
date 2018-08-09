<div class="col-sm-9">
	<h4 class="type_n {{$content->type}}">
	@if($content->type==='event')
	Evento
	@elseif($content->type==='news')
	Noticia
	@elseif($content->type==='fellow')
	Blog en Gobierno Abierto y Desarrollo Sostenible
	@else
	Aviso
	@endif
	</h4>
	<h1>{{$content->title}}</h1>
</div>
<div class="col-sm-3">
	@if($user->type == "admin")
  	<a href="{{url('dashboard/noticias-eventos/editar/' . $content->id)}}" class="btn view gde">Editar {{$content->type==='event' ? "evento" : "noticia"}}</a>
  	@endif
</div>

<!--author-->
<div class="col-sm-12">
    <div class="divider b"></div>
</div>
<div class="col-sm-9">
    <p class="author">Por {{$content->user->name}} <span>{{$content->created_at->diffForHumans()}}</span></p>
</div>
<div class="col-sm-3 right">
	@if($user->type == "admin")
    <p class="author">{!! $content->public == 1 ? '<span class="published_ s">Publicado</span>' : '<span class="published_ n">Sin publicar</span>' !!}</p>
    @endif
</div>
<div class="col-sm-12">
    <div class="divider b"></div>
</div>
<div class="col-sm-8 col-sm-offset-2">
	@if($content->type==='event')
  	<p class="lead">{{$content->brief}}</p>
  	<div class="row">
      	<div class="col-sm-4">
    	    	<h3>Fecha de inicio:</h3>
  			<p>{{date("d-m-Y", strtotime($content->start))}}</p>
      	</div>
      	<div class="col-sm-4 center">
    	    	<h3>Fecha en que termina:</h3>
  			<p>{{date("d-m-Y", strtotime($content->end))}}</p>
      	</div>
      	<div class="col-sm-4 right">
    	    	<h3>Hora:</h3>
  			<p>{{$content->time}}</p>
      	</div>
  	</div>
  	@if($content->image)
      <p><img src='{{url("img/newsEvent/{$content->image->name}")}}'></p>
    @endif
  	{!!$content->content!!}
  	@else
  	<p class="lead">{{$content->brief}}</p>
  	@if($content->image)
      <p><img src='{{url("img/newsEvent/{$content->image->name}")}}'></p>
    @endif
  	{!!$content->content!!}
  	@endif
</div>
