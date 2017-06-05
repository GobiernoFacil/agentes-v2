@extends('layouts.admin.a_master')
@section('title', 'Agregar tema o nueva pregunta a ' .  $session->forums->topic)
@section('description', 'Agregar tema o nueva pregunta a ' .  $session->forums->topic)
@section('body_class', 'fellow foros')
@section('breadcrumb_type', 'forum add question')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_forum')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar tema o nueva pregunta a <strong>{{$session->forums->topic}}</strong></h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <?php
      if(isset($session->slug)){
        $url = $session->slug;
      }else{
        $url = $session;
      }

      ?>
      @include('fellow.modules.sessions.forums.forms.forums-add-question-form')
    </div>
  </div>
</div>
@endsection
