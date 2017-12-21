@extends('layouts.admin.a_master')
@section('title', 'Agregar archivos a convocatoria '.$notice->title )
@section('description', 'Agregar archivos a convocatoria '.$notice->title.' - '.$user->name)
@section('body_class', 'aspirante convocatoria')
@section('breadcrumb_type', 'notice files add')
@section('breadcrumb', 'layouts.aspirant.breadcrumb.b_notices')

@section('content')

<!-- title -->

<div class="row">
	<div class="col-sm-12">
    	<h3 class ="center">Agregar archivos a convocatoria</h3>
		<h1 class="center">{{$notice->title}}</h1>

	</div>
</div>


@endsection
