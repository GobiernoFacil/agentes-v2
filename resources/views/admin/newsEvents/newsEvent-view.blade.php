@extends('layouts.admin.a_master')
@section('title', $content->title)
@section('description', $content->title)
@section('body_class', 'news')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
  <div class="col-sm-9">
    @if($content->type==='event')
    <h1>"Evento: " {{$content->title}}</h1>
    @elseif($content->type==='news')
    <h1>"Noticia: " {{$content->title}}</h1>
    @else
    <h1>"Aviso: " {{$content->title}}</h1>
    @endif
	<p class="author">Por {{$content->user_id}} <span>{{$content->created_at->diffForHumans()}}</span></p>
  </div>
  <div class="col-sm-3">
		<a href="{{url('dashboard/noticias-eventos/editar/' . $content->id)}}" class="btn view gde">Editar {{$content->type==='event' ? "evento" : "noticia"}}</a>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @if($content->type==='event')
      <p>Fecha inicio: {{date("d-m-Y", strtotime($content->start))}}</p>
  		<p>Fecha fin: {{date("d-m-Y", strtotime($content->end))}}</p>
      <p>Hora: {{$content->time}}</p>
      @endif

      @if($content->type==='news')
	  	{!!$content->content!!}
      @endif
    </div>
  </div>
</div>
@endsection
