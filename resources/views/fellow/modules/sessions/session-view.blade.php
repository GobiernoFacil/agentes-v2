@extends('layouts.admin.a_master')
@section('title', '' )
@section('description', '')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('content')
<div class="row">
  <div class="col-sm-12">
    <h3 class ="center">Sesión {{$session->module->order}}.{{$session->order}}</h3>
    <h1 class ="center">{{$session->name}}</h1>
  </div>
</div>
<div class="row">
  <div class = "col-sm-12">
    <table class="table">
			<thead>
				<tr>
					<th>Duración</th>
          <th>Estatus</th>
				</tr>
			</thead>
			<tbody>
			    <tr>
            <td>{{$session->number_hours}}</td>
            <td>{{$session->public ? "Activo" : "Candado"}}</td>
          </tr>
			</tbody>
		</table>
  </div>
</div>

<div class="box">
	<div class="row">
    <h2>Objetivo General</h2>
    <p>{{$session->objective}}</p>
  </div>
</div>


<div class="box">
	<div class="row">
    <h2>Facilitadores</h2>
    @if($session->facilitators->count() > 0 )
      @foreach($session->facilitators as $facilitator)
        <p>{{$facilitator->user->name}}</p>
        @if($facilitator->user->image)
        <img src='{{url("img/users/{$facilitator->user->image->name}")}}'>
        @endif
      @endforeach
    @else
       <p>Sin facilitadores</p>
    @endif
  </div>
</div>

<div class="box">
	<div class="row">
    <h2>Actividades</h2>
    @if($session->activities->count() > 0 )
      @foreach($session->activities as $activity)
        <p>{{$activity->name}}</p>
      @endforeach
    @else
       <p>Sin actividades</p>
    @endif
  </div>
</div>


@endsection
