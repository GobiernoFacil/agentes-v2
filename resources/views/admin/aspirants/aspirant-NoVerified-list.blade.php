@extends('layouts.admin.a_master')
@section('title', 'Lista de Aspirantes')
@section('description', 'Lista de Aspirantes')
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirantes list non')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_aspirantes')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Lista de Aspirantes sin verificar ({{$listB->count()}})</h1>
	</div>
	<?php /*
	<div class="col-sm-3">
		<form  role="form" method="GET" action="{{ url('dashboard/aspirantes') }}" id="search-input">
			<input id = "search-aspirant" type="search" name="searchBox" class="form-control" placeholder="Buscar Aspirante o Estado" value="{{request('searchBox', '')}}">
			<p id ="nR" style="display:none;">No existen resultados</p>
		</form>
	</div>
	*/?>
</div>
<div class="divider"></div>
<div class="row">
	<div class="col-sm-4">
		<?php $z = 89;?>
		<a class ="btn  view gde" href ="{{url('dashboard/aspirantes/verificados')}}">Aspirantes con archivos verificados ({{$z - $listB->count()}})</a>
	</div>
	<div class="col-sm-4">
		
		<a class ="btn download gde" href ="{{url('dashboard/aspirantes/sin-verificar')}}">Aspirantes con archivos sin verificar ({{$listB->count()}})</a>
	</div>
	<div class="col-sm-4">
		<a class ="btn view gde" href ="{{url('dashboard/aspirantes')}}">Aspirantes  con archivos</a>
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
		    @foreach ($listB as $aspirant)
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

		{{ $listB->links() }}
		</div>
	</div>
</div>



<div class="row" id ="Noaspirants" style="display:none;">
	<?php /*
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

	*/?>
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
@endsection
