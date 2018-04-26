@extends('layouts.admin.a_master')
@section('title', 'Aspirante de ' . $notice->title .': ' . $aspirant->name .' ' . $aspirant->surname.' '.$aspirant->lastname)
@section('description', 'Lista de Aspirantes')
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirants interview view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_interview')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Entrevista a Aspirante</h1>
		<div class="divider"></div>
	</div>
	<div class="col-sm-6">
		<h2>{{$aspirant->name." ".$aspirant->surname." ".$aspirant->lastname}}</h2>
		<p> {{$aspirant->city}}, {{$aspirant->state}}</p>
	</div>
	<div class="col-sm-6">
		<h2 class="right">Evaluación General: <br> {{$aspirant->global_interview_grade ? number_format(($aspirant->global_interview_grade->score*10),2).'%' : "Sin evaluaciones"}}</h2>
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
							<h3>Evaluación de {{$user->institution}}</h3>
							<li><span>Tu evaluación:</span> {{number_format(($aspirantInterview->score*10),2).'%'}}</li>
							@if($aspirant->verifyInstitutionInterview($user->institution,$notice))
							<a href='{{url("dashboard/aspirantes/convocatoria/$notice->id/entrevistas/actualizar-entrevista/$aspirant->id")}}' class="btn xs view">Evaluar</a></li>
							@endif
		</ul>
		<div class="divider"></div>

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
						<th>Evaluación</th>
					</tr>
				</thead>
				<tbody>
				@foreach($allEva as $eva)
				<tr>
					@if($eva->score)
					<td>{{($eva->institution)}}</td>
					<td>{{number_format(($eva->score*10),2).'%'}}</td>
					@endif
				</tr>
				@endforeach
				</tbody>
			</table>
		</div>

	</div>
</div>
@endif
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<h2>Comentarios:</h2>
		</div>

		<div class="col-sm-12">
				@foreach($allEva as $eva)
          <h3>{{$eva->institution}}</h3>
          @if($eva->open_questions()->count() > 0)
             @foreach($eva->open_questions()->get() as $question)
              <p>{{$question->answer}}</p>
             @endforeach
          @else
           <p>Sin comentarios</p>
          @endif
          <div class="divider"></div>
				@endforeach
		</div>

	</div>
</div>
@endsection
