@extends('layouts.admin.a_master')
@section('title', 'Aspirantes a Convocatorias en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Aspirantes a Convocatorias en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirant notice list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_aspirantes')
@section('content')
<div class="row">
  <div class="col-sm-12">
		<h1>Aspirantes por convocatoria</h1>
		<div class="divider"></div>
	</div>
</div>
@if(Session::has('message'))
<div class="row">
  <div class="col-sm-12 message success">
      <p>{{ Session::get('message') }}</p>
  </div>
</div>
@endif

<div class="row">
		<div class="col-sm-12">
      @if($notices->count()>0)
			<table class="table">
				<thead>
			    	<tr>
						<th>Convocatoria</th>
						<th>Aspirantes</th>
						<th>Aspirantes no válidos</th>
						<th>Comprobantes revisados</th>
						<th>Aspirantes evaluados</th>
            <th>Aspirantes entrevistados</th>
						<th></th>
						<th></th>
			    	</tr>
				</thead>
				<tbody>
					@foreach($notices as $notice)
						<tr>
							<td><h4><a href='{{url("dashboard/convocatorias/ver/{$notice->id}")}}'>{{$notice->title}}</a></h4></td>
							<td><p class="center"><a class="t_link" href='{{ url("dashboard/aspirantes/convocatoria/{$notice->id}/ver") }}'>{{ $notice->all_aspirants_data()->count() }}</p></td>
							<td><p class="center"><a class="t_link" href='{{ url("dashboard/aspirantes/convocatoria/{$notice->id}/aspirantes-sin-archivos") }}'>{{ $notice->aspirants_without_data()->count() }}</p></td>
							<td><p class="center"><a class="t_link" href='{{ url("dashboard/aspirantes/convocatoria/{$notice->id}/aspirantes-con-archivos-evaluados") }}'>{{ $notice->aspirants_already_evaluated()->count() }}</p> </td>
							<td><p class="center"><a class="t_link" href='{{ url("dashboard/aspirantes/convocatoria/{$notice->id}/todos-los-aspirantes-con-aplicacion-evaluada") }}'>{{ $notice->aspirants_app_already_evaluated()->count() }}</p></td>
              <td><p class="center"><a class="t_link" href='{{ url("dashboard/aspirantes/convocatoria/{$notice->id}/entrevistas") }}'>{{ $notice->aspirants_inter_already_evaluated()->count() }}</p></td>
              <td><p><a href='{{ url("dashboard/aspirantes/convocatoria/{$notice->id}/aspirantes-con-archivo-por-evaluar") }}' class="btn xs view">Validar domicilio</a></p>
							</td>
							<td><p><a href='{{ url("dashboard/aspirantes/convocatoria/{$notice->id}/aspirantes-con-aplicacion-por-evaluar") }}' class="btn xs ev">Evaluar aspirantes</a></p>
							</td>
              <td><p><a href='{{ url("dashboard/aspirantes/convocatoria/{$notice->id}/entrevistas") }}' class="btn xs ev">Evaluar entrevistas</a></p>
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
@endsection
