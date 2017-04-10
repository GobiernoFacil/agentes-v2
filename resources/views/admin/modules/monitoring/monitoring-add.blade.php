@extends('layouts.admin.a_master')
@section('title', 'Agregar mecanismo de evaluación')
@section('description', 'Agregar nuevo mecanismo de evaluación')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar mecanismo de Monitoreo y Evaluación</h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.modules.monitoring.form.monitoring-add-form')
    </div>
  </div>
</div>
@endsection
