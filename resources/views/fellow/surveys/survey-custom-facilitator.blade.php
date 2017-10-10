@extends('layouts.admin.a_master')
@section('title', 'Evaluación diagnóstico '. $questionnaire->title)
@section('description', 'Evaluación diagnóstico '. $questionnaire->title)
@section('body_class', 'fellow aprendizaje')
@section('breadcrumb_type', 'custom view')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_diagnostic')
@section('content')
<div class="row">

  <div class="col-sm-8 col-sm-offset-2 center">
    <h1>Evaluación de agente de cambio  <strong>{{$facilitator->name}}</strong></h1>
  </div>
  <div class="col-sm-12">
    <div class="divider b"></div>
  </div>
  <div class="col-sm-9">
    <h3 class="title">Módulo: {{$session->module->title}}</h3>
  </div>
  <div class="col-sm-9">
    <h3 class="title">Sesión: {{$session->name}}</h3>
  </div>


</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('fellow.surveys.forms.custom-facilitator-form')
    </div>
  </div>
</div>
@endsection

@section('js-content')

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
$(document).ready(function() {
  @foreach($questionnaire->questions as $question)
    @if($question->options_rows_number >1)
      @foreach($question->answers as $answer)
      $("{{'.question_'.$question->id.'_'.$answer->id}}").click(function(event) {
         $("{{'.question_'.$question->id.'_'.$answer->id}}").not(this).attr('checked', false);
         $(this).attr('checked', true);
       });
      @endforeach

    @elseif($question->options_rows_number === 1)
      $("{{'.question_'.$question->id}}").click(function(event) {
         $("{{'.question_'.$question->id}}").not(this).attr('checked', false);
         $(this).attr('checked', true);
       });
    @endif
  @endforeach
});

</script>
@endsection
