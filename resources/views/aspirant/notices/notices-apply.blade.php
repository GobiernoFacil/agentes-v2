@extends('layouts.admin.a_master')
@section('title', 'Aplicar a convocatoria '.$notice->title )
@section('description', 'Aplicar a convocatoria '.$notice->title)
@section('body_class', 'aspirante convocatoria')
@section('breadcrumb_type', 'notice apply')
@section('breadcrumb', 'layouts.aspirant.breadcrumb.b_notices')

@section('content')

<!-- title -->
<div class="row">
	<div class="col-sm-12">
    	<h3 class ="center">Aplicar a convocatoria "{{$notice->title}}""</h3>
		<h1 class="center">{{$notice->title}}</h1>
	</div>
</div>

<div class="box">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			@include('aspirant.notices.forms.apply-1')
		</div>
	</div>
</div>
@endsection
