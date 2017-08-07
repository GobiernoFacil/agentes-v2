@extends('layouts.admin.a_master')
@section('title', 'Comenzar encuesta de satisfacción')
@section('description', 'Comenzar encuesta de satisfacción')
@section('body_class', 'fellow')
@section('breadcrumb_type', 'survey welcome')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_survey')

@section('content')
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2 center">
      <h1>Encuesta de satisfacción Plataforma Apertus</h1>
    </div>
    <div class="col-sm-12">
    </div>
    <div class="col-sm-4 col-sm-offset-4 center">
      <a href='{{ url("tablero/encuestas/encuesta-satisfaccion/1") }}' class="btn gde">Comenzar</a>
    </div>

  </div>
</div>
@endsection
