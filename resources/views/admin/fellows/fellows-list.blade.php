@extends('layouts.admin.a_master')
@section('title', 'Lista de Fellows')
@section('description', 'Lista de Fellows')
@section('body_class', 'fellows')
@section('breadcrumb_type', 'fellows list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_fellows')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Lista de Fellows </h1>
	</div>
	<div class="col-sm-3">
		<form  role="form" method="GET" action="{{ url('dashboard/fellows') }}" id="search-input">
			<input id = "search-aspirant" type="search" name="searchBox" class="form-control" placeholder="Buscar Fellow o Estado" value="{{request('searchBox', '')}}">
			<p id ="nR" style="display:none;">No existen resultados</p>
		</form>
	</div>
</div>


@if($fellows->count() > 0)
<div class="row" id ="aspirants">
	<div class="col-sm-12">
		<div class="box">
		<table class="table">
		  <thead>
		    <tr>
		      <th>Nombre / email</th>
		      <th>Ciudad / Estado</th>
		      <th>Promedio</th>
		      <th>Acciones</th>
		    </tr>
		  </thead>
		  <tbody>
		    @foreach ($fellows as $fellow)
		      <tr>
		        <td><div class="row">
			        <div class="col-sm-2">
				        @if($fellow->image)
						<img src='{{url("img/users/{$fellow->image->name}")}}' height="30px">
						@else
						<img src='{{url("img/users/default.png")}}' height="30px">
						@endif
			        </div>
			        <div class="col-sm-10">
			        <h4><a href="{{ url('dashboard/fellows/ver/' . $fellow->id) }}">{{$fellow->name.' '.$fellow->fellowData->surname." ".$fellow->fellowData->lastname}}</a></h4>
					{{$fellow->email}}<br>
					{{$fellow->fellowData->origin}}
			        </div>
		       	 </div>
		        </td>
		        <td>{{$fellow->fellowData->city}} <br> <strong>{{$fellow->fellowData->state}}</strong></td>
				<td>
					<a href="{{ url('dashboard/fellows/calificaciones/ver/' . $fellow->id) }}"><span class="score_a block">{{$fellow->total_average($fellow->id) ? number_format($fellow->total_average($fellow->id)->average,2) : 'Sin promedio'}}</span></a>
				</td>
		        
		        <td>
		          <a href="{{ url('dashboard/fellows/ver/' . $fellow->id) }}" class="btn xs view">Ver perfil</a>
		         <!-- <a href ="{{ url('dashboard/aspirantes/eliminar' . $fellow->id) }}"  id ="{{$fellow->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a>-->
		         </td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>

		{{ $fellows->links() }}
		</div>
	</div>
</div>
@else 
<div class="box">
	<div class="row">
		<div class="col-sm-12 center">
			<h2>Aún no hay fellows, estamos actualizando la db, regresa el 9 de junio.</h2>
			<h3>:)</h3>
		</div>
	</div>
</div>
@endif








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
	search_url:    "{{url('dashboard/fellows/buscar')}}",
	general_aspirant_url :    "{{url('dashboard/fellows/ver')}}",
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