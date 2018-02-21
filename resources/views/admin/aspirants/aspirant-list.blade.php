@extends('layouts.admin.a_master')
@section('title', 'Lista de aspirantes ')
@section('description', 'Lista de Aspirantes de convocatoria '.$notice->title)
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirants list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_aspirantes')

@section('content')
<div class="row">
	<div class="col-sm-8">
		<h1>Lista de aspirantes</h1>
		<h2>Convocatoria "{{$notice->title}}" </h2>

	</div>
	<div class="col-sm-4">
		<form  role="form" method="GET" action="{{ url('dashboard/aspirantes') }}" id="search-input">
			<input id = "search-aspirant" type="search" name="searchBox" class="form-control" placeholder="Buscar por nombre, apellidos, estado o ciudad" value="{{request('searchBox', '')}}">
			<p id ="nR" style="display:none;">No existen resultados</p>
			<div class = "row">
 	 		<div class="col-sm-12" id ="search-results" style ="visibility:hidden;">
 	 		</div>
 	 	</div>
		</form>
	</div>
</div>

@if($type_list === 0)
<div class="row">
	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-sin-archivos")}}'>Aspirantes <span class= "strong" >sin</span> archivos ({{$aWp_count}})</a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-sin-archivos-validos")}}'>Aspirantes <span class= "strong">con comprobante no válido ({{$aRp_count}})</span></a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-archivos-evaluados")}}'>Aspirantes <span class= "strong">evaluados ({{$aAe_count}})</span></a>
	</div>
	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-archivo-por-evaluar")}}'>Aspirantes por <span class= "strong" >evaluar ({{$aWpE_count}})</span></a>
	</div>
</div>
<p><strong>Todos los aspirantes</strong></p>
@elseif($type_list === 1)
<div class="row">
	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/ver")}}'>Todos los  <span class= "strong" >aspirantes</span> ({{$aWp_count}})</a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-sin-archivos-validos")}}'>Aspirantes <span class= "strong">con comprobante no válido ({{$aRp_count}})</span></a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-archivos-evaluados")}}'>Aspirantes <span class= "strong">evaluados ({{$aAe_count}})</span></a>
	</div>
	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-archivo-por-evaluar")}}'>Aspirantes por <span class= "strong" >evaluar ({{$aWpE_count}})</span></a>
	</div>
</div>
<p><strong>Aspirantes sin archivos</strong></p>
@elseif($type_list === 2)
<div class="row">
	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/ver")}}'>Todos los  <span class= "strong" >aspirantes</span> ({{$aWp_count}})</a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-sin-archivos")}}'>Aspirantes <span class= "strong" >sin</span> archivos ({{$aWp_count}})</a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-archivos-evaluados")}}'>Aspirantes <span class= "strong">evaluados ({{$aAe_count}})</span></a>
	</div>
	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-archivo-por-evaluar")}}'>Aspirantes por <span class= "strong" >evaluar ({{$aWpE_count}})</span></a>
	</div>
</div>
<p><strong>Aspirantes con comprobante de domicilio no válido</strong></p>
@elseif($type_list === 3)
<div class="row">
	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/ver")}}'>Todos los  <span class= "strong" >aspirantes</span> ({{$aWp_count}})</a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-sin-archivos")}}'>Aspirantes <span class= "strong" >sin</span> archivos ({{$aWp_count}})</a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-sin-archivos-validos")}}'>Aspirantes <span class= "strong">con comprobante no válido ({{$aRp_count}})</span></a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-archivo-por-evaluar")}}'>Aspirantes por <span class= "strong" >evaluar ({{$aWpE_count}})</span></a>
	</div>
</div>
<p><strong>Aspirantes evaluados</strong></p>
@elseif($type_list === 4)
<div class="row">
	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/ver")}}'>Todos los  <span class= "strong" >aspirantes</span> ({{$aWp_count}})</a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-sin-archivos")}}'>Aspirantes <span class= "strong" >sin</span> archivos ({{$aWp_count}})</a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-sin-archivos-validos")}}'>Aspirantes <span class= "strong">con comprobante no válido ({{$aRp_count}})</span></a>
	</div>


	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-archivos-evaluados")}}'>Aspirantes <span class= "strong">evaluados ({{$aAe_count}})</span></a>
	</div>

</div>
<p><strong>Aspirantes por evaluar</strong></p>
@endif

<div class="row" id ="aspirants">
	<div class="col-sm-12">
		<div class="box" id ="table_box" style ="{{$list->count() > 0 ? '' : 'display:none;'}}">
								<table class="table" 	 id="table">
								  <thead>
								    <tr>
								      <th>Nombre / email</th>
								      <th>Ciudad / Estado</th>
								      <th>Procedencia</th>
								      <th>Registro</th>
								      <th>Acciones</th>
								    </tr>
								  </thead>
												<tbody id = "body_table">
													@if($list->count() > 0)
													    @foreach ($list as $aspirant)
													      <tr>
													        <td><h4><a href="{{ url('dashboard/aspirantes/convocatoria/'.$notice->id.'/ver-aspirante/' . $aspirant->id) }}">{{$aspirant->name.' '.$aspirant->surname." ".$aspirant->lastname}}</a></h4>
													        {{$aspirant->email}}
													        </td>
													        <td>{{$aspirant->city}} <br> <strong>{{$aspirant->state}}</strong></td>
																	<td>{{$aspirant->origin}}</td>
													        <td>{{ date("d-m-Y", strtotime($aspirant->created_at)) }} <br> {{ date("H:i", strtotime($aspirant->created_at)) }} hrs.</td>
													        <td>
													          <a href="{{ url('dashboard/aspirantes/convocatoria/'.$notice->id.'/ver-aspirante/' . $aspirant->id) }}" class="btn xs view">Ver</a>
																		@if($aspirant->AspirantsFile)
																			@if($aspirant->AspirantsFile->proof)
																			<a href="{{ url('dashboard/aspirantes/convocatoria/'.$notice->id.'/evaluar-comprobante/' . $aspirant->id) }}" class="btn xs view ev">Evaluar</a>
																			@endif
																		@endif
																	</td>
													     </tr>
													    @endforeach
													@endif
										  </tbody>
								</table>

		<div id ="pagination_links">
		  {{ $list->links() }}
	  </div>
		</div>

		@if($list->count() == 0)
			<p><strong>Sin aspirantes</strong></p>
		@endif

		@if($aWpE_count <= 0)
		<div class="box" id ="table_box">
			 <div id ="noMoretoDisplay">
					<p><strong>Sin aspirantes con comprobante de domicilio por evaluar</strong></p>
					<a class ="btn view" href='{{url("dashboard/aspirantes/convocatoria/$notice->id/ver/evaluar-aspirantes")}}'>Evaluar aplicación de aspirantes</a>
			</div>
		</div>
		@endif
	</div>
</div>
@endsection


@section('js-content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src ='{{url("js/aspirant-search.js")}}'></script>
<script>
  <?php echo 'var aspirants         = '.$aspirants.';'; ?>
	<?php echo 'var view_aspirant_url = "'.url("dashboard/aspirantes/convocatoria/$notice->id/ver-aspirante/").'";'; ?>
</script>
@endsection
