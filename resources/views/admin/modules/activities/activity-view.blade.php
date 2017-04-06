@extends('layouts.admin.a_master')
@section('title', 'Ver sesión')
@section('description', 'Ver sesión')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Información de actividad</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-6">
			<ul class="profile list">
				<li><span>Nombre:</span> <h2>{{$activity->name}}</h2></li>
				<li><span>Número de actividad:</span> {{$activity->order}}</li>
				<li><span>Duración:</span> {{$activity->duration}}</li>
				<li><span>Descripción:</span>{{$activity->description}}</li>
        <li><span>Rol Facilitador:</span>{{$activity->facilitator_role}}</li>
        <li><span>Rol Participantes:</span>{{$activity->competitor_role}}</li>
			</ul>
		</div>
		<div class="col-sm-6">
			<ul class="profile list">
				<li class="right"><span>Recursos y requerimientos técnicos</span>
				<a href='{{ url("dashboard/sesiones/actividades/requerimientos/agregar/$activity->id") }}' class="btn xs view">Agregar</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="row">
  <div class="col-sm-12">
    <h1>Recursos y requerimientos técnicos</h1>
  </div>
</div>
@if($activity->activityRequirements->count() > 0)
        @include('admin.modules.activities.activities-requirements-list')
@else
<div class="box">
  <div class="row">
        <span>Sin requerimientos</span></br>
        <a href='{{url("dashboard/sesiones/actividades/requerimientos/agregar/$activity->id")}}' class="btn xs view">Agregar</a>
    </ul>
  </div>
</div>
@endif
@endsection
