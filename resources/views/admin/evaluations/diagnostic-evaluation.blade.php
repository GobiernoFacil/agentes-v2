@extends('layouts.admin.a_master')
@section('title', 'Evaluación diagnóstico de ' . $answers->user->name . ' ' . $answers->user->fellowData->surname )
@section('description', 'Evaluación diagnóstico de ' . $answers->user->name . ' ' . $answers->user->fellowData->surname )
@section('body_class', 'diagnostic')
@section('breadcrumb_type', 'diagnostic evaluation 1')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_diagnostic')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Evaluación diagnóstico de <strong>{{ $answers->user->name }} {{ $answers->user->fellowData->surname }} {{ $answers->user->fellowData->lastname }}</strong> (1/2)</h1>
  </div>
</div>

<div class="row">
  <div class="box">
    <div class="col-sm-10 col-sm-offset-1">
      @include('admin.evaluations.forms.diagnostic-evaluation-1-form')
    </div>
    <div class="clearfix"></div>
  </div>
</div>
@endsection
@section('js-content')
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
$(document).ready(function() {
  $('.answer_q1_1').click(function(event) {
     $('.answer_q1_1').not(this).attr('checked', false);
     $(this).attr('checked', true);
   });
  $('.answer_q1_2').click(function(event) {
     $('.answer_q1_2').not(this).attr('checked', false);
     $(this).attr('checked', true); });

  $('.answer_q1_3').click(function(event) {
     $('.answer_q1_3').not(this).attr('checked', false);
     $(this).attr('checked', true); });

   $('.answer_q2_1').click(function(event) {
      $('.answer_q2_1').not(this).attr('checked', false);
      $(this).attr('checked', true); });

  $('.answer_q2_2').click(function(event) {
     $('.answer_q2_2').not(this).attr('checked', false);
     $(this).attr('checked', true); });

  $('.answer_q3_1').click(function(event) {
     $('.answer_q3_1').not(this).attr('checked', false);
     $(this).attr('checked', true); });

  $('.answer_q3_2').click(function(event) {
     $('.answer_q3_2').not(this).attr('checked', false);
     $(this).attr('checked', true); });

   $('.answer_q3_3').click(function(event) {
      $('.answer_q3_3').not(this).attr('checked', false);
      $(this).attr('checked', true); });

    $('.answer_q3_4').click(function(event) {
       $('.answer_q3_4').not(this).attr('checked', false);
       $(this).attr('checked', true); });
     });
</script>
@endsection
