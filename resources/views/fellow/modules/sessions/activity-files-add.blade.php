@extends('layouts.admin.a_master')
@section('title', 'Agregar archivo' )
@section('description', '' )
@section('body_class', 'fellow aprendizaje modulos')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Agregar archivo</h1>
	</div>
</div>
<div class="box">
		<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
      @include('fellow.modules.sessions.forms.activity-files-form')
    </div>
  </div>
</div>
@endsection
