@extends('layouts.admin.a_master')
@section('title', 'Ver facilitador')
@section('description', 'Ver facilitador de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', '')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Ver Facilitador</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-5 col-sm-offset-1">
			<ul class="profile list">
				<li><h2>{{$facilitator->name}}</h2></li>
				<li><span>email</span>{{$facilitator->email}}</li>
				<li><span>Asociación</span> {{$facilitator->institution}}</li>
				<li><span>Fecha de creación</span>{{ date("d-m-Y, H:i", strtotime($facilitator->created_at)) }} hrs.</li>
				<li><span>Última actualización</span>{{ date("d-m-Y, H:i", strtotime($facilitator->updated_at)) }} hrs.</li>
			</ul>
		</div>
		<div class="col-sm-5">
			<ul class="profile list">
				<li class="right">
				<a href="{{ url('dashboard/facilitadores/editar/' . $facilitator->id ) }}" class="btn xs view">Editar Facilitador</a></li>
			</ul>
		</div>
	</div>
</div>

@endsection
