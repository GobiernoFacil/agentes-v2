@extends('layouts.admin.a_master')
@section('title', 'Lista de sesiones')
@section('description', 'Lista de sesiones asignadas a ti')
@section('body_class', 'modulos')
@section('breadcrumb_type', 'module session assign')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Sesiones asignadas</h1>

@if($sessions->count() > 0)
@foreach ($sessions as $session)
<div class="box session_list">
	<div class="row">
		<!--icono-->
		<div class="col-sm-1 right">
			<b class="icon_h session list_s"></b>
		</div>
		<div class="col-sm-9">
			<h3>Sesión {{$session->session->order}}</h3>
			<h2><a href='{{ url("dashboard/programas/$program->id/modulos/{$session->session->module->id}/sesiones/ver/{$session->session->id}") }}'>{{$session->session->name}}</a> </h2>
			<div class="divider"></div>
			<div class="row">
				<div class="col-sm-9">
					<p><strong>Módulo</strong>: {{$session->session->module->title}} </p>
					<p>{{$session->session->activities->count() == 1 ? $session->session->activities->count() .' actividad' : $session->session->activities->count() .' actividades'}}</p>
				</div>
				<div class="col-sm-3 notes">
					<p class="right">Fechas:<br>{{date("d-m-Y", strtotime($session->session->module->start))}} al {{date('d-m-Y', strtotime($session->session->module->end))}}</p>
				</div>
			</div>
		</div>
		<!-- ver sesión-->
		<div class="col-sm-2">
			{{$session->activity}}
			<a class="btn view block sessions_l"  href='{{ url("dashboard/programas/$program->id/modulos/{$session->session->module->id}/sesiones/ver/{$session->session->id}") }}'>Ver sesión</a>
		</div>

	</div>
</div>
@endforeach

		{{ $sessions->links() }}
@else

		<div class="box center">
			<h2>Aún no te han asignado sesiones</h2>
		</div>

@endif








	</div>
</div>
@endsection
