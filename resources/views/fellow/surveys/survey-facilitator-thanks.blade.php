@extends('layouts.admin.a_master')
@section('title', 'Gracias por participar')
@section('description', 'Gracias por contestar la encuesta')
@section('body_class', 'fellow')

@section('content')
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2 center">
      <h1>¡Gracias por contestar la encuesta!</h1>
    </div>
    <div class="col-sm-4 col-sm-offset-4 center">
      <a href='{{ url("tablero/encuestas/facilitadores-sesiones/{$session->slug}") }}' class="btn gde">Finalizar</a>
    </div>

  </div>
</div>
@endsection
