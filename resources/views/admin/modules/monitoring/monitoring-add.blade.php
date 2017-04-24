@extends('layouts.admin.a_master')
@section('title', 'Agregar mecanismo de evaluación')
@section('description', 'Agregar nuevo mecanismo de evaluación')
@section('body_class', 'modulos session monitoring')
@section('breadcrumb_type', 'module session add monitoring')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar mecanismo de Monitoreo y Evaluación</h1>
    <h2>Sesión {{$session->order}} del módulo "{{$session->module->title}}"</h2>
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
