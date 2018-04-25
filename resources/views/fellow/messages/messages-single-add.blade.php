@extends('layouts.admin.a_master')
@section('title', 'Enviar mensaje privado')
@section('description', 'Enviar mensaje privado')
@section('body_class', 'fellow mensajes')
@section('breadcrumb_type', 'message send')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_messages')

@section('content')
<div class="row">
	<div class="col-sm-12">
    	@if($conversation->to_id != $user->id)
			<h1>Agregar mensaje a conversación con {{$conversation->user_to->name}} </h1>
		@else
			<h1>Enviar mensaje a conversación con {{$conversation->user->name}} </h1>
		@endif
		<div class="divider bg"></div>
	</div>
</div>
<div class="row">
    <div class="col-sm-12">
	    <h2>Asunto de la conversación: {{$conversation->title}}</h2>
		@include('fellow.messages.form.messages-add-single-form')
    </div>
  </div>
@endsection