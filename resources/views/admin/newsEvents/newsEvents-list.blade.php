@extends('layouts.admin.a_master')
@section('title', 'Noticas y Eventos')
@section('description', 'Noticias y eventos')
@section('body_class', 'news')
@section('breadcrumb_type', 'news list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_news')
@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Noticias y eventos</h1>
	</div>
	<div class="col-sm-3">
		<a href="{{url('dashboard/noticias-eventos/agregar')}}" class="btn view gde">Agregar Noticia o evento [+]</a>
	</div>
</div>

@if($news->count() > 0)
<div class="row">
	<div class="box">
		<ul class="list line">
		@foreach($news as $article)
			<li>
				@if($article->type==='event')
				<h4 class="type_n {{$article->type}}">Evento</h4>
				@elseif($article->type==='news')
				<h4 class="type_n {{$article->type}}">Noticia</h4>
				@else
				<h4 class="type_n {{$article->type}}">Aviso</h4>
				@endif
			<h2><a href="{{url('dashboard/noticias-eventos/ver/' . $article->id)}}">{{$article->title}}</a></h2>
			<p class="author">Por {{$article->user_id}} <span>{{$article->created_at->diffForHumans()}}</span></p>
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
@endsection
