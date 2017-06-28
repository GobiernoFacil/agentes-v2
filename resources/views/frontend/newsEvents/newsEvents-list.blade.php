@extends('layouts.frontend.master')
@section('title', 'Noticias y Eventos')
@section('description', 'Noticias y Eventos')
@section('body_class', 'noticias')
@section('canonical', url('noticias-eventos') )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_news')
@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>Noticias y Eventos</h1>
		
		@if($all->count() > 0)
		<div class="row">
			<div class="box">
				<ul class="list line news_list row">
					<?php $count_a = 0?>
					@foreach($all as $article)
					<?php $count_a++?>					
					<li class="{{ $count_a == 1 ? 'col-sm-12' : 'col-sm-6'}}">
						@if($article->image)
						<p><img src='{{url("img/newsEvent/{$article->image->name}")}}'></p>
						@endif	
						@if($article->type==='event')
						<h4 class="type_n {{$article->type}}">Evento</h4>
						@elseif($article->type==='news')
						<h4 class="type_n {{$article->type}}">Noticia</h4>
						@endif
					
						<h2><a href="{{url('noticias-eventos/' . $article->slug)}}">{{$article->title}}</a></h2>
						<p class="author">Por {{$article->user->name}} <span>{{$article->created_at->diffForHumans()}}</span></p>
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