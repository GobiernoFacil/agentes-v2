@extends('layouts.admin.a_master')
@section('title', '')
@section('description', '')
@section('body_class', 'facilitator foros')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar nueva pregunta o tema a <strong>{{$forum->topic}}</strong></h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.forums.forms.forums-add-question-form')
    </div>
  </div>
</div>
@endsection
