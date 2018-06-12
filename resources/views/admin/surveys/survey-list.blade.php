@extends('layouts.admin.a_master')
@section('title', 'Encuestas en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Encuestas en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', '')
@section('breadcrumb_type', 'survey list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_survey')
@section('content')
<div class="row">
	<div class="col-sm-12 ">
		<h1>Encuestas</h1>
		<p>{{$program->title}}</p>
	</div>
</div>

<div class="box">
	<div class="row">
			<div class="col-sm-12">
			<p class="right"><a href='{{ url("dashboard/encuestas/programa/$program->id/agregar") }}' class="btn ev">[+] Agregar encuesta</a></p>
			@if($surveys->count() > 0)
					<table class="table">
						<thead>
					    	<tr>
								<th>Encuesta</th>
								<th>Descripción</th>
								<th>Acciones</th>
					    	</tr>
						</thead>
						<tbody>
					    	<tr>
								<td><h4><a href='{{url("dashboard/encuestas/encuesta-satisfaccion/fellows")}}'>Encuesta de satisfacción</a></h4></td>
								<td>Encuesta de satisfacción Plataforma Apertus</td>
								<td>
								  <a href="{{ url('dashboard/encuestas/encuesta-satisfaccion/fellows') }}" class="btn xs view">Ver</a>
								</td>
							</tr>
							<tr>
								<td><h4><a href='{{url("dashboard/encuestas/facilitadores-modulos")}}'>Encuesta de facilitadores</a></h4></td>
								<td>Encuesta de facilitadores por sesión</td>
								<td>
									<a href="{{ url('dashboard/encuestas/facilitadores-modulos') }}" class="btn xs view">Ver</a>
								</td>
							</tr>

							@foreach($custom as $questionnaire)
								<tr>
									<td><h4><a href='{{url("dashboard/encuestas/diagnostico/{$questionnaire->id}")}}'>{{$questionnaire->title}}</a></h4></td>
									<td>{{$questionnaire->description}}</td>
									<td>
										<a href='{{ url("dashboard/encuestas/diagnostico/{$questionnaire->id}") }}' class="btn xs view">Ver</a>
									</td>
								</tr>
							@endforeach

						</tbody>
					</table>

				@else
				<h2><strong>Sin encuestas</strong></h2>

				@endif
			</div>
	</div>
</div>
@endsection
