@extends('layouts.admin.a_master')
@section('title', '' )
@section('description', '')
@section('body_class', 'fellow')

@section('content')
<div class="row">
  <div class="col-sm-8 col-sm-offset-2 center">
    <h1>Encuesta de facilitador</h1>
  </div>
  <div class="col-sm-12">
    <div class="divider b"></div>
  </div>
  <div class="col-sm-9">
    <h3 class="title">Módulo: {{$session->module->title}}</h3>
  </div>
  <div class="col-sm-9">
    <h3 class="title">Sesión: {{$session->name}}</h3>
  </div>

</div>
<div class="box">
  <div class ="row">
    <div class= "col-sm-12">
      @include('fellow.surveys.forms.facilitator-form')
    </div>
  </div>
</div>
@endsection
@section('js-content')
@endsection
