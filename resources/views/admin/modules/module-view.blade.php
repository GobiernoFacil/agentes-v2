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
<div class="box session_list last_activity ap_week">
    @foreach($module->sessions as $session)
    <h2>{{$session->name}}</h2>
    @if($session->activities->count() > 0)
    <ul class="ap_list">
    	@foreach ($session->activities as $activity)
    	<li class="row">
    		<span class="col-sm-9">
    			<b class="{{$activity->type}}"><span class="{{ $activity->type == "video" ? 'arrow-right' : '' }}"></span></b>
    			<a href="{{ url('dashboard/sesiones/actividades/ver/'. $activity->id) }}">{{$activity->name}} <span class="notes">{{$activity->duration}} min.</span></a>
    		</span>
    		@if($activity->type == "evaluation")
    		<span class="col-sm-3">
    			<p class="right"> Fecha límite:
    			 <strong>{{date("d-m-Y", strtotime($activity->end))}}</strong><br>
    			 <span class="notes">({{ \Carbon\Carbon::createFromTimeStamp(strtotime($activity->end))->diffForHumans()}})</span>
    			</p>
    		</span>
    		@endif
    	</li>
    	@endforeach
    </ul>
    @endif

    @endforeach
</div>
@else
<div class="box">
	<div class="row center">
		<h2>Sin sesiones</h2>
	</div>
</div>
@endif

@if($module->sessions->count() > 0)
@foreach ($module->sessions as $session)
<div class="box session_list">
	<div class="row">
		<!--icono-->
		<div class="col-sm-1 right">
			<b class="icon_h session list_s"></b>
		</div>
		<div class="col-sm-9">
			<h3>Sesión {{$session->order}}</h3>
			<h2><a href="{{ url('dashboard/sesiones/ver/' . $session->id) }}">{{$session->name}}</a>  <span class="le_link"><a href='{{url("dashboard/programas/$program->id/modulos/$module->id/sesiones/editar/$session->id")}}' class="btn xs ev">Actualizar sesión</a></span></h2>
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
		<div class="col-sm-2">
			<a class="btn view block sessions_l"  href='{{url("dashboard/programas/$program->id/modulos/$module->id/sesiones/ver/$session->id")}}'>Ver sesión</a>
			<a href ='{{url("dashboard/programas/$program->id/modulos/$module->id/sesiones/eliminar/$session->id")}}'  id ="{{$session->id}}" class="btn gde danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a>
		</div>

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
					<p><strong>{{$session->facilitators->count() == 1 ? 'Facilitador' : 'Facilitadores' }}:</strong>
					@foreach ($session->facilitators as $facilitator)
						@if($facilitator->user->image)
						<img src='{{url("img/users/{$facilitator->user->image->name}")}}' height="30px">
						@else
						@endif
						 {{$facilitator->user->name}} -  {{$facilitator->user->institution}} <br>
					@endforeach
					</p>
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
		<p><a href='{{url("dashboard/programas/$program->id/modulos/$module->id/sesiones/agregar")}}' class="btn xs view">Agregar sesión</a></p>
	</div>
</div>
@endif
@endsection
