@extends('layouts.admin.a_master')
@section('title', 'Convocatorias en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Convocatorias en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', '')
@section('breadcrumb_type', 'notice list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_notice')
@section('content')
<div class="row">
  <div class="col-sm-9">
		<h1>Lista de convocatorias</h1>
	</div>
	<div class="col-sm-3 center">
		<a href="{{ url('dashboard/convocatorias/agregar') }}" class="btn gde"><strong>+</strong> Agregar convocatoria</a>
	</div>
</div>

<div class="box">
	<div class="row">
		<div class="col-sm-12">
      @if($notices->count()>0)
			<table class="table">
				<thead>
			    	<tr>
						<th>Convocatoria</th>
            <th>Fecha inicio / Fecha final
						<th>Descripción</th>
            <th>Publicado</th>
						<th>Acciones</th>
			    	</tr>
				</thead>
				<tbody>
					@foreach($notices as $notice)
						<tr>
							<td><h4><a href='{{url("dashboard/convocatorias/ver/{$notice->id}")}}'>{{$notice->title}}</a></h4></td>
              <td>{{date("d-m-Y", strtotime($notice->start))}} <br> <strong>{{date('d-m-Y', strtotime($notice->end))}}</strong></td>
							<td>{{str_limit($notice->description,125)}}</td>
               <td>{{$notice->public ? "Sí" : "No" }}</td>
							<td>
								<a href='{{ url("dashboard/convocatorias/ver/{$notice->id}") }}' class="btn xs view">Ver</a>
							</td>
						</tr>
					@endforeach

				</tbody>
			</table>
      @else
      <p><strong>Sin convocatorias</strong></p>
      @endif
		</div>
	</div>
</div>
@endsection
