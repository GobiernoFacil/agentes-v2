@extends('layouts.admin.a_master')
@section('title', 'Actualizar archivo de convocatoria')
@section('description', 'Actualizar archivo ".$file->name." de convocatoria '.$file->notice->title)
@section('body_class', 'notice')
@section('breadcrumb_type', 'notice update-file')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_notice')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Actualizar archivo de convocatoria "{{$file->notice->title}}"</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
      @include('admin.notices.form.notice-update-file-form')
		</div>
	</div>
</div>
@endsection
