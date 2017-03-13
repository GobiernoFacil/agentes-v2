@extends('layouts.admin.a_master')
@section('title', 'Lista de Aspirantes')
@section('description', 'Lista de Aspirantes')
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirantes ver')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_aspirantes')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Lista de Aspirantes</h1>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="box">
		<table class="table">
		  <thead>
		    <tr>
		      <th>Nombre</th>
		      <th>Email</th>
		      <th>Ciudad, Estado</th>
		      <th>Puntaje</th>
		      <th>Acciones</th>
		    </tr>
		  </thead>
		  <tbody>
		    @foreach ($aspirants as $aspirant)
		      <tr>
		        <td><h4><a href="{{ url('dashboard/aspirantes/ver/' . $aspirant->id) }}">{{$aspirant->name.' '.$aspirant->surname." ".$aspirant->lastname}}</a></h4></td>
		        <td>{{$aspirant->email}}</td>
		        <td>{{$aspirant->city}}, {{$aspirant->state}}</td>
		        @if($aspirant->aspirantEvaluation)
		        <td>{{($aspirant->aspirantEvaluation->grade*10).'%'}}</td>
		        @else
		        <td>Sin calificación</td>
		        @endif
		        <td>
		          <a href="{{ url('dashboard/aspirantes/ver/' . $aspirant->id) }}" class="btn xs view">Ver</a>
		          <a href="{{ url('dashboard/aspirantes/evaluar/' . $aspirant->id) }}" class="btn xs view ev">Evaluar</a>
		          <a href ="{{ url('dashboard/aspirantes/eliminar' . $aspirant->id) }}"  id ="{{$aspirant->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>

		{{ $aspirants->links() }}
		</div>
	</div>
</div>
@endsection