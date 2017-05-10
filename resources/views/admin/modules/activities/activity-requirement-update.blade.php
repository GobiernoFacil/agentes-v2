@extends('layouts.admin.a_master')
@section('title', 'Actualizar requerimiento')
@section('description', 'Actualizar requerimiento')
@section('body_class', 'modulos')
@section('breadcrumb_type', 'module session update requirement')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1><strong>Actualizar recurso</strong> de la actividad "{{$activity->name}}"</h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.modules.activities.form.activity-requirement-update-form')
    </div>
  </div>
</div>
@endsection
