@extends('layouts.admin.a_master')
@section('title', 'Encuestas en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Encuestas en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'fellow')
@section('breadcrumb_type', 'survey list')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_survey')

@section('content')
<div class="row">
	<div class="col-sm-12 ">
		<h1>Encuestas</h1>
	</div>
</div>

<div class="box">
	<div class="row">
		<div class="col-sm-12">
			@if($surveys->count() > 0 || $program->title === 'Programa 2017')
			<table class="table">
				<thead>
			    	<tr>
						<th>Encuesta</th>
						<th>Descripción</th>
						<th>Estatus</th>
						<th>Acciones</th>
			    	</tr>
				</thead>
				<tbody>
					@if($program->title === 'Programa 2017')
			    	<tr>
						<td><h4><a href='{{url("tablero/encuestas/encuesta-satisfaccion")}}'>Encuesta de satisfacción</a></h4></td>
						<td>Encuesta de satisfacción Plataforma Apertus</td>
						<td>{{$user->fellow_survey ? 'Completada' : 'Sin contestar'}}</td>
						<td>
						  @if($user->fellow_survey)
						  Completada
						  @else
						  <a href="{{ url('tablero/encuestas/encuesta-satisfaccion') }}" class="btn xs view">Ver</a>
						  @endif
						</td>
					</tr>
					<tr>
						<td><h4><a href='{{url("tablero/encuestas/facilitadores-modulos")}}'>Encuesta de facilitadores</a></h4></td>
						<td>Encuesta de facilitadores por sesión</td>
						<td>No aplica</td>
						<td>
							<a href="{{ url('tablero/encuestas/facilitadores-modulos') }}" class="btn xs view">Ver</a>
						</td>
					</tr>
				 @endif
				 @foreach($surveys as $survey)
						 <tr>
							 <td><h4><a href='{{url("tablero/$program->slug/encuestas/$survey->slug")}}'>{{$survey->title}}</a></h4></td>
							 <td>{{str_limit($survey->description,150,'...')}}</td>
							 <td>{{$user->fellow_survey($survey->id)->count() > 0 ? 'Completada' : 'Sin contestar'}}</td>
							 <td>
								 @if($user->fellow_survey($survey->id)->count() > 0 )
								 Completada
								 @else
								 <a href='{{url("tablero/$program->slug/encuestas/$survey->slug")}}' class="btn xs view">Ver</a>
								 @endif
							 </td>
						 </tr>
				 @endforeach
				</tbody>
			</table>
		@else
		<p><strong>Sin encuestas</strong></p>
		@endif
		</div>
	</div>
</div>
@endsection
