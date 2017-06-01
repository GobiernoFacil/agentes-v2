@extends('layouts.admin.a_master')
@section('title', 'Crear nuevo foro')
@section('description', 'Crear nuevo foro')
@section('body_class', 'foros')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Crear nuevo foro</h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.forums.forms.forums-add-form')
    </div>
  </div>
</div>
@endsection
