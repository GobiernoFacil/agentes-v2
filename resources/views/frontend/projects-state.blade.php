@extends('layouts.frontend.master')
@section('title', "Conoce los proyectos del estado de {$state} del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible")
@section('description', "Conoce los proyectos del estado de {$state} del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible")
@section('body_class', 'programa aliados')
@section('canonical', url('proyectos-de-aceleracion-y-red-de-ga-y-ds'))

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>Proyecto de aceleración y Red de Gobierno Abierto y Desarrollo Sostenible del estado de <strong>{{$state}}</strong></h1>
		<h2></h2>
    <div class="row">
			<div class="col-sm-9">
				<?php $info_name = 'SpreadS_'.$slug_n.'_CRVS.jpg'; ?>
				<img src="/archivos/estados/{{$slug}}/{{$info_name}}">
				<?php $info_name = 'SpreadS_'.$slug_n.'_CRVS_2.jpg'; ?>
				<img src="/archivos/estados/{{$slug}}/{{$info_name}}">
				<div class="divider"></div>
			</div>

			<div class="col-sm-3">
				<a href="{{url('red-de-gobierno-abierto-desarrollo-sostenible-de-las-americas')}}" class="icon i_antecedentes">Red de Gobierno Abierto y Desarrollo Sostenible de las Américas</a>
				<a href="{{url('programa-gobierno-abierto/alcance')}}" class="icon i_alcance"><span>ALCANCE DEL PROGRAMA</span></a>
				<a href="{{url('programa-gobierno-abierto/aliados')}}" class="icon i_aliados">CONOCE A LOS ALIADOS</a>
				<a href="{{url('programa-gobierno-abierto/antecedentes')}}" class="icon i_antecedentes">ANTECEDENTES</a>
			</div>

		</div>

		<div class="row">
			<div class="col-sm-9 col-sm-offset-3">
				<a href='{{url("proyectos-de-aceleracion/$slug/archivos")}}' class ="btn blue center">Descargar documentos</a>
			</div>
		</div>

	</div>
</div>
@endsection
