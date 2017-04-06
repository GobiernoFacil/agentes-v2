@extends('layouts.admin.a_master')
@section('title', 'Actualizar requerimiento')
@section('description', 'Actualizar requerimiento')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Actualizar recurso y requerimiento técnico</h1>
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
