@extends('layouts.admin.a_master')
@section('title', 'Convocatoria '.$notice->title )
@section('description', 'Convocatoria '.$notice->title)
@section('body_class', 'aspirante convocatoria')
@section('breadcrumb_type', 'notice view')
@section('breadcrumb', 'layouts.aspirant.breadcrumb.b_notices')

@section('content')

<!-- title -->
<div class="row">
	<div class="col-sm-12">
    	<h3 class ="center">Convocatoria</h3>
		<h1 class="center">{{$notice->title}}</h1>
		<p class="center date">{{date("d-m-Y", strtotime($notice->start))}} al {{date('d-m-Y', strtotime($notice->end))}}</p>

	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="divider top"></div>
	</div>
	<div class="col-sm-4">
		<h3>Objetivo</h3>
		<p>{{$notice->objective}}</p>
	</div>
	<div class="col-sm-4">
		<h3>Descripción</h3>
		<p>{{$notice->description}}</p>
	</div>
	<div class="col-sm-4">
		<h3>Modalidad y resultados esperados</h3>
		<p>{{$notice->modality_results}}</p>
	</div>
</div>


<div class="row">
	<div class="col-sm-12">
		<div class="divider top"></div>
	</div>
	<div class="col-sm-4">
		<h3>Perfil de egreso</h3>
		<p>{{$notice->profile}}</p>
	</div>
	<div class="col-sm-4">
		<h3>Perfil y elegibilidad de los participantes</h3>
		<p>{{$notice->profile_eligibility_description}}</p>
	</div>
	<div class="col-sm-4">
		<h3>Plazos y procesos de postulación</h3>
		<p>{{$notice->term_process}}</p>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="divider top"></div>
	</div>
	<div class="col-sm-4">
		<h3>Perfil de egreso</h3>
		<p>{{$notice->profile}}</p>
	</div>
	<div class="col-sm-4">
		<h3>Perfil y elegibilidad de los participantes</h3>
		<p>{{$notice->profile_eligibility_description}}</p>
	</div>
	<div class="col-sm-4">
		<h3>Plazos y procesos de postulación</h3>
		<p>{{$notice->term_process}}</p>
	</div>
</div>

@endsection
