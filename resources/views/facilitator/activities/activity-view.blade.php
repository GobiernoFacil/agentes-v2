@extends('layouts.admin.a_master')
@section('title', 'Ver actividad: ' . $activity->name)
@section('description', 'Ver actividad')
@section('body_class', 'actividades')
@section('breadcrumb_type', 'activity view')
@section('breadcrumb', 'layouts.facilitator.breadcrumb.b_activity')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<?php switch($activity->type) {
			case "lecture":
				$type = "Lectura";
				break;
			case "video":
				$type = "Video";
				break;
			case "evaluation":
				$type = "Evaluación";
				break;
			default:
			 $type = "Lectura";
		}
		?>
		<h4>Actividad #{{$activity->order}} de  <a href="{{ url('tablero-facilitador/actividades/sesion/'. $session->id) }}" class="link">sesión {{$session->order}}</a> del módulo: {{$session->module->title}}</h4>
		<div class="divider b"></div>
		<h1><b class="icon_h {{$activity->type ? $activity->type  : 'default'}} list_s width_s"></b> {{$type}}: <strong>{{$activity->name}}</strong> <span class="notetime">(<b class="icon_h time"></b>{{$activity->duration}})</span></h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<ul class="profile list row">
				<li class="col-sm-12"><span>Descripción:</span>{{$activity->description}}</li>
				<li class="col-sm-6"><span>Rol Facilitador:</span>{{$activity->facilitator_role}}</li>
				<li class="col-sm-6"><span>Rol Participantes:</span>{{$activity->competitor_role}}</li>
			</ul>
		</div>

	</div>
</div>

@if($activity->activityRequirements->count() > 0)
<!---Recursos-->
<div class="box">
  <div class="row">
  	<div class="col-sm-12">
  		<h2 class="title">Recursos</h2>
  		@include('admin.modules.activities.activities-requirements-list')
  	</div>  	
  </div>
</div>
@endif


@if($activity->activityFiles->count() > 0)
<!--archivos-->
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="title">Archivos</h2>
			@include('admin.modules.activities.activities-files-list')
		</div>
	</div>
</div>
@endif

@endsection