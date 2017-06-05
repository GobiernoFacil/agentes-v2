@extends('layouts.admin.a_master')
@section('title',  $question->topic)
@section('description', 'Ver foro')
@section('body_class', 'admin foros')
@section('breadcrumb_type', 'forum view')

@section('content')
<div class="row">
  <div class="col-sm-9">
    <h1>{{$question->topic}} </h1>
  </div>
  <div class="col-sm-3 center">
    <a href='{{ url("dashboard/foros/pregunta/mensajes/agregar/$question->id") }}' class="btn gde"><strong>+</strong> Agregar Mensaje</a>
  </div>
</div>
<div class="box">
  @if($question->messages)
    @foreach($question->messages as $message)
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <p>{{$message->message}}</p>
        </div>
      </div>
    @endforeach
    <div class="row">
      <div class="col-sm-3 col-sm-offset-2 center">
        <a href='{{ url("dashboard/foros/pregunta/mensajes/agregar/$question->id") }}' class="btn gde"><strong>+</strong> Agregar Mensaje</a>
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
