@extends('layouts.admin.a_master')
@section('title', 'Lista de aspirantes ')
@section('description', 'Lista de Aspirantes de convocatoria '.$notice->title)
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirants list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_aspirantes')

@section('content')
<div class="row">
	<div class="col-sm-8">
		<h1>
		@if($type_list != 0)
			Tu lista de aspirantes a evaluar
		@else
		  Lista de aspirantes a evaluar
		@endif
		de  <strong>{{$notice->title}}</strong> </h1>
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

@include('admin.aspirants.includes.list_institutions_buttons')

<div class="row" id ="aspirants">
	<div class="col-sm-12">
		<div id="table_box" style ="{{$list->count() > 0 ? '' : 'display:none;'}}">
								<table class="table" 	 id="table">
								  <thead>
								    <tr>
								      <th>Nombre / email</th>
								      <th>Ciudad / Estado</th>
								      <th>Procedencia</th>
								      <th>Registro</th>
											@if($type_list != 0)
											<th>Tu calificación</th>
											@else
											<th>Calificación</th>
											@endif
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
																	@if($type_list != 0)
																	<td>{{$aspirant->AspirantEvaluation()->where('institution',$user->institution)->whereNotNull('grade')->first() ? number_format($aspirant->AspirantEvaluation()->where('institution',$user->institution)->first()->grade,2) : "Sin calificación"}}</td>
																	@else
																	<td>{{$aspirant->global_grade ? number_format($aspirant->global_grade->grade,2) : "Sin calificación"}}</td>
																	@endif
													        <td>
													          <a href="{{ url('dashboard/aspirantes/convocatoria/'.$notice->id.'/ver-aspirante/' . $aspirant->id) }}" class="btn xs view">Ver</a>
																		<a href="{{ url('dashboard/aspirantes/convocatoria/'.$notice->id.'/evaluar-aplicacion/' . $aspirant->id) }}" class="btn xs view ev">Evaluar</a>
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


	</div>
</div>
@endsection


@section('js-content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src ='{{url("js/aspirant-search.js")}}'></script>
<script>
  <?php echo 'var aspirants         = '.$aspirants.';'; ?>
	<?php echo 'var view_aspirant_url = "'.url("dashboard/aspirantes/convocatoria/$notice->id/ver-aspirante/").'";'; ?>
	@if($type_list === 0)
 <?php echo 'var  url_state        ="'.url("dashboard/aspirantes/convocatoria/$notice->id/todos-los-aspirantes-con-aplicacion-evaluada/").'";'; ?>
		$('#state').change(function(){
				var state  = $(this).val();
				window.location.href = url_state+"/"+state;
		});
	@endif
</script>
@endsection
