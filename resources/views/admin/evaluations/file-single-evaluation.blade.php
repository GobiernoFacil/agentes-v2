@extends('layouts.admin.a_master')
@section('title', 'Agregar evaluación de archivos')
@section('description', 'Agregar evaluación de archivos de forma individual' )
@section('body_class', 'evaluation')
@section('breadcrumb_type', 'evaluation file')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_evaluation')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar evaluación de archivo a fellow </h1>
    <h2>Actividad:  {{$activity->name}}</h2>
	<div class="divider"></div>
  </div>
</div>

<div class="row">
  <div class="box">
    <div class="col-sm-10 col-sm-offset-1">
      @include('admin.evaluations.forms.files-single-evaluation-form')
    </div>
    <div class="clearfix"></div>
  </div>
</div>
@endsection
