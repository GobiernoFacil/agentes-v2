@extends('layouts.admin.a_master')
@section('title', 'Calificaciones de ' . $fellow->name.' '.$fellow->fellowData->surname.' '.$fellow->fellowData->lastname)
@section('description', 'Calificaciones')
@section('body_class', 'fellows')
@section('breadcrumb_type', 'fellow ver calificaciones')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_fellows')

@section('content')
<div class="row">
  <div class="col-sm-9">
    <h1>Calificaciones de {{$fellow->name.' '.$fellow->fellowData->surname.' '.$fellow->fellowData->lastname}}</h1>
  </div>
 <div class="col-sm-3 right">
	 <p>Promedio general: <span class="score_a block">{{$fellow->total_average($fellow->id) ? number_format($fellow->total_average($fellow->id)->average,2) : 'Sin promedio'}}</span></p>
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
				@include('admin.fellows.evaluation_includes.diagnosis')
			@endif
		@endforeach
		
		@foreach($modules as $module)
			@if($module->title !="Examen de diagnóstico" && $module->title !="Examen diagnóstico")
				<!-- evaluaciones por módulo-->
				@include('admin.fellows.evaluation_includes.eval_list')
				<?php $n++;?>
			@endif
		@endforeach
    </div>
  </div>
</div>
@endsection
