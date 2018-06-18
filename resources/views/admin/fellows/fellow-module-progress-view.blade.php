@extends('layouts.admin.a_master')
@section('title', 'Calificaciones de ' . $fellow->name.' '.$fellow->fellowData->surname.' '.$fellow->fellowData->lastname)
@section('description', 'Calificaciones')
@section('body_class', 'fellows')
@section('breadcrumb_type', 'fellow ')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_fellows')

@section('content')
<div class="row">
  <div class="col-sm-9">
    <h1>Progreso</h1>
    <h2>{{$module->title}}</h2>
  </div>
 <div class="col-sm-3 right">
	 <p>Estatus: <span class="score_a block"> {{$fellow->check_progress($module->slug,0) && $fellow->complete_module($module->id) ? 'Completado' : 'Sin completar'}}
   </span></p>
  </div>

</div>
<div class="box score">
  <div class="row">

    <div class="col-sm-12">
	    <div class="divider"></div>
		<?php $n = 1;?>
		@foreach($module->sessions as $session)
				<!-- evaluaciones por módulo-->
				@include('admin.fellows.evaluation_includes.eval_list_session_progress')
		@endforeach
    </div>
  </div>
</div>
@endsection
