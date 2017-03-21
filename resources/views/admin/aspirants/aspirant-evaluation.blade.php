@extends('layouts.admin.a_master')
@section('title', 'Lista de Aspirantes')
@section('description', 'Lista de Aspirantes')
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirantes evaluar')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_aspirantes')

@section('content')

@if($files)
	@if($files->hasCv && $files->hasVideo &&$files->hasEssay &&$files->hasProof &&$files->hasPrivacy &&$files->hasLetter)
	<div class="row">
		<div class="col-sm-9">
			<h1>Evaluar a: <strong>{{ $aspirant->name }} {{ $aspirant->surname }} {{ $aspirant->lastname }}</strong></h1>
		</div>
		<div class="col-sm-3">
			<h4 class="right">{{ $aspirant->city }}, {{ $aspirant->state }} </h4>
		</div>
	</div>

	<div class="row">
		<div class="box">
			<div class="col-sm-10 col-sm-offset-1">
			@include('admin.aspirants.form.evaluation-form')
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	@else
	<h1>El aspirante no cumple con los requisitos para ser evaluado</h1>
	<div class="box">
		<p>{{ $aspirant->name }} {{ $aspirant->surname }} {{ $aspirant->lastname }} , no puede ser evaluado ya que su documentación no es válida.</p>
		<ul>
			@if(!$files->hasCv)
			<li>El <strong>Perfil Curricular</strong> no es válido</li>
			@endif
			@if(!$files->hasEssay)
			<li>El <strong>Ensayo</strong> no es válido</li>
			@endif
			@if(!$files->hasVideo)
			<li>El <strong>video</strong> no es válido</li>
			@endif
			@if(!$files->hasPrivacy)
			<li>El <strong>Consentimiento Relativo Al Tratamiento de sus Datos Personales</strong> no es válido</li>
			@endif
			@if(!$files->hasProof)
			<li>El <strong>Comprobante de Domicilio</strong> no es válido</li>
			@endif
			@if(!$files->hasLetter)
			<li>La <strong>Carta de Membretada</strong> no es válida</li>
			@endif
		</ul>
		<p><a href="{{ url('dashboard/aspirantes') }}" class="btn">&lt;&lt; Regresar a lista de aspirantes.</a></p>
	</div>
	@endif
@else
	<h1>El aspirante no cuenta con archivos</h1>
	<div class="box">
		<p>{{ $aspirant->name }} {{ $aspirant->surname }} {{ $aspirant->lastname }} no adjunto archivos, por lo que no puede ser evaluado.</p>
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
