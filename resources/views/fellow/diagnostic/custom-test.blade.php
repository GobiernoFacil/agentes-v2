@extends('layouts.admin.a_master')
@section('title', 'Evaluación diagnóstico '. $questionnaire->title)
@section('description', 'Evaluación diagnóstico '. $questionnaire->title)
@section('body_class', 'fellow aprendizaje')
@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Cuestionario diagnóstico</h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('fellow.diagnostic.forms.custom-diagnostic-form')
    </div>
  </div>
</div>
@endsection
