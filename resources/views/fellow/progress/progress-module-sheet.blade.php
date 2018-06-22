@extends('layouts.admin.a_master')
@section('title', 'Progreso')
@section('description', 'Progreso')
@section('body_class', 'fellow')
@section('breadcrumb_type', '')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_score')

@section('content')
<div class="row">
	<div class="col-sm-12">
    	<h1>Tu progreso</h1>
	</div>
	<!---módulo--->
	<div class="col-sm-12">
		<div class="box session_list last_activity">
			<div class="row">
				<!--título-->
				<div class="col-sm-9">
					<h3><a href='{{ url("tablero/{$module->program->slug}/aprendizaje/{$module->slug}") }}' class="ap_link_module">{{$module->title}}</a></h3>					
				</div>
				<!--enlace-->
				<div class="col-sm-3">
					<p class="right">Estatus: 
						@if($user->complete_module($module->id) && $user->check_progress($module->slug,0))
						<span class="score_a block">Completado</span>
						@else
						 <span class="noscore_a block">Sin completar</span>
						@endif
   					</p>
				</div>
			</div>
		</div>
	</div>
</div>

<!--sesiones-->
<div class="row">
    <div class="col-sm-11 col-sm-offset-1">
		<?php $n = 1;?>
		@foreach($module->sessions as $session)
			<!-- evaluaciones por módulo-->
			@include('fellow.progress.includes.session_list')
		@endforeach
    </div>
</div>
@endsection