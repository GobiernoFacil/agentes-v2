@extends('layouts.admin.a_master')
@section('title', '')
@section('description', '')
@section('body_class', '')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>{{$content->type==='event' ? "Evento: " : "Noticia: "}} {{$content->title}}</h1>
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
    </div>
  </div>
</div>
@endsection
