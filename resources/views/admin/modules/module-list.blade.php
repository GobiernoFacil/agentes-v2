@extends('layouts.admin.a_master')
@section('title', 'Agregar módulo')
@section('description', 'Agregar nuevo módulo')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
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
				    <td>{{$module->number_sessions}}</td>
		        <td>{{$module->number_hours}} hrs.</td>
            <td>{{$module->modality}}</td>
		        <td>{{$module->public ? "Sí" : "No" }}</td>
		        <td>
		          <a href="{{ url('dashboard/modulos/ver/' . $module->id) }}" class="btn xs view">Ver</a>
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
