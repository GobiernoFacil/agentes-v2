@extends('layouts.admin.a_master')
@section('title',  $forum->topic)
@section('description', 'Ver foro')
@section('body_class', 'facilitator foros')
@section('breadcrumb_type', 'forum view')

@section('content')
<div class="row">
  <div class="col-sm-9">
    <h1>{{$forum->topic}} </h1>
  </div>
  <div class="col-sm-3 center">
    <a href='{{ url("tablero-facilitador/foros/$forum->slug/mensajes/agregar") }}' class="btn gde"><strong>+</strong> Agregar Mensaje</a>
  </div>
</div>
<div class="box">
  @if($forum->forum_messages)
    @foreach($forum->forum_messages as $message)
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <p>{{$message->message}}</p>
        </div>
      </div>
    @endforeach
    <div class="row">
      <div class="col-sm-3 col-sm-offset-2 center">
        <a href='{{ url("tablero-facilitador/foros/$forum->slug/mensajes/agregar") }}' class="btn gde"><strong>+</strong> Agregar Mensaje</a>
      </div>
    </div>
  @else
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <p>No existen mensajes</p>
    </div>
  </div>
  @endif
</div>
@endsection
