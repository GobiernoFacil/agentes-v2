@extends('layouts.admin.a_master')
@section('title', 'Evaluación')
@section('description', 'Evaluación')
@section('body_class', 'fellow aprendizaje')
@section('breadcrumb_type', 'module test')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_modules')
@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Examen de diagnóstico</h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('fellow.diagnostic.forms.add-diagnostic-form')
    </div>
  </div>
</div>
@endsection
