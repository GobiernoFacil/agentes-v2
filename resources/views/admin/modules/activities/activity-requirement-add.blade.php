@extends('layouts.admin.a_master')
@section('title', 'Agregar requerimiento de actividad')
@section('description', 'Agregar nuevo requerimiento')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar recurso y requerimiento técnico</h1>
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
