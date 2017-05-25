@extends('layouts.admin.a_master')
@section('title', 'Mensaje privado con ' . $conversation->user_to->name)
@section('description', 'Mensaje privado con ' . $conversation->user_to->name)
@section('body_class', 'fellow mensajes')
@section('breadcrumb_type', 'message view')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_messages')

@section('content')
<div class="row">
  <div class="col-sm-9">
    @if($conversation->to_id != $user->id)
    <h1>Mensaje privado con {{$conversation->user_to->name}} </h1>
    @else
    <h1>Mensaje privado con {{$conversation->user->name}} </h1>
    @endif
  </div>
  <div class="col-sm-3 center">
    <a href='{{ url("tablero/mensajes/conversacion/agregar/$conversation->id") }}' class="btn gde"><strong>+</strong> Agregar Mensaje</a>
  </div>
</div>
<div class="box">
  @if($conversation->messages->count() > 0)
    @foreach($conversation->messages as $message)
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <p>{{$message->message}}</p>
        </div>
      </div>
    @endforeach
    <div class="row">
      <div class="col-sm-3 col-sm-offset-2 center">
        <a href='{{ url("tablero/mensajes/conversacion/agregar/$conversation->id") }}' class="btn gde"><strong>+</strong> Agregar Mensaje</a>
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
