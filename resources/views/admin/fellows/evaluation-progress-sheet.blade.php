@extends('layouts.admin.a_master')
@section('title', 'Calificaciones de ' . $fellow->name.' '.$fellow->fellowData->surname.' '.$fellow->fellowData->lastname)
@section('description', 'Calificaciones')
@section('body_class', 'fellows')
@section('breadcrumb_type', 'fellow ')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_fellows')

@section('content')
<div class="row">
  <div class="col-sm-9">
    <h1>Progreso de {{$fellow->name.' '.$fellow->fellowData->surname.' '.$fellow->fellowData->lastname}}</h1>
		<h2>Programa "{{$program->title}}"</h2>
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
        				@include('admin.fellows.evaluation_includes.progress_list')
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
