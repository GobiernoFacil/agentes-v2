@extends('layouts.admin.a_master')
@section('title', 'Lista de programas')
@section('description', 'Lista de programas')
@section('body_class', 'programs')
@section('breadcrumb_type', 'programs list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')

@section('content')


@if($programs->count() > 0)
<div class="row">


	<div class="col-sm-9">
		<h1>Lista de programas</h1>
	</div>
	<div class="col-sm-3">
		<form  role="form" method="GET" action="{{ url('dashboard/modulos') }}" id="search-input">
			<input id = "search-module" type="search" name="searchBox" class="form-control" placeholder="Buscar Módulo" value="{{request('searchBox', '')}}">
			<p id ="nR" style="display:none;">No existen resultados</p>
		</form>
	</div>
</div>
<div class="row" id ="aspirants">
	<div class="col-sm-12">
		<div class="box">
			 			<p class="right"><a href="{{ url('dashboard/modulos/agregar') }}" class="btn ev">[+] Agregar programa</a></p>

		<table class="table">
		  <thead>
		    <tr>
		      <th>Nombre</th>
		      <th>Fecha Inicio / Fecha Final</th>
		      <th>Módulos</th>
          <th>Publicado</th>
		      <th>Acciones</th>
		    </tr>
		  </thead>
		  <tbody>
		    @foreach ($programs as $program)
		      <tr>
		        <td><h4><a href="{{ url('dashboard/programas/ver/' . $program->id) }}">{{$program->title}}</a></h4></td>
		        <td>{{date("d-m-Y", strtotime($program->start))}} <br> <strong>{{date('d-m-Y', strtotime($program->end))}}</strong></td>
				    <td>{{$program->modules->count()}}</td>
		        <td>{{$program->public ? "Sí" : "No" }}</td>
		        <td>
		          <a href="{{ url('dashboard/programas/ver/' . $program->id) }}" class="btn xs ev">Ver</a>
              <a href="{{ url('dashboard/programas/editar/' . $program->id) }}" class="btn xs view">Actualizar</a>
		         <!-- <a href ="{{ url('dashboard/modulos/eliminar' . $module->id) }}"  id ="{{$module->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>-->
		    </tr>
		    @endforeach
		  </tbody>
		</table>

		{{ $programs->links() }}
		</div>
	</div>
</div>

@else
<div class="row">
	<div class="col-sm-12">
		<h1>Programas</h1>
		<div class="box center">
			<h2>Aún no existen programas</h2>
			<p><a href="{{ url('dashboard/programas/agregar') }}" class="btn add">+ Agregar programa</a></p>
		</div>
	</div>
</div>

@endif

@endsection

@section('js-content')
<script src="{{url('js/app-search.js')}}"></script>
<script>
var CONFIG = {
	search_url:    "{{url('dashboard/modulos/buscar')}}",
	general_aspirant_url :    "{{url('dashboard/modulos/ver')}}",
	token      : document.querySelector('input[name="_token"]').value
};
appSearch.initialize(CONFIG);
document.getElementById("search-module").onblur = function() {
	if(this.value==''){
		document.getElementById("boxResults").style.display ="none";
		document.getElementById("modules").style.display ="block";
		document.getElementById("nR").style.display ="none";
	}
};
</script>
@endsection
