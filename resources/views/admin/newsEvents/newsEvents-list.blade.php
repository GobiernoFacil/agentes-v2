@extends('layouts.admin.a_master')
@section('title', 'Noticas y Eventos')
@section('description', 'Noticias y eventos')
@section('body_class', 'news')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Noticias y eventos</h1>
	</div>
	<div class="col-sm-3">
		<a href="{{url('dashboard/noticias-eventos/agregar')}}" class="btn view gde">Agregar Noticia o evento [+]</a>
	</div>
</div>

@if($news->count() > 0)
<div class="box">
</div>
@else
<div class="row">
	<div class="box">
		<h2>Aún no hay noticias</h2>
	</div>
</div>
@endif
@endsection
