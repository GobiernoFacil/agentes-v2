@extends('layouts.admin.a_master')
@section('title', 'Comenzar encuesta de satisfacción')
@section('description', 'Comenzar encuesta de satisfacción')
@section('body_class', 'fellow')
@section('breadcrumb_type', 'survey welcome facilitator')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_survey')

@section('content')
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2 center">
      <h1>Evaluación de agentes de cambio a facilitador: {{$facilitator->name}}</h1>
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
    <div class="col-sm-12">
      <p>Esta encuesta es anónima</p>
    </div>
    <div class="col-sm-4 col-sm-offset-4 center">
      <a href='{{ url("tablero/encuestas/facilitadores-sesiones/{$session->slug}/{$facilitator->name}") }}' class="btn gde">Comenzar</a>
    </div>

  </div>
</div>
@endsection
