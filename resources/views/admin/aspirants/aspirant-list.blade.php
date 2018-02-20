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
		@if($aWpE->count() != 0)
			<p id = "evaluate_message">Aspirantes que requieren evaluación</p>
		@else
			<p id = "proof_message">Aspirantes con comprobante de domicilio <strong>sin verificar</strong></p>
		@endif

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


<div class="row">
	<div class="col-sm-3">
		<a class ="btn view gde" id="aspirants_without_proof" href ="">Aspirantes <span class= "strong" id="aspirants_without_proof_text">sin</span> archivos</a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde" id="rejected_aspirants" href ="">Aspirantes <span class= "strong" id="rejected_aspirants_text">con comprobante no válido</span></a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde" id="already_aspirants" href ="">Aspirantes <span class= "strong" id="already_aspirants_text">evaluados</span></a>
	</div>
	<div class="col-sm-3">
		<a class ="btn view gde" id="aspirants_to_evaluate" href ="">Aspirantes por <span class= "strong" id="aspirants_to_evaluate_text">evaluar</span></a>
	</div>
</div>

<div class="row" id ="aspirants">
	<div class="col-sm-12">
		<div class="box" id ="table_box" style ="{{$aWpE->count() > 0 ? '' : 'display:none;'}}">
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
													@if($aWpE->count() > 0)
													    @foreach ($aWpE as $aspirant)
													      <tr>
													        <td><h4><a href="{{ url('dashboard/aspirantes/convocatoria/'.$notice->id.'/ver-aspirante/' . $aspirant->id) }}">{{$aspirant->name.' '.$aspirant->surname." ".$aspirant->lastname}}</a></h4>
													        {{$aspirant->email}}
													        </td>
													        <td>{{$aspirant->city}} <br> <strong>{{$aspirant->state}}</strong></td>
																	<td>{{$aspirant->origin}}</td>
													        <td>{{ date("d-m-Y", strtotime($aspirant->created_at)) }} <br> {{ date("H:i", strtotime($aspirant->created_at)) }} hrs.</td>
													        <td>
													          <a href="{{ url('dashboard/aspirantes/convocatoria/'.$notice->id.'/ver-aspirante/' . $aspirant->id) }}" class="btn xs view">Ver</a>
																		<a href="{{ url('dashboard/aspirantes/convocatoria/'.$notice->id.'/evaluar-comprobante/' . $aspirant->id) }}" class="btn xs view ev">Evaluar</a>
																	</td>
													     </tr>
													    @endforeach
													@endif
										  </tbody>
								</table>

		<div id ="pagination_links">
		  {{ $aWpE->links() }}
	  </div>


		</div>
		@if($aWpE->count() <= 0)
		<div class="box" id ="table_box">
			 <div id ="noMoretoDisplay">
					<p><strong>Sin aspirantes con comprobante de domicilio por evaluar</strong></p>
					<a class ="btn view" href='{{url("dashboard/aspirantes/convocatoria/$notice->id/ver/evaluar-aspirantes")}}'>Evaluar aspirantes</a>
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
	<?php echo 'var evaluate_aspirant_url = "'.url("dashboard/aspirantes/convocatoria/$notice->id/evaluar-comprobante/").'";'; ?>
	<?php echo 'var rejected_proof    = '.$aRp->toJson().';';?>
	<?php echo 'var aspirants_without_proof    = '.$aWp->toJson().';';?>
	<?php echo 'var initial_list      = '.$aWpE->toJson().';';?>
	<?php echo 'var alrady_evaluated  = '.$aAe->toJson().';';?>
</script>
<script src ='{{url("js/aspirant-tables.js")}}'></script>
@endsection
