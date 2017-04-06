@extends('layouts.admin.a_master')
@section('title', 'Actualizar actividad')
@section('description', 'Actualizar nueva actividad')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Actualizar actividad</h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.modules.activities.form.activity-update-form')
    </div>
  </div>
</div>
@endsection
