@extends('layouts.frontend.master')
@section('title', 'Red de Gobierno Abierto y Desarrollo Sostenible de las Américas del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Conoce la Red de Gobierno Abierto y Desarrollo Sostenible de las Américas del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible ')
@section('body_class', 'programa aliados')
@section('canonical', url('red-de-gobierno-abierto-desarrollo-sostenible-de-las-americas'))

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>Red de Gobierno Abierto y Desarrollo Sostenible de las Américas</h1>
		<h2></h2>
    <div class="row">
			<div class="col-sm-9">
					<span></span>
					<div class="panel">
						<ol>
								<li><a href = '{{url("red-de-gobierno-abierto-desarrollo-sostenible-de-las-americas/integrador")}}'>Documento integrador.</a></li>
								<li><a href = '{{url("red-de-gobierno-abierto-desarrollo-sostenible-de-las-americas/reporte_final")}}'>Reporte final con estrategia de incubación y sostenimiento de la red.</a></li>
						</ol>
					</div>
			</div>

			<div class="col-sm-3">
				<a href="{{url('programa-gobierno-abierto/alcance')}}" class="icon i_alcance"><span>ALCANCE DEL PROGRAMA</span></a>
				<a href="{{url('programa-gobierno-abierto/aliados')}}" class="icon i_aliados">CONOCE A LOS ALIADOS</a>
				<a href="{{url('programa-gobierno-abierto/antecedentes')}}" class="icon i_antecedentes">ANTECEDENTES</a>
			</div>

		</div>

	</div>
</div>
@endsection
