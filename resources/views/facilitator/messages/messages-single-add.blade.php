@extends('layouts.admin.a_master')
@section('title', 'Enviar mensaje privado')
@section('description', 'Enviar mensaje privado')
@section('body_class', 'facilitator mensajes')
@section('breadcrumb_type', 'message send')
@section('breadcrumb', 'layouts.facilitator.breadcrumb.b_messages')

@section('content')
<div class="row">
  <div class="col-sm-12">
    @if($conversation->to_id != $user->id)
    <h1>Enviar mensaje privado a {{$conversation->user_to->name}} </h1>
    @else
    <h1>Enviar mensaje privado a {{$conversation->user->name}} </h1>
    @endif
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
	    <h2>Asunto: {{$conversation->title}}</h2>
		@include('facilitator.messages.form.messages-add-single-form')
    </div>
  </div>
</div>
@endsection
