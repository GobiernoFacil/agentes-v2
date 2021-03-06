@extends('layouts.admin.a_master')
@section('title', 'Lista de Aspirantes')
@section('description', 'Lista de Aspirantes')
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirantes list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_aspirantes')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Lista de Aspirantes <span id ="typeAspirantTextTitle"> con </span>archivos</h1>
	</div>
	<div class="col-sm-3">
		<form  role="form" method="GET" action="{{ url('dashboard/aspirantes') }}" id="search-input">
			<input id = "search-aspirant" type="search" name="searchBox" class="form-control" placeholder="Buscar Aspirante o Estado" value="{{request('searchBox', '')}}">
			<p id ="nR" style="display:none;">No existen resultados</p>
		</form>
	</div>
</div>

<div class="row">
	<!---
	<div class="col-sm-4">
		<a class ="btn view gde" href ="{{url('dashboard/aspirantes/verificados')}}">Aspirantes con archivos verificados ({{$listA->count()}})</a>
	</div>
	<div class="col-sm-4">
		<a class ="btn view gde" href ="{{url('dashboard/aspirantes/sin-verificar')}}">Aspirantes con archivos sin verificar</a>
	</div>
	-->
	<div class="col-sm-4 col-sm-offset-8">
		<a class ="btn view gde" id="typeAspirant" href ="">Aspirantes <span class= "strong" id="typeAspirantText">sin</span> archivos</a>
	</div>
</div>

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



<div class="row" id ="Noaspirants" style="display:none;">
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
		    @foreach ($aspirantsNo as $aspirant)
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

		{{ $aspirantsNo->links() }}
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


<div class="col-sm-12">
				<div class="box">
					<h2>Aspirantes por Estado</h2>
					<ul class="inline">
						<li>Chihuahua: <strong>{{$chihuahua_number}}</strong></li>
						<li>Morelos: <strong>{{$morelos_number}}</strong></li>
						<li>Nuevo León: <strong>{{$leon_number}}</strong></li>
						<li>Oaxaca: <strong>{{$oaxaca_number}}</strong></li>
						<li>Sonora: <strong>{{$sonora_number}}</strong></li>
					</ul>
					<div id="bar"></div>					
				</div>
				<div class="box">
					<h2>Aspirantes por Sector</h2>
					<ul class="inline">
						<li>Gobierno: <strong>{{$gobierno_number}}</strong></li>
						<li>Sociedad Civil: <strong>{{$civil_number}}</strong></li>
						<li>Sector Privado: <strong>{{$privado_number}}</strong></li>
						<li>Sector Académico: <strong>{{$academico_number}}</strong></li>
					</ul>
					<div id="bar2"></div>					
				</div>
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
		var type = document.getElementById("typeAspirantText").innerHTML;
		if(type==='sin'){
			document.getElementById("boxResults").style.display ="none";
			document.getElementById("aspirants").style.display ="block";
			document.getElementById("nR").style.display ="none";
			document.getElementById("Noaspirants").style.display ="none";
			document.getElementById("typeAspirantText").innerHTML = "sin";
			document.getElementById("typeAspirantTextTitle").innerHTML = "con ";
		}else{
			document.getElementById("boxResults").style.display ="none";
			document.getElementById("aspirants").style.display ="none";
			document.getElementById("nR").style.display ="none";
			document.getElementById("Noaspirants").style.display ="block";
			document.getElementById("typeAspirantText").innerHTML = "con";
			document.getElementById("typeAspirantTextTitle").innerHTML = "sin ";
		}
	}

};

document.getElementById("typeAspirant").addEventListener("click", function(e){
	e.preventDefault();
	var type = document.getElementById("typeAspirantText").innerHTML;
	if(type==='sin'){
		document.getElementById("boxResults").style.display ="none";
		document.getElementById("aspirants").style.display ="none";
		document.getElementById("nR").style.display ="none";
		document.getElementById("Noaspirants").style.display ="block";
		document.getElementById("typeAspirantText").innerHTML = "con";
		document.getElementById("typeAspirantTextTitle").innerHTML = "sin ";
	}else{
		document.getElementById("boxResults").style.display ="none";
		document.getElementById("aspirants").style.display ="block";
		document.getElementById("nR").style.display ="none";
		document.getElementById("Noaspirants").style.display ="none";
		document.getElementById("typeAspirantText").innerHTML = "sin";
		document.getElementById("typeAspirantTextTitle").innerHTML = "con ";
	}
});

</script>

<!-- load the d3.js library -->    	
<script src="{{ url('js/d3/d3.v4.min.js')}}"></script>
<script>
	var data = [
	{
		"estado": "Chihuahua",
		"total" : {{$chihuahua_number}}
	},
	{
		"estado": "Morelos",
		"total" : {{$morelos_number}}
	},
	{
		"estado": "Nuevo León",
		"total" : {{$leon_number}}
	},
	{
		"estado": "Oaxaca",
		"total" : {{$oaxaca_number}}
	},
	{
		"estado": "Sonora",
		"total" : {{$sonora_number}}
	}
	];
	var dataorigin = [
	{
		"origin": "Gobierno",
		"total" : {{$gobierno_number}}
	},
	{
		"origin": "Sociedad Civil",
		"total" : {{$civil_number}}
	},
	{
		"origin": "Sector Privado",
		"total" : {{$privado_number}}
	},
	{
		"origin": "Sector Académico",
		"total" : {{$academico_number}}
	}
	];
</script>
<script src="{{ url('js/dashboard.js') }}"></script>
@endsection