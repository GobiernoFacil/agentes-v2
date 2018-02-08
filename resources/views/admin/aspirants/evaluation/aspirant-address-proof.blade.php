@extends('layouts.admin.a_master')
@section('title', 'Verificar comprobante de domicilio de '.$aspirant->name)
@section('description', 'Verificar comprobante de domicilio de '.$aspirant->name)
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirantes evaluar-comprobante')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_aspirantes')

@section('content')

@if($aspirant->check_address_proof->count() <= 0)
	@if($aspirant->AspirantsFile->proof)
	<div class="row">
		<div class="col-sm-9">
			<h1>Aspirante  <strong>{{ $aspirant->name.' '.$aspirant->surname.' '.$aspirant->lastname }}</strong></h1>
		</div>
		<div class="col-sm-3">
			<h4 class="right">{{ $aspirant->city }}, {{ $aspirant->state }} </h4>
		</div>
	</div>

	<div class="row">
		<div class="box">
			<div class="col-sm-10 col-sm-offset-1">
			@include('admin.aspirants.evaluation.form.proof-form')
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	@else
	<h1>El aspirante no cuenta con un comprobante de domicilio</h1>
	<div class="box">
		<p>{{ $aspirant->name }} {{ $aspirant->surname }} {{ $aspirant->lastname }} , no puede ser evaluado ya que su documentación no es válida.</p>
		<p><a href='{{ url("dashboard/aspirantes/convocatoria/$notice->id")}}' class="btn">&lt;&lt; Regresar a lista de aspirantes.</a></p>
	</div>
	@endif
@else
	<h1>El aspirante ya ha sido validado</h1>
	<div class="box">
		<p><a href='{{ url("dashboard/aspirantes/convocatoria/$notice->id")}}' class="btn">&lt;&lt; Regresar a lista de aspirantes.</a></p>
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
