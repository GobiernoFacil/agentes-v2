@extends('layouts.admin.a_master')
@if(isset($forum->session))
  @section('title', 'Agregar tema o nueva pregunta a ' . $forum->topic)
  @section('description', 'Agregar tema o nueva pregunta a ' .  $forum->topic)
@else
  @section('title', 'Agregar tema o nueva pregunta a foro del estado de ' .$forum->session )
  @section('description', 'Agregar tema o nueva pregunta a foro del estado de ' .  $forum->session)
@endif
@section('body_class', 'foros')
@section('breadcrumb_type', 'forum add question')
@section('breadcrumb', 'layouts.facilitator.breadcrumb.b_forums')

@section('content')
<div class="row">
  <div class="col-sm-12">
	  @if(isset($forum->session))
    <h1>Agregar tema o nueva pregunta a <strong>{{$forum->topic}}</strong></h1>
    @else
    <h1>Agregar tema o nueva pregunta a <strong>foro del estado de {{$forum->session}}</strong></h1>
    @endif
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('facilitator.forums.forms.forums-add-question-form')
    </div>
  </div>
</div>
@endsection
