@extends('layouts.admin.a_master')
@section('title', 'Agregar temática')
@section('description', 'Agregar nueva temática')
@section('body_class', 'modulos session topic')
@section('breadcrumb_type', 'module session topic add')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar Objetivos Particulares de la Sesión {{$session->order}}</h1>
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
