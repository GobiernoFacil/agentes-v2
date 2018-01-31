@extends('layouts.frontend.master')
@section('title', $content->title)
@section('description', 'Noticias y Eventos')
@section('body_class', 'noticias view')
@section('canonical', url('noticias-eventos/' . $content->slug ) )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_news')
@section('content')

<article class="news_view">
	<div class="row">
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
			
			
			
			<!--author-->
    		<div class="divider"></div>
			
    		<p class="author">Por {{$content->user->name}} <span>{{$content->updated_at->diffForHumans()}}</span></p>
			
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
	</div>
</article>	

@endsection