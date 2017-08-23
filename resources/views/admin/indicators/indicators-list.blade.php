@extends('layouts.admin.a_master')
@section('title', 'Lista de indicadores')
@section('description', 'Lista de indicadores de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', '')

@section('content')


<div class="row">
	<div class="col-sm-9">
		<h1>Lista de indicadores</h1>
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
              <a href="{{ url('dashboard/indicadores/satisfaccion') }}" class="btn xs view">Ver</a>
             <!-- <a href="{{ url('dashboard/indicadores/fellows/descargar') }}" class="btn xs view">Descargar</a>-->
            </td>
        </tr>
			  </tbody>
			</table>
		</div>
	</div>
</div>
@endsection
