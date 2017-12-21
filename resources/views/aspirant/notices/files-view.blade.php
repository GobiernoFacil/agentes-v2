@extends('layouts.admin.a_master')
@section('title', 'Archivos de convocatoria '.$notice->title )
@section('description', 'Archivos de convocatoria '.$notice->title.' - '.$user->name)
@section('body_class', 'aspirante convocatoria')
@section('breadcrumb_type', 'notice files view')
@section('breadcrumb', 'layouts.aspirant.breadcrumb.b_notices')

@section('content')

<!-- title -->

<div class="row">
	<div class="col-sm-12">
    	<h3 class ="center">Tus archivos en la convocatoria</h3>
		<h1 class="center">{{$notice->title}}</h1>

	</div>
</div>

@if($files)
 
@else
<div class="box">
	<div class="row center">
		<h2>Aún no cuentas con archivos</h2>
		<p><a class= "btn view" href='{{url("tablero-aspirante/convocatorias/$notice->slug/agregar-archivos")}}'>Agregar archivos</a></p>
	</div>
</div>
@endif
@endsection
