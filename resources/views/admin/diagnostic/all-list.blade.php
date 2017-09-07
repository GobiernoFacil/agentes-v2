@extends('layouts.admin.a_master')
@section('title', 'Lista de examen diagnóstico')
@section('description', 'Lista de examen diagnóstico')
@section('body_class', '')
@section('breadcrumb_type', 'diagnostic list view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_diagnostic')
@section('content')


<div class="row">
	<div class="col-sm-9">
		<h1>Lista de exámenes diagnóstico</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
			  <thead>
			    <tr>
			      <th>Nombre</th>
			      <th>Descripción</th>
						<th>Respuestas</th>
			      <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
          @foreach($questionnaires as $questionnaire)
			      <tr>
			        <td><h4><a href = '{{url("dashboard/diagnostico/$questionnaire->id")}}'>{{$questionnaire->title}}</a></h4></td>
			        <td>{{$questionnaire->description}}</td>
							<td>{{$questionnaire->fellow_answers()->distinct('user_id')->count('user_id')}}</td>
			        <td>
								<a href='{{ url("dashboard/diagnostico/{$questionnaire->id}") }}' class="btn xs view">Ver</a>
              </td>
			    </tr>
          @endforeach
			  </tbody>
			</table>
		</div>
	</div>
</div>
@endsection
