@extends('layouts.admin.a_master')
@section('title', $module->title )
@section('description', $module->objective)
@section('body_class', 'fellow aprendizaje modulos')
@section('breadcrumb_type', 'module view')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_modules')

@section('content')

<div class="ap_when">
	<p><b class="danger"></b><strong>Fecha límite</strong>: Debes cumplir con esta tarea el {{date("d-m-Y", strtotime($module->end))}}, 11:59 pm, hora de la Ciudad de México ({{ \Carbon\Carbon::createFromTimeStamp(strtotime($module->end))->diffForHumans()}}) </p>
</div>

{{$module}}


<!-- title -->
<div class="row">
	<div class="col-sm-12">
    	<h3 class ="center">Módulo {{$module->order}}</h3>
		<h1 class="center">{{$module->title}}</h1>
		<p class="center date">{{date("d-m-Y", strtotime($module->start))}} al {{date('d-m-Y', strtotime($module->end))}}</p>
		<div class="divider"></div>
	</div>
</div>

<!-- header -->
<div class="row h_tag">
	<div class="col-sm-3 center">
		<h4><b class="icon_h time"></b> Duración</h4>
		<p>{{$module->number_hours}} horas</p>
	</div>
	<div class="col-sm-3 center">
		<h4><b class="icon_h session"></b> # Sesiones</h4>
		<p>{{$module->number_sessions}}</p>
	</div>
	<div class="col-sm-3 center">
		<h4><b class="icon_h modalidad"></b> Modalidad</h4>
		<p>{{$module->modality}}</p>
	</div>
	<div class="col-sm-3 center">
		<h4><b class="icon_h {{$module->public ? 'publicado' : 'no_p'}} "></b>Activo</h4>
		<p> <span class="published {{$module->public ? 'view' : ''}}">{{$module->public ? 'Sí' : 'No'}}</span></p>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="divider top"></div>
	</div>
	<div class="col-sm-4">
		<h3>Objetivo</h3>
		<p>{{$module->objective}}</p>
	</div>
	<div class="col-sm-4">
		<h3>Situación didáctica</h3>
		<p>{{$module->teaching_situation}}</p>
	</div>
	<div class="col-sm-4">
		<h3>Productos a desarrollar</h3>
		<p>{{$module->product_developed}}</p>
	</div>
</div>


<!-- sesiones-->
<div class="row">
	<div class="col-sm-12">
		<div class="divider"></div>
		<h2 class="center">Sesiones del módulo</h2>
	</div>
</div>

<!-- lista de sesiones-->
@if($module->sessions->count() > 0)
    @foreach($module->sessions as $session)
    <div class="box session_list">
	  	<div class="row">
			<!--icono-->
			<div class="col-sm-1 right">
				<b class="icon_h session list_s"></b>
			</div>
			<div class="col-sm-9">
				<h3>Sesión {{$session->order}}</h3>
				<h2><a href='{{ url("tablero/aprendizaje/{$module->slug}/{$session->slug}") }}'>{{$session->name}}</a></h2>
				<div class="divider"></div>
					<div class="row">
						<div class="col-sm-9">
							<p>{{$session->objective}}</p>
						</div>
						<div class="col-sm-3 notes">
							<p class="right">Fechas:<br>{{date("d-m-Y", strtotime($session->start))}} al {{date('d-m-Y', strtotime($session->end))}}</p>
						</div>
					</div>
				</div>
				<!-- ver sesión-->
				@if($today >= $session->start)
				<div class="col-sm-2">
					<a class="btn view block sessions_l"  href='{{ url("tablero/aprendizaje/{$module->slug}/{$session->slug}") }}'>Ver sesión</a>
				</div>
				@else
				<div class="col-sm-2">
					<a class="btn view block sessions_l"  href='{{ url("tablero/aprendizaje/{$module->slug}/{$session->slug}") }}'>Revisar sesión</a>
				</div>
				@endif
				<!-- footnote-->
				<div class="footnote">
					<div class="row">
						<div class="col-sm-2">
							<p><b class="icon_h time"></b>{{$session->hours}} h </p>
						</div>
						<div class="col-sm-2">
							<p><b class="icon_h modalidad"></b>{{$session->modality}}</p>
						</div>
						<div class="col-sm-6">
							@if($session->facilitators->count() > 0)
							<p><strong>{{$session->facilitators->count() == 1 ? 'Facilitador' : 'Facilitadores' }}:</strong></p>
							<ul class="list-facilitator">
							@foreach ($session->facilitators as $facilitator)
								<li class="row">
								<span class="col-sm-2 right">
								@if($facilitator->user->image)
								<img src='{{url("img/users/{$facilitator->user->image->name}")}}' height="30px">
								@else
								<img src='{{url("img/users/default.png")}}' height="30px">
								@endif
								</span>
								<span class="col-sm-10">
								 {{$facilitator->user->name}} -  {{$facilitator->user->institution == "Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales" ? "INAI" : $facilitator->user->institution}}
								</span>
								</li>
							@endforeach
							</ul>
							@endif
						</div>
						<div class="col-sm-2">
							<p class="right">{{$session->activities->count() == 1 ? $session->activities->count(). " actividad" : $session->activities->count(). " actividades"}}  </p>
						</div>
					</div>
				</div>
			</div>
		</div>
    @endforeach
@else
<div class="box">
	<div class="row center">
		<h2>Sin sesiones</h2>
	</div>
</div>
@endif

@endsection
