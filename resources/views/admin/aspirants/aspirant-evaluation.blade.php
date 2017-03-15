@extends('layouts.admin.a_master')
@section('title', 'Lista de Aspirantes')
@section('description', 'Lista de Aspirantes')
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirantes evaluar')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_aspirantes')

@section('content')

@if($evaluation)
	@include('admin.aspirants.form.evaluation-form')
@else
	<h1>El aspirante no cuenta con archivos</h1>
	<div class="box">
		<p>El aspirante no adjunto archivos, por lo que no puede ser evaluado.</p>
		<p><a href="{{ url('dashboard/aspirantes') }}" class="btn">&lt;&lt; Regresar a lista de aspirantes.</a></p>
	</div>
@endif



<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
$(document).ready(function() {
  $('.experience').click(function(event) {
     $('.experience').not(this).attr('checked', false);
     $(this).attr('checked', true);
   });
  $('.experience1').click(function(event) {
     $('.experience1').not(this).attr('checked', false);
     $(this).attr('checked', true); });

  $('.experience2').click(function(event) {
     $('.experience2').not(this).attr('checked', false);
     $(this).attr('checked', true); });

   $('.experience3').click(function(event) {
      $('.experience3').not(this).attr('checked', false);
      $(this).attr('checked', true); });

  $('.essay').click(function(event) {
     $('.essay').not(this).attr('checked', false);
     $(this).attr('checked', true); });

  $('.essay1').click(function(event) {
     $('.essay1').not(this).attr('checked', false);
     $(this).attr('checked', true); });

  $('.essay2').click(function(event) {
     $('.essay2').not(this).attr('checked', false);
     $(this).attr('checked', true); });

   $('.essay3').click(function(event) {
      $('.essay3').not(this).attr('checked', false);
      $(this).attr('checked', true); });

    $('.essay4').click(function(event) {
       $('.essay4').not(this).attr('checked', false);
       $(this).attr('checked', true); });

  $('.video').click(function(event) {
     $('.video').not(this).attr('checked', false);
     $(this).attr('checked', true); });

  $('.video1').click(function(event) {
     $('.video1').not(this).attr('checked', false);
     $(this).attr('checked', true); });

  $('.video2').click(function(event) {
     $('.video2').not(this).attr('checked', false);
     $(this).attr('checked', true); });

   $('.video3').click(function(event) {
      $('.video3').not(this).attr('checked', false);
      $(this).attr('checked', true); });

    $('.video4').click(function(event) {
       $('.video4').not(this).attr('checked', false);
       $(this).attr('checked', true); });
     });
</script>
@endsection