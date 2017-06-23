@extends('layouts.admin.a_master')
@section('title', 'Agregar archivos a actividad')
@section('description', 'Agregar archivos a actividad')
@section('body_class', 'modulos')
@section('breadcrumb_type', 'module session add files')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1><strong>Agregar archivo</strong> a actividad: {{$activity->name}} </h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.modules.activities.form.activity-files-add-single-form')
    </div>
  </div>
</div>
@endsection
