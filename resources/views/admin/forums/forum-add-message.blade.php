@extends('layouts.admin.a_master')
@section('title',  'Agregar mensaje a ' . $forum->topic)
@section('description', 'Agregar mensaje a foro')
@section('body_class', 'foros')
@section('breadcrumb_type', 'forum add answer')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_forums')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar respuesta a <strong>{{$forum->topic}}</strong></h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.forums.forms.forum-add-single-form')
    </div>
  </div>
</div>
@endsection
