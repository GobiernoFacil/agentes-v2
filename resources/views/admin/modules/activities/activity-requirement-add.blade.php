@extends('layouts.admin.a_master')
@section('title', 'Agregar requerimiento de actividad')
@section('description', 'Agregar nuevo requerimiento')
@section('body_class', 'modulos')
@section('breadcrumb_type', 'module session add requirement')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1><strong>Agregar recurso</strong> a la actividad "{{$activity->name}}"</h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.modules.activities.form.activity-requirement-add-form')
    </div>
  </div>
</div>
@endsection
