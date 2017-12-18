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
		<div class="divider"></div>
	</div>
</div>

<!-- header -->
<div class="row h_tag">
	<div class="col-sm-3 center">
		<h4><b class="icon_h time"></b> Duración</h4>
		<p>{{$notice->number_hours}} horas</p>
	</div>
	<div class="col-sm-3 center">
		<h4><b class="icon_h session"></b> # Sesiones</h4>
		<p>{{$notice->number_sessions}}</p>
	</div>
	<div class="col-sm-3 center">
		<h4><b class="icon_h modalidad"></b> Modalidad</h4>
		<p>{{$notice->modality}}</p>
	</div>
	<div class="col-sm-3 center">
		<h4><b class="icon_h {{$notice->public ? 'publicado' : 'no_p'}} "></b>Activo</h4>
		<p> <span class="published {{$notice->public ? 'view' : ''}}">{{$notice->public ? 'Sí' : 'No'}}</span></p>
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
		<h3>Situación didáctica</h3>
		<p>{{$notice->teaching_situation}}</p>
	</div>
	<div class="col-sm-4">
		<h3>Productos a desarrollar</h3>
		<p>{{$notice->product_developed}}</p>
	</div>
</div>


@endsection
