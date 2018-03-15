@extends('layouts.admin.a_master')
@section('title', 'Verificar comprobante de domicilio de '.$aspirant->name)
@section('description', 'Verificar comprobante de domicilio de '.$aspirant->name)
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirantes evaluar-comprobante')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_aspirantes')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Revisar comprobante de domicilio</h1>
		<div class="divider"></div>
	</div>
</div>

@if($aspirant->AspirantsFile)
	@if($aspirant->AspirantsFile->proof)
	<div class="row">
		<div class="col-sm-7 col-sm-offset-1">
			<h2><span class="notes">Aspirante:</span> <br> <strong>{{ $aspirant->name.' '.$aspirant->surname.' '.$aspirant->lastname }}</strong></h2>
		</div>
		<div class="col-sm-3">
			<h3><span class="notes">Domicilio:</span> <br>{{ $aspirant->city }}, {{ $aspirant->state }}</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
		@include('admin.aspirants.evaluation.form.proof-form')
		</div>
		<div class="clearfix"></div>
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

@endsection

@section('js-content')
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
$(document).ready(function() {
  $('.address_proof').click(function(event) {
     $('.address_proof').not(this).attr('checked', false);
     $(this).attr('checked', true);
   });
});
</script>
@endsection
