@extends('layouts.frontend.master')
@section('title', 'Noticias y Eventos')
@section('description', 'Noticias y Eventos')
@section('body_class', 'noticias')
@section('canonical', url('noticias-eventos') )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_convocatoria')
@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>Noticias y Eventos</h1>
		@if($all->count() > 0)
<div class="row">
	<div class="box">
		<ul class="list line">
		@foreach($all as $article)
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
			
		</div>
	</div>
	<h2><a href="{{url('noticias-eventos/' . $article->slug)}}">{{$article->title}}</a></h2>
	<p class="author">Por {{$article->user->name}} <span>{{$article->created_at->diffForHumans()}}</span></p>
	 {!! \Illuminate\Support\Str::words($article->brief,50,'…') !!}
</li>
		@endforeach
		</ul>
	</div>
</div>
@else
<div class="row">
	<div class="box">
		<h2>Aún no hay noticias</h2>
	</div>
</div>
@endif
	</div>
</div>
@endsection