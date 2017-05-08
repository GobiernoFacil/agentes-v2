@extends('layouts.admin.a_master')
@section('title', $module->title )
@section('description', $module->objective)
@section('body_class', 'fellow aprendizaje')
@section('breadcrumb_type', 'module view')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_modules')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h3 class ="center">Módulo {{$module->order}}</h3>
    <h1 class ="center">{{$module->title}}</h1>
  </div>
</div>
<div class="row">
  <div class = "col-sm-12">
    <table class="table">
			<thead>
				<tr>
					<th>Duración</th>
					<th># Sesiones</th>
					<th>Modalidad</th>
          <th>Estatus</th>
				</tr>
			</thead>
			<tbody>
			    <tr>
            <td>{{$module->number_hours}}</td>
            <td>{{$module->sessions->count()}}</td>
            <td>{{$module->modality}}</td>
            <td>{{$module->public ? "Activo" : "Candado"}}</td>
          </tr>
			</tbody>
		</table>
  </div>
</div>

@if($module->sessions->count() > 0)
      @foreach($module->sessions as $session)
      <div class="row">
        <div class = "col-sm-10">
          <h3>Sesión {{$module->order}}.{{$session->order}} </h3>
          <p>{{$session->name}}</p>
          <p>{{$session->objective}}</p>
        </div>
        <div class = "col-sm-2">
          <a href='{{ url("tablero/aprendizaje/{$module->slug}/{$session->slug}") }}' class="btn xs view">Ir a la Sesión</a></li>
        </div>
      </div>

    <div class="row">
      <div class = "col-sm-12">
        <span>{{$session->hours}}</span>
        @if($session->facilitators->count() > 0 )
            @foreach($session->facilitators as $facilitator)
            <span>{{$facilitator->user->name}}</span>
            @if($facilitator->user->image)
            <img src='{{url("img/users/{$facilitator->user->image->name}")}}'>
            @endif
            @endforeach
        @else
        <span>{{'Sin facilitador'}}</span>
        @endif
        <span>{{$session->activities->count()}}</span>
      </div>
    </div>

      @endforeach
@endif

@endsection
