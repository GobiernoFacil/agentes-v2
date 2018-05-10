@extends('layouts.admin.a_master')
@section('title', 'Agregar evaluación diagnóstico')
@section('description', 'Agregar nueva evaluación diagnóstico')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar evaluación diagnóstico a sesión {{$activity->session->module->order}}.{{$activity->session->order}}:  {{$activity->session->name}}</h1>
    <h2>Actividad {{$activity->session->order}}.{{$activity->order}}: {{$activity->name}} </h2>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.modules.diagnostic.forms.quiz-info')
    </div>
  </div>
</div>
@endsection
