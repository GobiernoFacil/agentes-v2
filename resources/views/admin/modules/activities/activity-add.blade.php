@extends('layouts.admin.a_master')
@section('title', 'Agregar actividad')
@section('description', 'Agregar nueva actividad')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar actividad</h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.modules.activities.form.activity-add-form')
    </div>
  </div>
</div>
@endsection
