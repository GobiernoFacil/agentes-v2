@extends('layouts.admin.a_master')
@section('title', 'Enviar mensaje privado')
@section('description', 'Enviar mensaje privado')
@section('body_class', 'admin mensajes')
@section('breadcrumb_type', 'message add')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Enviar mensaje privado</h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.messages.form.messages-add-form')
    </div>
  </div>
</div>
@endsection
