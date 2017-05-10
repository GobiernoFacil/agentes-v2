@extends('layouts.admin.a_master')
@section('title', 'Actualizar archivos a actividad')
@section('description', 'Actualizar archivos a actividad')
@section('body_class', 'modulos')
@section('breadcrumb_type', 'module session update files')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1><strong>Actualizar archivo</strong> de actividad: {{$file->activity->name}} </h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.modules.activities.form.activity-files-update-form')
    </div>
  </div>
</div>
@endsection
