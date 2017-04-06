@extends('layouts.admin.a_master')
@section('title', 'Agregar temática')
@section('description', 'Agregar nueva temática')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar Temática</h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.modules.topics.form.topic-add-form')
    </div>
  </div>
</div>
@endsection
