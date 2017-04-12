@extends('layouts.admin.a_master')
@section('title', 'Agregar pre-requisitos de la sesión')
@section('description', 'Agregar pre-requisitos de la sesión')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar Pre-requisitos de la Sesión</h1>
  </div>
</div>
<div class="box">
  <div class="row">

      @if($preSession)
      <div class="col-sm-8 col-sm-offset-2">
        @include('admin.modules.requirements.form.requirement-add-form')
      </div>
      @else
      <div class="col-sm-12">
       <h1> No se cuenta con una sesión anterior a la actual </h1>
     </div>
      @endif
  </div>
</div>
@endsection
