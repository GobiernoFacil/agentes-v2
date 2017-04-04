@extends('layouts.admin.a_master')
@section('title', 'Agregar módulo')
@section('description', 'Agregar nuevo módulo')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Actualizar módulo: {{$module->title}}</h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.modules.form.module-update-form')
    </div>
  </div>
</div>
@endsection
