@extends('layouts.frontend.master')
@section('title', $content->title)
@section('description', 'Noticias y Eventos')
@section('body_class', 'noticias')
@section('canonical', url('noticias-eventos') )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_convocatoria')
@section('content')

<div class="col-sm-12">
	<h4 class="type_n {{$content->type}}">
	@if($content->type==='event')
	Evento
	@elseif($content->type==='news')
	Noticia
	@else
	Aviso
	@endif
	</h4>
	<h1>{{$content->title}}</h1>
</div>


<!--author-->
<div class="col-sm-12">
    <div class="divider b"></div>
</div>
<div class="col-sm-9">
    <p class="author">Por {{$content->user->name}} <span>{{$content->created_at->diffForHumans()}}</span></p>
</div>
<div class="col-sm-3 right">
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
  	@else
  	<p class="lead">{{$content->brief}}</p>
  	{!!$content->content!!}
  	@endif
</div>

@endsection