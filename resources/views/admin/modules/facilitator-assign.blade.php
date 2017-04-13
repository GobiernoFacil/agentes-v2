@extends('layouts.admin.a_master')
@section('title', 'Asignar facilitador')
@section('description', 'Asignar facilitador')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
<div class="row">
  <div class="col-sm-9">
    <h1>Asignar facilitador</h1>
  </div>
  <div class="col-sm-3">
    <form  role="form" method="GET" action="{{ url('dashboard/modulos/facilitador/buscar') }}" id="search-input">
      <input id = "search-fac" type="search" name="searchBox" class="form-control" placeholder="Buscar Facilitador" value="{{request('searchBox', '')}}">
      <p id ="nR" style="display:none;">No existen resultados</p>
    </form>
  </div>
</div>
<div class="div"></div>

<!-- success message  -->
<div class="row">
  <div class="col-sm-9">
    <span class = "success" id ="successMessage" style="display:none;">Se ha seleccionado correctamente</span>
</div>
</div>
<!-- box results -->
<div id = "boxResults" style="display:none;">
	<table class="table" id = "resultList">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Email</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody id ="List">
		</tbody>
</table>
</div>
<!--form -->
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.modules.form.facilitator-assign-form')
    </div>
  </div>
</div>

@endsection

@section('js-content')
<script src="{{url('js/app-search-facilitator.js')}}"></script>
<script>
var CONFIG = {
	search_url:    "{{url('dashboard/modulos/facilitadores/buscar')}}",
	general_aspirant_url :    "{{url('dashboard/facilitadores/ver')}}",
	token      : document.querySelector('input[name="_token"]').value
};
appSearch.initialize(CONFIG);
document.getElementById("search-fac").onblur = function() {
	if(this.value==''){
		document.getElementById("boxResults").style.display ="none";
		//document.getElementById("facilitators").style.display ="block";
		document.getElementById("nR").style.display ="none";
	}

};

document.getElementById("search-fac").addEventListener("change", function() {
      if(document.getElementById("search-fac").value.trim()==''){
        document.getElementById("nR").style.display ="none";
      }
    });
</script>
@endsection
