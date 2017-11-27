@extends('layouts.admin.a_master')
@section('title', 'Ver convocatoria')
@section('description', 'Ver convocatoria '.$notice->title)
@section('body_class', 'notice')
@section('breadcrumb_type', 'notice add-view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_notice')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Convocatoria "{{$notice->title}}"</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
		</div>
	</div>
</div>
@endsection
