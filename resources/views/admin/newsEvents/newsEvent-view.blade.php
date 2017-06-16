@extends('layouts.admin.a_master')
@section('title', $content->title)
@section('description', $content->title)
@section('body_class', 'news')
@section('breadcrumb_type', 'news view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_news')

@section('content')

<div class="box">
  <div class="row">
	  <div class="col-sm-9">
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
  	  <div class="col-sm-3">
  	    	<a href="{{url('dashboard/noticias-eventos/editar/' . $content->id)}}" class="btn view gde">Editar {{$content->type==='event' ? "evento" : "noticia"}}</a>
  	  </div>
  	  <!--author-->
  	  <div class="col-sm-12">
	  	  <div class="divider b"></div>
  	  </div>
  	  <div class="col-sm-9">
	  	  <p class="author">Por {{$content->user_id}} <span>{{$content->created_at->diffForHumans()}}</span></p>
  	  </div>
  	  <div class="col-sm-3 right">
	  	  <p class="author">{!! $content->public == 1 ? '<span class="published_ s">Publicado</span>' : '<span class="published_ n">Sin publicar</span>' !!}</p>
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
  </div>
</div>
@endsection
