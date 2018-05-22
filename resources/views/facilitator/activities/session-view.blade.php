@extends('layouts.admin.a_master')
@section('title', 'Ver sesión')
@section('description', 'Ver sesión')
@section('body_class', 'actividades')
@section('breadcrumb_type', 'session view')
@section('breadcrumb', 'layouts.facilitator.breadcrumb.b_activity')

@section('content')


<div class="ap_when">
	<p><b class="danger"></b><strong>Fecha límite</strong>: Los fellows deben cumplir con esta tarea el {{date("d-m-Y", strtotime($session->module->end))}}, 11:59 pm, hora de la Ciudad de México ({{ \Carbon\Carbon::createFromTimeStamp(strtotime($session->module->end))->diffForHumans()}}) </p>
</div>

<!-- title -->
<div class="row">
	<div class="col-sm-12">
		<h1>{{$session->module->title}}</h1>
		<div class="divider top"></div>
	</div>
	<!-- header -->
	<div class="row h_tag">
		<div class="col-sm-4 center">
			<h4><b class="icon_h time"></b> Duración</h4>
			<p>{{$session->module->duration_hours() ? $session->module->duration_hours() > 1 ? number_format($session->module->duration_hours(),2).' h':$session->module->duration_minutes().' min' :'No aplica'}}</p>
		</div>
		<div class="col-sm-4 center">
			<h4><b class="icon_h modalidad"></b> Modalidad</h4>
			<p>{{$session->module->modality}}</p>
		</div>
		<div class="col-sm-4 center">
			<h4><b class="icon_h {{$session->module->public ? 'publicado' : 'no_p'}} "></b>Publicado</h4>
			<p> <span class="published {{$session->module->public ? 'view' : ''}}">{{$session->module->public ? 'Sí' : 'No'}}</span></p>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="divider"></div>
		<p class="ap_objective"><strong>Objetivo:</strong> {{$session->module->objective}}</p>
	</div>

	<!--facilitadores-->
	<div class="col-sm-3">
		<p><strong>Facilitadores:</strong></p>
	</div>

	<div class="col-sm-9">
		@if($session->module->unique_facilitators->count() > 0)
			@foreach ($session->module->unique_facilitators as $facilitator)
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
		<h2 class="center">Tu sesión del módulo</h2>
	</div>
</div>

<div class="box session_list last_activity ap_week admin">
			@include('facilitator.activities.activities_list_inside')
</div>


@endsection
