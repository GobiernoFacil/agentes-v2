@extends('layouts.admin.a_master')
@section('title', 'Calificaciones')
@section('description', 'Calificaciones')
@section('body_class', 'fellow')
@section('breadcrumb_type', 'score list')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_score')

@section('content')
<div class="row">
  <div class="col-sm-9">
    <h1>Calificaciones</h1>
  </div>
 <div class="col-sm-3 right">
	 <p>Promedio general: <span class="score_a block">{{$user->total_average($program->id) ? number_format(($user->total_average($program->id)->average)*10,2) : 'Sin promedio'}}</span></p>
  </div>
	<div class="col-sm-12">
		<p><a href='{{ url("tablero/$program->slug/calificaciones/metodologia") }}' class="link">Consulta la metodología de las calificaciones ></a></p>
	</div>
</div>
<div class="box score">
  <div class="row">

    <div class="col-sm-12">
	    <div class="divider"></div>
    @if($modules->count() > 0)
  		<?php $n = 1;?>
  		@foreach($modules as $module)
  				<!-- evaluaciones por módulo-->
  				@include('fellow.evaluation.evaluation_includes.eval_list')
  				<?php $n++;?>
  		@endforeach
    @else
       <p><strong>Aún no se cuenta con módulos activos.</strong></p>
    @endif
    </div>
  </div>
</div>
@endsection
