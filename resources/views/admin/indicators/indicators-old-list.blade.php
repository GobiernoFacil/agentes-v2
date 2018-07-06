@extends('layouts.admin.a_master')
@section('title', 'Lista de indicadores')
@section('description', 'Lista de indicadores de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', '')
@section('breadcrumb_type', 'indicator list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_indicators')
@section('content')


<div class="row">
	<div class="col-sm-9">
		<h1>Lista de indicadores</h1>
		<h2>{{$program->title}}</h2>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
			  <thead>
			    <tr>
			      <th>Indicador</th>
			      <th>Descripción</th>
			      <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
						<tr>
							<td><h4><a>Porcentaje de agentes de cambio aprobados</a></h4></td>
							<td>Proporción de agentes de cambio que aprobaron el programa</td>
							<td>
								<a href='{{ url("dashboard/indicadores/programa/$program->id/agentes-aprobados")}}' class="btn xs view">Ver</a>
							</td>
						</tr>
			      <tr>
			        <td><h4><a>Percepción de facilitadores</a></h4></td>
			        <td>Proporción de facilitadores evaluados favorablemete por parte de los agentes de cambio</td>
			        <td>
								<a href="{{ url('dashboard/indicadores/facilitadores-modulos') }}" class="btn xs view">Ver</a>
			         <!-- <a href="{{ url('dashboard/indicadores/facilitadores/descargar') }}" class="btn xs view">Descargar</a>-->
              </td>
			    </tr>
					<tr>
						<td><h4>Percepción de fellows</h4></td>
						<td>Porcentaje de agentes de cambio que tienen una percepción positiva de la plataforma web</td>
						<td>
							<a href="{{ url('dashboard/indicadores/percepcion-positiva') }}" class="btn xs view">Ver</a>
						</td>
				</tr>
          <tr>
            <td><h4>Encuesta de satisfacción</h4></td>
            <td>Resultados de encuesta de satisfacción</td>
            <td>
              <a href="{{ url('dashboard/indicadores/satisfaccion') }}" class="btn xs view">Ver</a>
              <a href="{{ url('dashboard/indicadores/fellows/descargar') }}" class="btn xs view">Descargar PDF</a>
							 <a href="{{ url('dashboard/indicadores/fellows/descargar/xlsx') }}" class="btn xs view">Descargar XLSX</a>
            </td>
        </tr>
			  </tbody>
			</table>
		</div>
	</div>
</div>
@endsection
