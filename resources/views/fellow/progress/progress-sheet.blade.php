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
        				@include('fellow.progress.includes.module_list')
        				<?php $n++;?>
        		@endforeach
            {{$modules->links()}}
          @else
             <p><strong>Aún no se cuenta con módulos activos.</strong></p>
          @endif
    </div>
  </div>
</div>
@endsection
