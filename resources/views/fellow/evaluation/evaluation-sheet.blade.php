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
	 <p>Promedio general: <span class="score_a block">{{$user->total_average($user->id) ? number_format($user->total_average($user->id)->average,2) : 'Sin promedio'}}</span></p>
  </div>
	<div class="col-sm-12">
		<p><a href="{{ url('tablero/calificaciones/metodologia') }}" class="link">Consulta la metodología de las calificaciones ></a></p>
	</div>
</div>
<div class="box score">
  <div class="row">

    <div class="col-sm-12">
	    <div class="divider"></div>
		<?php $n = 2;?>
		@foreach($modules as $module)
			@if($module->title ==="Examen de diagnóstico" || $module->title ==="Examen diagnóstico")
				<!-- examen diagnóstico-->
				@include('fellow.evaluation.evaluation_includes.diagnosis')
			@endif
		@endforeach

		@foreach($modules as $module)
			@if($module->title !="Examen de diagnóstico" && $module->title !="Examen diagnóstico")
				<!-- evaluaciones por módulo-->
				@include('fellow.evaluation.evaluation_includes.eval_list')
				<?php $n++;?>
			@endif
		@endforeach
    </div>
  </div>
</div>
@endsection
