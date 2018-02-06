@extends('layouts.admin.a_master')
@section('title', 'Agregar archivo a convocatoria')
@section('description', 'Agregar archivo a convocatoria '.$notice->title)
@section('body_class', 'notice')
@section('breadcrumb_type', 'notice add-files')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_notice')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Agregar archivos a convocatoria "{{$notice->title}}"</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
      @include('admin.notices.form.notice-add-file-form')
		</div>
	</div>
</div>
@endsection
