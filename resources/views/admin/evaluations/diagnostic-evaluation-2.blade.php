@extends('layouts.admin.a_master')
@section('title', 'Evaluar')
@section('description', '')
@section('body_class', '')

@section('content')
<div class="row">
  <div class="col-sm-9">
    <h1>Evaluación diagnóstico de: <strong>{{ $answers->user->name }} {{ $answers->user->fellowData->surname }} {{ $answers->user->fellowData->lastname }} (2)</strong></h1>
  </div>
</div>

<div class="row">
  <div class="box">
    <div class="col-sm-10 col-sm-offset-1">
      @include('admin.evaluations.forms.diagnostic-evaluation-2-form')
    </div>
    <div class="clearfix"></div>
  </div>
</div>
@endsection
