@extends('layouts.admin.a_master')
@section('title',  'Agregar mensaje a pregunta' . $question->topic)
@section('description', 'Agregar mensaje a foro')
@section('body_class', 'fellow foros')
@section('breadcrumb_type', 'forum add answer')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_forum')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar respuesta a pregunta o tema <strong>{{$question->topic}}</strong></h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('fellow.forums.forms.forum-add-single-form')
    </div>
  </div>
</div>
@endsection
