@extends('layouts.admin.a_master')
@section('title', 'Actualizar archivos a actividad')
@section('description', 'Actualizar archivos a actividad')
@section('body_class', '')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Actualizar archivo de actividad: {{$file->activity->name}} </h1>
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
