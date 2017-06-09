@extends('layouts.admin.a_master')
@section('title', 'Agregar evaluación')
@section('description', 'Agregar nueva evaluación')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar evaluación a sesión {{$activity->session->module->order}}.{{$activity->session->order}}:  {{$activity->session->name}}</h1>
    <h2>Actividad {{$activity->session->order}}.{{$activity->order}}: {{$activity->name}} </h2>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.modules.quiz.forms.quiz-info-form')
    </div>
  </div>
</div>
@endsection
