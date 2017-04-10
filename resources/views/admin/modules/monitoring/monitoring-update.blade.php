@extends('layouts.admin.a_master')
@section('title', 'Actualizar mecanismo de evaluación')
@section('description', 'Actualizar nuevo mecanismo de evaluación')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Actualizar mecanismo de Monitoreo y Evaluación</h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.modules.monitoring.form.monitoring-update-form')
    </div>
  </div>
</div>
@endsection
