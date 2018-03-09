@extends('layouts.admin.a_master')
@section('title', 'Ver módulo '. $module->title)
@section('description', 'Ver módulo')
@section('body_class', 'modulos view')
@section('breadcrumb_type', 'module view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')
@section('content')


<div class="ap_when">
	<p><b class="danger"></b><strong>Fecha límite</strong>: Los fellows deben cumplir con esta tarea el {{date("d-m-Y", strtotime($module->end))}}, 11:59 pm, hora de la Ciudad de México ({{ \Carbon\Carbon::createFromTimeStamp(strtotime($module->end))->diffForHumans()}}) </p>
</div>

<!-- title -->
<div class="row">
	<div class="col-sm-12">
		<h1>{{$module->title}} <span class="le_link"><a href='{{url("dashboard/programas/{$program->id}/modulos/editar/$module->id")}}' class="btn view">Editar Módulo</a></span></h1>
		<div class="divider top"></div>
	</div>
	<!-- header -->
	<div class="row h_tag">
		<div class="col-sm-4 center">
			<h4><b class="icon_h time"></b> Duración</h4>
			<p>{{$module->number_hours}} horas</p>
		</div>
		<div class="col-sm-4 center">
			<h4><b class="icon_h modalidad"></b> Modalidad</h4>
			<p>{{$module->modality}}</p>
		</div>
		<div class="col-sm-4 center">
			<h4><b class="icon_h {{$module->public ? 'publicado' : 'no_p'}} "></b>Publicado</h4>
			<p> <span class="published {{$module->public ? 'view' : ''}}">{{$module->public ? 'Sí' : 'No'}}</span></p>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="divider"></div>
		<p class="ap_objective"><strong>Objetivo:</strong> {{$module->objective}}</p>
	</div>
	
	<!--facilitadores-->
	<div class="col-sm-3">
		<p><strong>Facilitadores:</strong></p>
	</div>

	<div class="col-sm-9">
		@if($module->unique_facilitators->count() > 0)
			@foreach ($module->unique_facilitators as $facilitator)
				<div class="ap_facilitator_list" data-name="{{$facilitator->user->name}}">
					<figure>
						@if($facilitator->user->image)
						<img src='{{url("img/users/{$facilitator->user->image->name}")}}' height="45px">
						@else
						<img src='{{url("img/users/default.png")}}' height="45px">
						@endif
					</figure>
				</div>
			@endforeach
		@else
			<p>Aún no han sido asignados facilitadores</p>
		@endif
	</div>
</div>


<!---------------------------------------------- sesiones--->
<div class="row">
	<div class="col-sm-12">
		<div class="divider"></div>
		<h2 class="center">Sesiones del módulo</h2>
		<p class="center"><a href='{{url("dashboard/programas/$program->id/modulos/$module->id/sesiones/agregar")}}' class="btn xs ev">+ Agregar sesión</a></p>
	</div>
</div>

<!-- lista de sesiones-->
@if($module->sessions->count() > 0)
<div class="box session_list last_activity ap_week admin">
    @foreach($module->sessions as $session)
		@include('admin.modules.includes.activities_list')		
    @endforeach
</div>
@else
<div class="box">
	<div class="row center">
		<h2>Sin sesiones</h2>
		<p><a href='{{url("dashboard/programas/$program->id/modulos/$module->id/sesiones/agregar")}}' class="btn xs view">Agregar sesión</a></p>
	</div>
</div>
@endif


@endsection