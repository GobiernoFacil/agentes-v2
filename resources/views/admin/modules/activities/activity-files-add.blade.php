@extends('layouts.admin.a_master')
@section('title', 'Agregar archivos a actividad')
@section('description', 'Agregar archivos a actividad')
@section('body_class', '')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar archivos a actividad: {{$activity->name}} </h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.modules.activities.form.activity-files-add-form')
    </div>
  </div>
</div>
@endsection
