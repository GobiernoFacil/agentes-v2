@extends('layouts.admin.a_master')
@section('title', 'Respuestas de encuesta de satisfacción de ')
@section('description', 'Respuestas de encuesta de satisfacción de ' )
@section('body_class', '')
@section('breadcrumb_type', 'survey  view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_survey')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar encuesta</h1>
    <p>{{$program->title}}</p>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.surveys.forms.survey-add-form')
    </div>
  </div>
</div>
@endsection
