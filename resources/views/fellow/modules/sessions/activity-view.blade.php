@extends('layouts.admin.a_master')
@section('title', $activity->name )
@section('description', $activity->name)
@section('body_class', 'fellow aprendizaje modulos')
@section('breadcrumb_type', 'session view')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_modules')

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
		<h4>Actividad #{{$activity->order}} de la <a href="{{ url('tablero/aprendizaje/'.$session->module->slug.'/'. $session->slug) }}" class="link">sesión {{$session->order}}</a> del <a href="{{ url('tablero/aprendizaje/'.$session->module->slug) }}" class="link">módulo: {{$session->module->title}}</a></h4>
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
<!-- recursos-->
<div class="box">
	<div class="row">
		<div class="col-sm-9">
			<h2 class="title">Recursos</h2>
  		</div>
  		<div class="col-sm-12">  
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