@extends('layouts.admin.a_master')
@section('title', 'Convocatorias en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Convocatorias en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', '')
@section('breadcrumb_type', 'aspirant notice list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_aspirantes')
@section('content')
<div class="row">
  <div class="col-sm-9">
		<h1>Lista de convocatorias</h1>
	</div>
</div>
@if(Session::has('message'))
<div class="row">
  <div class="col-sm-12 message success">
      <p>{{ Session::get('message') }}</p>
  </div>
</div>
@endif

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
						<th>Acciones</th>
			    	</tr>
				</thead>
				<tbody>
					@foreach($notices as $notice)
						<tr>
							<td><h4><a href='{{url("dashboard/aspirantes/convocatoria/{$notice->id}/ver")}}'>{{$notice->title}}</a></h4></td>
              <td>{{date("d-m-Y", strtotime($notice->start))}} <br> <strong>{{date('d-m-Y', strtotime($notice->end))}}</strong></td>
							<td>{{str_limit($notice->description,125)}}</td>
							<td>
								<a href='{{ url("dashboard/aspirantes/convocatoria/{$notice->id}/ver") }}' class="btn xs view">Ver</a>
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
