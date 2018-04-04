@extends('layouts.admin.a_master')
@section('title', 'Aspirante de ' . $notice->title .': ' . $aspirant->name .' ' . $aspirant->surname.' '.$aspirant->lastname)
@section('description', 'Lista de Aspirantes')
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirantes ver')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_aspirantes')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Perfil de Aspirante</h1>
		<div class="divider"></div>
	</div>
	<div class="col-sm-6">
		<h2>{{$aspirant->name." ".$aspirant->surname." ".$aspirant->lastname}}</h2>
		<p> {{$aspirant->city}}, {{$aspirant->state}}</p>
	</div>
	<div class="col-sm-6">
		<h2 class="right">Evaluación General: <br> {{$aspirant->global_grade ? number_format(($aspirant->global_grade->grade*10),2).'%' : "Sin evaluaciones"}}</h2>
	</div>
	<div class="col-sm-12">
		<div class="divider"></div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<ul class="profile list">
			<li><span>Email:</span> {{$aspirant->email}}</li>
			<li><span>Nivel de estudios:</span> {{$aspirant->degree}}</li>
			<li><span>Procedencia:</span> {{$aspirant->origin ? $aspirant->origin : "Sin información"}}</li>
			<li><span>Fecha de creación</span>{{ date("d-m-Y, H:i", strtotime($aspirant->created_at)) }} hrs.</li>
		</ul>
	</div>
	<div class="col-sm-6">
		<ul class="profile list">
				@if($proof)
					@if($proof->address_proof)
						@if($aspirantEvaluation)
							<h3>Evaluación de {{$user->institution}}</h3>
							<li><span>Valoración Perfil Curricular:</span> {{($aspirantEvaluation->experienceGrade*10).'%'}}</li>
							<li><span>Valoración exposición de motivos:</span> {{($aspirantEvaluation->essayGrade*10).'%'}}</li>
							<li><span>Valoración video:</span> {{($aspirantEvaluation->videoGrade*10).'%'}}</li>
							<li><span>Tu evaluación:</span> {{number_format(($aspirantEvaluation->grade*10),2).'%'}}</li>
							@if($aspirant->verifyInstitution($user->institution,$notice))
							<a href='{{url("dashboard/aspirantes/convocatoria/$notice->id/evaluar-aplicacion/$aspirant->id")}}' class="btn xs view">Evaluar</a></li>
							@endif
							@else
								<li class="right"><span><strong>Sin evaluar</strong></span>
								@if($aspirant->verifyInstitution($user->institution,$notice))
									<a href='{{url("dashboard/aspirantes/convocatoria/$notice->id/evaluar-aplicacion/$aspirant->id")}}' class="btn xs view">Evaluar</a></li>
								@endif
						@endif
					@else
						<li class="right"><span><strong>No cuenta con comprobante de domicilio válido</strong></span>
						<a href='{{url("dashboard/aspirantes/convocatoria/$notice->id/evaluar-comprobante/$aspirant->id")}}' class="btn xs view">Revisar</a></li>
					@endif

				@else
									@if($aspirant->AspirantsFile)
											@if($aspirant->AspirantsFile->proof)
													<li class="right"><span><strong>Aún no ha sido evaluado su comprobante de domiclio</strong></span>
													<a href='{{url("dashboard/aspirantes/convocatoria/$notice->id/evaluar-comprobante/$aspirant->id")}}' class="btn xs view">Evaluar</a></li>
										 @else
										 		<li class="right"><span>No cuenta con comprobante de domicilio</span>
										 @endif
									@else
												<p class="right"><span>No cuenta con comprobante de domicilio</p>
									@endif
				@endif
		</ul>
		<div class="divider"></div>
		<ul class="profile list">
			@if($aspirant->AspirantsFile)
			@if($aspirant->AspirantsFile->motives)
			<li class="download"><a href='{{url("dashboard/aspirantes/convocatoria/$notice->id/download/$aspirant->id/motivos")}}'  class="btn download gde"> Descargar exposición de motivos</a></li>
			@endif

			@if($aspirant->cv)
			<li class="download"><a href='{{url("dashboard/aspirantes/convocatoria/$notice->id/download/$aspirant->id/cv")}}'  class="btn download gde"> Descargar Perfil Curricular</a></li>
			@endif

			@if($aspirant->AspirantsFile->video)
			<li><span>Video:</span> <a class ="btn view" href="{{$aspirant->AspirantsFile->video}}" target="_blank">Ir al video</a></li>
			@endif

			@if($aspirant->AspirantsFile->proof)
			<li class="download"><a href='{{url("dashboard/aspirantes/convocatoria/$notice->id/comprobante/{$aspirant->AspirantsFile->proof}")}}'  class="btn download gde"> Descargar Comprobante de Domicilio</a></li>
			@endif


			<li><span>Políticas de Privacidad:</span> <strong> {{$aspirant->AspirantsFile->privacy_policies ? "De acuerdo" : "No de acuerdo"}}</strong></li>
			@endif

		</ul>
	</div>
		<div class="col-sm-6">

		</div>
	</div>


@if($allEva->count() > 0)
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<h2>Evaluado por:</h2>
		</div>

		<div class="col-sm-12">
			<table class="table">
				<thead>
					<tr>
						<th>Institución</th>
						<th>Exposición de motivos</th>
						<th>Perfil curricular</th>
						<th>Video</th>
						<th>Evaluación</th>
					</tr>
				</thead>
				<tbody>
				@foreach($allEva as $eva)
				<tr>
					@if($eva->grade)
					<td>{{($eva->institution)}}</td>
					<td>{{number_format(($eva->essayGrade*10),2).'%'}}</td>
					<td>{{number_format(($eva->experienceGrade*10),2).'%'}}</td>
					<td>{{number_format(($eva->videoGrade*10),2).'%'}}</td>
					<td>{{number_format(($eva->grade*10),2).'%'}}</td>
					@endif
				</tr>
				@endforeach
				</tbody>
			</table>
		</div>

	</div>
</div>
@endif
@endsection
