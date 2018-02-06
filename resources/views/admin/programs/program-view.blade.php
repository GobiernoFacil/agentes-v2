@extends('layouts.admin.a_master')
@section('title', 'Ver programa '. $program->title)
@section('description', 'Ver programa')
@section('body_class', 'program view')
@section('breadcrumb_type', 'program view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')
@section('content')

<!-- title -->
<div class="row">
	<div class="col-sm-12">
		<h1 class="center">{{$program->title}} <span class="le_link"><a href="{{url('dashboard/programas/editar/' . $program->id)}}" class="btn view">Editar Programa</a></span></h1>
		<p class="center date">{{date("d-m-Y", strtotime($program->start))}} al {{date('d-m-Y', strtotime($program->end))}}</p>
		<div class="divider"></div>
	</div>
</div>
<!-- header -->
<div class="row h_tag">
	<div class="col-sm-3 center">
		<h4><b class="icon_h time"></b> Duración</h4>
		<p>{{$program->number_hours}} horas</p>
	</div>
	<div class="col-sm-3 center">
		<h4><b class="icon_h session"></b> # Módulos</h4>
		<p>{{$program->modules->count()}}</p>
	</div>
	<div class="col-sm-3 center">
		<h4><b class="icon_h {{$program->public ? 'publicado' : 'no_p'}} "></b>Publicado</h4>
		<p> <span class="published {{$program->public ? 'view' : ''}}">{{$program->public ? 'Sí' : 'No'}}</span></p>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="divider top"></div>
	</div>
	<div class="col-sm-4">
		<h3>Descripción</h3>
		<p>{{$program->description}}</p>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="divider"></div>
		<h2 class="center">Módulos del programa</h2>
		<p class="center"><a href='{{url("dashboard/programas/$program->id/modulos/agregar")}}' class="btn xs ev">+ Agregar módulo</a></p>
	</div>
</div>


@if($program->modules->count() > 0)
@foreach ($program->modules as $module)
<div class="box session_list">
	<div class="row">
		<!--icono-->
		<div class="col-sm-1 right">
			<b class="icon_h session list_s"></b>
		</div>
		<div class="col-sm-9">
			<h3>Módulo {{$module->order}}</h3>
			<h2><a href='{{ url("dashboard/programas/$program->id/modulos/ver/$module->id") }}'>{{$module->title}}</a>  <span class="le_link"><a href='{{ url("dashboard/programas/$program->id/modulos/editar/$module->id") }}' class="btn xs ev">Actualizar módulo</a></span></h2>
			<div class="divider"></div>
			<div class="row">
				<div class="col-sm-9">
					<p>{{$module->objective}}</p>
				</div>
				<div class="col-sm-3 notes">
					<p class="right">Fechas:<br>{{date("d-m-Y", strtotime($module->start))}} al {{date('d-m-Y', strtotime($module->end))}}</p>
				</div>
			</div>
		</div>
		<!-- ver módulo-->
		<div class="col-sm-2">
			<a class="btn view block sessions_l"  href='{{ url("dashboard/programas/$program->id/modulos/ver/$module->id") }}'>Ver módulo</a>
			<a href ='{{ url("dashboard/programas/$program->id/modulos/eliminar/$module->id") }}'  id ="{{$module->id}}" class="btn gde danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a>
		</div>

		<div class="footnote">
			<div class="row">
				<div class="col-sm-2">
					<p><b class="icon_h time"></b>{{$module->number_hour}} {{$module->mesasure === 0 ? "Minutos" : $module->mesasure === 1 ? "Horas" : ""}} </p>
				</div>
				<div class="col-sm-2">
					<p><b class="icon_h modalidad"></b>{{$module->modality}}</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endforeach
@else
<div class="box">
	<div class="row center">
		<h2>Sin módulos</h2>
		<p><a href='{{url("dashboard/programas/$program->id/modulos/agregar")}}' class="btn xs view">Agregar módulo</a></p>
	</div>
</div>
@endif
@endsection
