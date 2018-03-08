@extends('layouts.admin.a_master')
@section('title', 'Evaluar aplicación de '.$aspirant->name)
@section('description', 'Evaluar aplicación  de '.$aspirant->name)
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirantes evaluar-aplicacion')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_aspirantes')

@section('content')

@if($aspirant->aspirantEvaluation)
	@if($aspirant->AspirantsFile)
		@if($aspirant->AspirantsFile->proof)
		<div class="row">
			<div class="col-sm-9">
				<h1>Evaluar aspirante  <strong>{{ $aspirant->name.' '.$aspirant->surname.' '.$aspirant->lastname }}</strong></h1>
			</div>
			<div class="col-sm-3">
				<h4 class="right">{{ $aspirant->city }}, {{ $aspirant->state }} </h4>
			</div>
		</div>

		<div class="row">
			<div class="box">
				<div class="col-sm-10 col-sm-offset-1">
				@include('admin.aspirants.evaluation.form.evaluate-form')
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		@else
		<h1>El aspirante no cuenta con un comprobante de domicilio válido</h1>
		<div class="box">
			<p>{{ $aspirant->name }} {{ $aspirant->surname }} {{ $aspirant->lastname }} , no puede ser evaluado ya que su documentación no es válida.</p>
			<p><a href='{{ url("dashboard/aspirantes/convocatoria/$notice->id/ver")}}' class="btn">&lt;&lt; Regresar a lista de aspirantes.</a></p>
		</div>
		@endif
	@else
		<h1>El aspirante no cuenta con un comprobante de domicilio</h1>
		<div class="box">
			<p>{{ $aspirant->name }} {{ $aspirant->surname }} {{ $aspirant->lastname }} , no puede ser evaluado ya que su documentación no esta completa.</p>
			<p><a href='{{ url("dashboard/aspirantes/convocatoria/$notice->id/ver")}}' class="btn">&lt;&lt; Regresar a lista de aspirantes.</a></p>
		</div>

	@endif
@else
	<h1>El aspirante no cumple con todos los requisitos para ser evaluado</h1>
	<div class="box">
		<p><a href='{{ url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-aplicacion-por-evaluar")}}' class="btn">&lt;&lt; Regresar a tu lista de aspirantes.</a></p>
	</div>
@endif

@endsection

@section('js-content')
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
var url  = '<?php echo $aspirant->AspirantsFile->video;?>';
$(document).ready(function() {
  var videoId = getId(url);
  var iframeMarkup = '<iframe width="560" height="315" src="//www.youtube.com/embed/'
    + videoId + '" frameborder="0" allowfullscreen></iframe>';
   $('#videoB').html(iframeMarkup);
   console.log(iframeMarkup);

});

function getId(url) {
    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    var match = url.match(regExp);

    if (match && match[2].length == 11) {
        return match[2];
    } else {
        return 'error';
    }
}
</script>
@endsection
