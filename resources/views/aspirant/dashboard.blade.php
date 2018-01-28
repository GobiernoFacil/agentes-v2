@extends('layouts.admin.fellow_master')
@section('title', 'Tablero de Control')
@section('description', 'Tablero de control de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'dashboard')

@section('content')

@include('aspirant.title_layout')

<div class="row">
	<div class="col-sm-12">
		<h2>Exposición de motivos</h2>
		@include('aspirant.notices.forms.apply-1')
</div>
@endsection
@section('js-content')
<script>
	// Set the date we're counting down to	
	var countDownDate = new Date("{{ date('M j, Y',strtotime($single->notice->end)) }} 23:59:59").getTime();
</script>
<script src="{{url('js/countdown.js')}}"></script>
@endsection