@extends('layouts.admin.a_master')
@section('title',  'Agregar mensaje a ' . $forum->topic)
@section('description', 'Agregar mensaje a foro')
@section('body_class', 'foros')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar mensaje a foro {{$forum->topic}} </h1>
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
