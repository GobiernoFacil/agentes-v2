@extends('layouts.admin.a_master')
@if(isset($session->forums))
  @section('title', 'Agregar tema o nueva pregunta a ' . $session->forums->topic)
  @section('description', 'Agregar tema o nueva pregunta a ' .  $session->forums->topic)
@else
  @if($session === 'foro-general')
    @section('title', 'Agregar tema o nueva pregunta a foro general' )
    @section('description', 'Agregar tema o nueva pregunta a foro general')
  @else
    @section('title', 'Agregar tema o nueva pregunta a foro del estado de ' .$session )
    @section('description', 'Agregar tema o nueva pregunta a foro del estado de ' .  $session)
  @endif
@endif
@section('body_class', 'fellow foros')
@section('breadcrumb_type', 'forum add question')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_forum')

@section('content')
<div class="row">
  <div class="col-sm-12">
    @if(isset($session->forums))
    <h1>Agregar tema o nueva pregunta a <strong>{{$session->forums->topic}}</strong></h1>
    @else
      @if($session === 'foro-general')
        <h1>Agregar tema o nueva pregunta a <strong>foro general</strong></h1>
      @else
        <h1>Agregar tema o nueva pregunta a <strong>foro del estado de {{$session}}</strong></h1>
      @endif
    @endif
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
