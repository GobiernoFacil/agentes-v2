@extends('layouts.admin.a_master')
@section('title', 'Calificaciones de ' . $fellow->name.' '.$fellow->fellowData->surname.' '.$fellow->fellowData->lastname)
@section('description', 'Calificaciones')
@section('body_class', 'fellows')
@section('breadcrumb_type', 'fellow ver calificaciones')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_fellows')

@section('content')
<div class="row">
  <div class="col-sm-9">
    <h1>Calificaciones</h1>
    <h2>{{$module->title}}</h2>
  </div>
 <div class="col-sm-3 right">
	 <p>Calificación: <span class="score_a block">{{$fellow->module_average($module->id) ? number_format($fellow->module_average($module->id)->average,2)*10 : 'Sin calificación'}}
   </span></p>
  </div>
  <?php
  /*
	<div class="col-sm-12">
		<p><a href='{{ url("tablero/$program->slug/calificaciones/metodologia") }}' class="link">Consulta la metodología de las calificaciones ></a></p>
	</div>
  */
  ?>
</div>
<div class="box score">
  <div class="row">

    <div class="col-sm-12">
	    <div class="divider"></div>
		<?php $n = 1;?>
		@foreach($module->sessions as $session)
				<!-- evaluaciones por módulo-->
				@include('admin.fellows.evaluation_includes.eval_list_session')
		@endforeach
    </div>
  </div>
</div>
@endsection
