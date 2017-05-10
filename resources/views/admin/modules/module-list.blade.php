@extends('layouts.admin.a_master')
@section('title', 'Lista de módulos')
@section('description', 'Lista de módulos')
@section('body_class', 'modulos')
@section('breadcrumb_type', 'module list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')

@section('content')


@if($modules->count() > 0)
<div class="row">


	<div class="col-sm-9">
		<h1>Lista de módulos</h1>
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
			 			<p class="right"><a href="{{ url('dashboard/modulos/agregar') }}" class="btn ev">[+] Agregar módulo</a></p>

		<table class="table">
		  <thead>
		    <tr>
		      <th>Nombre</th>
		      <th>Fecha Inicio / Fecha Final</th>
		      <th>Sesiones</th>
		      <th>Horas</th>
		      <th>Modalidad</th>
          <th>Publicado</th>
		      <th>Acciones</th>
		    </tr>
		  </thead>
		  <tbody>
		    @foreach ($modules as $module)
		      <tr>
		        <td><h4><a href="{{ url('dashboard/modulos/ver/' . $module->id) }}">{{$module->title}}</a></h4></td>
		        <td>{{date("d-m-Y", strtotime($module->start))}} <br> <strong>{{date('d-m-Y', strtotime($module->end))}}</strong></td>
				    <td>{{$module->sessions->count()}}</td>
		        <td>{{$module->number_hours}} hrs.</td>
            <td>{{$module->modality}}</td>
		        <td>{{$module->public ? "Sí" : "No" }}</td>
		        <td>
		          <a href="{{ url('dashboard/modulos/ver/' . $module->id) }}" class="btn xs ev">Ver</a>
              <a href="{{ url('dashboard/modulos/editar/' . $module->id) }}" class="btn xs view">Actualizar</a>
		         <!-- <a href ="{{ url('dashboard/modulos/eliminar' . $module->id) }}"  id ="{{$module->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>-->
		    </tr>
		    @endforeach
		  </tbody>
		</table>

		{{ $modules->links() }}
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

@else
<div class="row">
	<div class="col-sm-12">
		<h1>Módulos</h1>
		<div class="box center">
			<h2>Aún no existen módulos</h2>
			<p><a href="{{ url('dashboard/modulos/agregar') }}" class="btn add">+ Agregar módulo</a></p>
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
