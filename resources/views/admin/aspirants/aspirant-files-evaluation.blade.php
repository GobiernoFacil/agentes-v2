@extends('layouts.admin.a_master')
@section('title', 'Lista de Aspirantes')
@section('description', 'Lista de Aspirantes')
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirantes evaluar')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_aspirantes')

@section('content')

@if($files)
	<div class="row">
		<div class="col-sm-9">
			<h1>Evaluar archivos de: <strong>{{ $aspirant->name }} {{ $aspirant->surname }} {{ $aspirant->lastname }}</strong></h1>
		</div>
		<div class="col-sm-3">
			<h4 class="right">{{ $aspirant->city }}, {{ $aspirant->state }} </h4>
		</div>
	</div>

	<div class="row">
		<div class="box">
			<div class="col-sm-10 col-sm-offset-1">
			  @include('admin.aspirants.form.files-evaluation-form')
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
@else
	<h1>El aspirante no cuenta con archivos</h1>
	<div class="box">
		<p>{{ $aspirant->name }} {{ $aspirant->surname }} {{ $aspirant->lastname }} no adjunto archivos, por lo que no puede ser evaluado.</p>
		<p><a href="{{ url('dashboard/aspirantes') }}" class="btn">&lt;&lt; Regresar a lista de aspirantes.</a></p>
	</div>
@endif

@endsection
