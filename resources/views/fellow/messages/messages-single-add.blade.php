@extends('layouts.admin.a_master')
@section('title', '')
@section('description', '')
@section('body_class', '')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    @if($conversation->to_id != $user->id)
    <h1>Enviar mensaje privado con {{$conversation->user_to->name}} </h1>
    @else
    <h1>Enviar mensaje privado con {{$conversation->user->name}} </h1>
    @endif
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('fellow.messages.form.messages-add-single-form')
    </div>
  </div>
</div>
@endsection
