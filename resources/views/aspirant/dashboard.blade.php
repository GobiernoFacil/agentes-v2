@extends('layouts.admin.fellow_master')
@section('title', 'Tablero de Control')
@section('description', 'Tablero de control de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'dashboard')

@section('content')

 @if($notice)
 	@include('aspirant.title_layout')
		<div class="row">
			<div class="col-sm-12">
				<h2>Exposición de motivos</h2>
				@include('aspirant.notices.forms.apply-1')
		</div>
	@else
		<div class="row">
			<div class="col-sm-12">
				<h2>La convocatoria ha terminado</h2>
		</div>
	@endif
@endsection

 @if($notice)
		@section('js-content')
		<script>
					// Set the date we're counting down to
					var countDownDate = new Date("{{ date('M j, Y',strtotime($single->notice->end)) }} 23:59:59").getTime();
					$('#filesForm').submit(function() {
						 var words = $("#motives").val();
						 if(words.split(' ').length <= 400){
							 return true;
						 }else{
							 $("#maxWords").show();
							 $("#nbwords").text(words.split(' ').length);
							 return false;
						 }
				     return true;
					 });
		</script>
		<script src="{{url('js/countdown.js')}}"></script>
		@endsection
@endif
