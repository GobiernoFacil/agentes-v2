@extends('layouts.admin.a_master')
@section('title', 'Lista de Aspirantes')
@section('description', 'Lista de Aspirantes')
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirantes list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_aspirantes')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Lista de Aspirantes</h1>
	</div>
	<div class="col-sm-3">
		<form  role="form" method="GET" action="{{ url('dashboard/aspirantes') }}" id="search-input">
			<input id = "search-aspirant" type="search" name="searchBox" class="form-control" placeholder="Buscar Aspirante o Estado" value="{{request('searchBox', '')}}">
			<p id ="nR" style="display:none;">No existen resultados</p>
		</form>
	</div>
</div>
<?php /*
<div class="row">
	<div class="col-sm-12">
		<span>Chihuahua: {{$chihuahua_number}}</span>
		<span>Morelos: {{$morelos_number}}</span>
		<span>Nuevo León: {{$leon_number}}</span>
		<span>Oaxaca: {{$oaxaca_number}}</span>
		<span>Sonora: {{$sonora_number}}</span>
	</div>
</div>*/
?>

<div class="row" id ="aspirants">
	<div class="col-sm-12">
		<div class="box">
		<table class="table">
		  <thead>
		    <tr>
		      <th>Nombre / email</th>
		      <th>Ciudad / Estado</th>
		      <th>Procedencia</th>
		      <th>Registro</th>
		      <th>Archivos</th>
		      <th>Puntaje</th>
		      <th>Acciones</th>
		    </tr>
		  </thead>
		  <tbody>
		    @foreach ($aspirants as $aspirant)
		      <tr>
		        <td><h4><a href="{{ url('dashboard/aspirantes/ver/' . $aspirant->id) }}">{{$aspirant->name.' '.$aspirant->surname." ".$aspirant->lastname}}</a></h4>
		        {{$aspirant->email}}
		        </td>
		        <td>{{$aspirant->city}} <br> <strong>{{$aspirant->state}}</strong></td>
				<td>{{$aspirant->origin}}</td>
		        <td>{{ date("d-m-Y", strtotime($aspirant->created_at)) }} <br> {{ date("H:i", strtotime($aspirant->created_at)) }} hrs.</td>
		        <td>{{$aspirant->AspirantsFile ? "Sí" : "No" }}</td>
		        @if($aspirant->aspirantEvaluation)
						<?php $aspirantE = $aspirant->aspirantEvaluation->where('user_id',$user->id)->first();?>
							@if($aspirantE)
			        <td> {{$aspirantE->grade ? ($aspirantE->grade*10).'%' : "Sin Calificación"}}</td>
							@else
								<?php $aspirantE = $aspirant->aspirantEvaluation->where('institution',$user->institution)->first();?>
								@if($aspirantE)
							  <td> {{$aspirantE->grade ? ($aspirantE->grade*10).'%' : "Sin Calificación"}}</td>
								@else
								<td>Sin calificación</td>
								@endif
							@endif
		        @else
		        <td>Sin calificación</td>
		        @endif
		        <td>
		          <a href="{{ url('dashboard/aspirantes/ver/' . $aspirant->id) }}" class="btn xs view">Ver</a>
		          <a href="{{ url('dashboard/aspirantes/evaluar-archivos/' . $aspirant->id) }}" class="btn xs view ev">Evaluar</a>
		         <!-- <a href ="{{ url('dashboard/aspirantes/eliminar' . $aspirant->id) }}"  id ="{{$aspirant->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>-->
		    </tr>
		    @endforeach
		  </tbody>
		</table>

		{{ $aspirants->links() }}
		</div>
	</div>
</div>

<div id = "boxResults" style="display:none;">
	<table class="table" id = "resultList">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Email</th>
				<th>Ciudad, Estado</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody id ="List">
		</tbody>
</table>
</div>
@endsection

@section('js-content')
<script src="{{url('js/app-search.js')}}"></script>
<script>
var CONFIG = {
	search_url:    "{{url('dashboard/aspirantes/buscar')}}",
	general_aspirant_url :    "{{url('dashboard/aspirantes/ver')}}",
	token      : document.querySelector('input[name="_token"]').value
};
appSearch.initialize(CONFIG);
document.getElementById("search-aspirant").onblur = function() {
	if(this.value==''){
		document.getElementById("boxResults").style.display ="none";
		document.getElementById("aspirants").style.display ="block";
		document.getElementById("nR").style.display ="none";
	}

};
</script>
@endsection
