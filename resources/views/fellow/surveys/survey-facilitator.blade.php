@extends('layouts.admin.a_master')
@section('title', '' )
@section('description', '')
@section('body_class', 'fellow')

@section('content')
<div class="row">
  <div class="col-sm-8 col-sm-offset-2 center">
    <h1>Encuesta de facilitador</h1>
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
  <div class ="row">
    <div class= "col-sm-12">
      @include('fellow.surveys.forms.facilitator-form')
    </div>
  </div>
</div>
@endsection
@section('js-content')
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
$(document).ready(function() {
  $('.fa_1').click(function(event) {
     $('.fa_1').not(this).attr('checked', false);
     $(this).attr('checked', true);
   });
   $('.fa_2').click(function(event) {
      $('.fa_2').not(this).attr('checked', false);
      $(this).attr('checked', true);
    });
    $('.fa_3').click(function(event) {
       $('.fa_3').not(this).attr('checked', false);
       $(this).attr('checked', true);
     });
     $('.fa_4').click(function(event) {
        $('.fa_4').not(this).attr('checked', false);
        $(this).attr('checked', true);
      });
      $('.fa_5').click(function(event) {
         $('.fa_5').not(this).attr('checked', false);
         $(this).attr('checked', true);
       });
       $('.fa_6').click(function(event) {
          $('.fa_6').not(this).attr('checked', false);
          $(this).attr('checked', true);
        });
          $('.fa_9').click(function(event) {
             $('.fa_9').not(this).attr('checked', false);
             $(this).attr('checked', true);
           });
 });
</script>
@endsection
