@extends('layouts.admin.a_master')
@section('title', 'Lista de Actividades')
@section('description', 'Lista de actividades asignadas a ti')
@section('body_class', 'actividades')
@section('breadcrumb_type', 'activities list')
@section('breadcrumb', 'layouts.facilitator.breadcrumb.b_activity')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Actividades</h1>
		<h3>Aquí encontrarás tus sesiones activas en la plataforma</h3>

@if($sessions->count() > 0)
@foreach ($sessions as $session)
<div class="box session_list">
	<div class="row">
		<!--icono-->
		<div class="col-sm-1 right">
			<b class="icon_h session list_s"></b>
		</div>
		<div class="col-sm-9">
			<h3>Sesión </h3>
			<h3>{{$session->session->module->program->title}}</h3>
			<h2>{{$session->session->module->title}} </h2>
			<h1>{{$session->session->name}} </h1>
		</div>
		<!-- ver sesión-->
		<div class="col-sm-2">
			{{$session->activity}}
			<a class="btn view block sessions_l"  href="{{ url('tablero-facilitador/actividades/sesion/' . $session->session->id) }}">Ver sesión</a>
		</div>

		<div class="footnote">
			<div class="row">
				<div class="col-sm-3">
					<p class="left">{{$session->session->activities->count() == 1 ? $session->session->activities->count(). " actividad" : $session->session->activities->count(). " actividades"}}  </p>
				</div>
				<div class="col-sm-8 notes">
					<p class="right">Fechas:<br>{{date("d-m-Y", strtotime($session->session->module->start))}} al {{date('d-m-Y', strtotime($session->session->module->end))}}</p>
				</div>
			</div>
		</div>
	</div>
	<div class="divider"></div>
</div>
@endforeach

		{{ $sessions->links() }}
@else

		<div class="box center">
			<h2>Aún no te han asignado actividades</h2>
		</div>

@endif








	</div>
</div>
@endsection
