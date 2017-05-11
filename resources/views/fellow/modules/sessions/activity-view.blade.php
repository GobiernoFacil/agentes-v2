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
		<h4>Actividad #{{$activity->order}} de la <a href="{{ url('/dashboard/sesiones/ver/'. $session->id) }}" class="link">sesión {{$session->order}}</a> del <a href="{{ url('dashboard/modulos/ver/'.$session->module->id) }}" class="link">módulo: {{$session->module->title}}</a></h4>
		<div class="divider b"></div>
		<h1><b class="icon_h {{$activity->type ? $activity->type  : 'default'}} list_s width_s"></b> {{$type}}: <strong>{{$activity->name}}</strong> <span class="notetime">(<b class="icon_h time"></b>{{$activity->duration}})</span></h1>
	</div>
</div>







@endsection
