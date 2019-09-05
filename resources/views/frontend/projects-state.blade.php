@extends('layouts.frontend.master')
@section('title', "Conoce los proyectos del estado de {$state} del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible")
@section('description', "Conoce los proyectos del estado de {$state} del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible")
@section('body_class', 'programa aliados')
@section('canonical', url('proyectos'))

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>PROGRAMA DE FORMACIÓN DE <strong>AGENTES LOCALES DE CAMBIO</strong> EN <strong>GOBIERNO ABIERTO</strong> Y DESARROLLO SOSTENIBLE</h1>
		<h2>Proyectos del estado de {{$state}}</h2>
    <div class="row">
			<div class="col-sm-9">

				<?php $info_name = 'SpreadS_'.$slug_n.'_CRVS.jpg'; ?>
				<img src="/archivos/estados/{{$slug}}/{{$info_name}}">
				<?php $info_name = 'SpreadS_'.$slug_n.'_CRVS_2.jpg'; ?>
				<img src="/archivos/estados/{{$slug}}/{{$info_name}}">
			</div>

			<div class="col-sm-3">
				<h2></h2>
				<a href="{{url('programa-gobierno-abierto/alcance')}}" class="icon i_alcance"><span>ALCANCE DEL PROGRAMA</span></a>
				<a href="{{url('programa-gobierno-abierto/aliados')}}" class="icon i_aliados">CONOCE A LOS ALIADOS</a>
				<a href="{{url('programa-gobierno-abierto/antecedentes')}}" class="icon i_antecedentes">ANTECEDENTES</a>
			</div>

		</div>

	</div>
</div>
@endsection
