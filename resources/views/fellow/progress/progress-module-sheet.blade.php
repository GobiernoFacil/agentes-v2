@extends('layouts.admin.a_master')
@section('title', 'Calificaciones')
@section('description', 'Calificaciones')
@section('body_class', 'fellow')
@section('breadcrumb_type', 'score list')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_score')

@section('content')
<div class="row">
  <div class="col-sm-9">
    <h1>Tu progreso</h1>
    <h2>{{$module->title}}</h2>
  </div>
 <div class="col-sm-3 right">
	 <p>Estatus: <span class="score_a block">{{$user->complete_module($module->id) && $user->check_progress($module->slug,0) ? "Completado" : 'Sin completar'}}
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
				@include('fellow.progress.includes.session_list')
		@endforeach
    </div>
  </div>
</div>
@endsection
