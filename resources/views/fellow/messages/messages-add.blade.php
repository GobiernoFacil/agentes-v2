@extends('layouts.admin.a_master')
@section('title', 'Enviar mensaje privado')
@section('description', 'Enviar mensaje privado')
@section('body_class', 'fellow mensajes')
@section('breadcrumb_type', 'message add')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_messages')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Enviar mensaje</h1>
  </div>
</div>
<div class="row">
    <div class="col-sm-12">
    	@include('fellow.messages.form.messages-add-form')
    </div>
</div>
@endsection
