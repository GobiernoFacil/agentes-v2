@extends('layouts.admin.a_master')
@section('title', 'Lista de aspirantes ')
@section('description', 'Lista de Aspirantes de convocatoria '.$notice->title)
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirants list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_aspirantes')

@section('content')
<div class="row">
	<div class="col-sm-8">
		<h1>Lista de aspirantes de <strong>{{$notice->title}}</strong></h1>
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

@include('admin.aspirants.includes.list_buttons')

<div class="row" id ="aspirants">
	<div class="col-sm-12">
		<div id="table_box" style ="{{$list->count() > 0 ? '' : 'display:none;'}}">
			<table class="table" id="table">
				<thead>
					<tr>
						<th>Nombre / email</th>
						<th>Ciudad / Estado</th>
						<th>Procedencia</th>
						<th>Registro</th>
						<th>Comprobante válido </th>
						<th>Políticas de Privacidad</th>
						<th>Acciones</th>
						<th></th>
					</tr>
				</thead>
				<tbody id = "body_table">
					@if($list->count() > 0)
					    @foreach ($list as $aspirant)
					    <tr>
						    <!--nombre-->
					    	<td><h4><a href="{{ url('dashboard/aspirantes/convocatoria/'.$notice->id.'/ver-aspirante/' . $aspirant->id) }}">{{$aspirant->name.' '.$aspirant->surname." ".$aspirant->lastname}}</a></h4>
					        {{$aspirant->email}}
					        </td>
					        <!--ciudad-->
					        <td>{{$aspirant->city}} <br> <strong>{{$aspirant->state}}</strong></td>
					        <!--procedencia-->
							<td>{{$aspirant->origin}}</td>
							<!--registro-->
					        <td>{{ date("d-m-Y", strtotime($aspirant->created_at)) }} <br> {{ date("H:i", strtotime($aspirant->created_at)) }} hrs.</td>
					        <!--evaluado-->
							<td>{{$aspirant->has_proof_evaluated($notice) ? 'Si' : 'No' }}</td>
							<!--privacy-->
							<td>{{$aspirant->AspirantsFile ? $aspirant->AspirantsFile->privacy_policies ? 'Aceptadas':'No' : 'No' }}</td>
					        <!--acciones-->
					        <td>
					        <a href="{{ url('dashboard/aspirantes/convocatoria/'.$notice->id.'/ver-aspirante/' . $aspirant->id) }}" class="btn xs view">Ver</a></td>
					        <td>
					        @if($aspirant->check_aplication_data())
											<a href="{{ url('dashboard/aspirantes/convocatoria/'.$notice->id.'/evaluar-comprobante/' . $aspirant->id) }}" class="btn xs view ev">Revisar comprobante</a>
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
			<p><strong>Sin aspirantes {{ $type_list === 4 ? 'con comprobante de domicilio por revisar' : ''}}</strong></p>
		@endif
	</div>

	<div class="col-sm-12">
		@if($aWpE_count <= 0)
		<div id="table_box">
			<div class="divider"></div>
			 <div id="noMoretoDisplay">
				<h2 class="center"><strong>Sin aspirantes con comprobante de domicilio por evaluar</strong></h2>
				<p class="center"><a class ="btn view gde" href='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-aplicacion-por-evaluar")}}'>Evaluar aplicación de aspirantes</a></p>
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
