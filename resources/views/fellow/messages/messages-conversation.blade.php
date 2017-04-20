@extends('layouts.admin.a_master')
@section('title', '')
@section('description', '')
@section('body_class', '')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    @if($conversation->to_id != $user->id)
    <h1>Mensaje privado con {{$conversation->user_to->name}} </h1>
    @else
    <h1>Mensaje privado con {{$conversation->user->name}} </h1>
    @endif
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
  @else
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <p>No existen mensajes</p>
    </div>
  </div>
  @endif
</div>
@endsection
