@extends('layouts.admin.a_master')
@section('title', 'Ver convocatoria')
@section('description', 'Ver convocatoria '.$notice->title)
@section('body_class', 'notice')
@section('breadcrumb_type', 'notice view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_notice')

@section('content')
@if(Session::has('message'))
<div class="row">
  <div class="col-sm-12 message success">
      <p>{{ Session::get('message') }}</p>
  </div>
</div>
@endif
<div class="row">
	<div class="col-sm-12 center">
		<h4 class="center"></h4>
		<div class="divider b"></div>
		<h2>Convocatoria</h2>
		<h1 class="center">{{$notice->title}} <span class="le_link"><a href="{{ url('dashboard/convocatorias/editar/'. $notice->id ) }}" class="btn view">Editar convocatoria</a></span></h1>
		<div class="divider"></div>
	</div>
</div>

<!-- header -->
<div class="row h_tag">
	<div class="col-sm-4 center">
		<h4><b class="icon_h i_dates_green"></b> Fecha inicio</h4>
		<p>{{date("d-m-Y", strtotime($notice->start))}}</p>
	</div>
	<div class="col-sm-4 center">
		<h4><b class="icon_h i_dates_green"></b> Fecha final</h4>
		<p>{{date('d-m-Y', strtotime($notice->end))}}</p>
	</div>
  <div class="col-sm-4 center">
		<h4><b class="icon_h i_dates_green"></b> Publicada</h4>
		<p>{{$notice->public ? 'Sí' : 'No'}}</p>
	</div>
	<div class="col-sm-12">
		<div class="divider top"></div>
	</div>
</div>

<!--- description-->
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="title">Descripción <span class="le_link right"><a href="{{ url('dashboard/convocatorias/editar/'. $notice->id ) }}" class="btn view">Editar convocatoria</a></span></h2>
			<p>{{$notice->description}}</p>
		</div>
	</div>
</div>
<!--- objetivos-->
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="title">Objetivo <span class="le_link right"><a href="{{ url('dashboard/convocatorias/editar/'. $notice->id ) }}" class="btn view">Editar convocatoria</a></span></h2>
			<p>{{$notice->objective}}</p>
		</div>
	</div>
</div>
<!--- modality_results-->
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="title">Modalidad y resultados esperados <span class="le_link right"><a href="{{ url('dashboard/convocatorias/editar/'. $notice->id ) }}" class="btn view">Editar convocatoria</a></span></h2>
			<p>{{$notice->modality_results}}</p>
		</div>
	</div>
</div>
<!--- Perfil de egreso-->
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="title">Perfil de egreso <span class="le_link right"><a href="{{ url('dashboard/convocatorias/editar/'. $notice->id ) }}" class="btn view">Editar convocatoria</a></span></h2>
			<p>{{$notice->profile}}</p>
		</div>
	</div>
</div>

<!--- perfil y elegibilidad-->
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="title">Perfil y elegibilidad de los participantes <span class="le_link right"><a href="{{ url('dashboard/convocatorias/editar/'. $notice->id ) }}" class="btn view">Editar convocatoria</a></span></h2>
			<p>{{$notice->profile_eligibility_description}}</p>
      <h3>Criterios Generales</h3>
      <p>{{$notice->profile_eligibility_general}}</p>
      <h3>Criterios Particulares</h3>
      <p>{{$notice->profile_eligibility_particular}}</p>
		</div>
	</div>
</div>

<!--- Plazos-->
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="title">Plazos y proceso de postulación <span class="le_link right"><a href="{{ url('dashboard/convocatorias/editar/'. $notice->id ) }}" class="btn view">Editar convocatoria</a></span></h2>
			<p>{{$notice->term_process}}</p>
		</div>
	</div>
</div>

<!--- Casos no previstos-->
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="title">Casos no previstos <span class="le_link right"><a href="{{ url('dashboard/convocatorias/editar/'. $notice->id ) }}" class="btn view">Editar convocatoria</a></span></h2>
			<p>{{$notice->unforeseen_cases}}</p>
		</div>
	</div>
</div>

<!--- contacto-->
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="title">Contacto <span class="le_link right"><a href="{{ url('dashboard/convocatorias/editar/'. $notice->id ) }}" class="btn view">Editar convocatoria</a></span></h2>
			<p>{{$notice->contact}}</p>
		</div>
	</div>
</div>

<!--archivos-->
<div class="box">
	<div class="row">
		<div class="col-sm-9">
			<h2 class="title">Archivos</h2>
		</div>
		<div class="col-sm-3">
			<p class="right"><a href='{{url("dashboard/convocatorias/agregar-archivos/$notice->id")}}' class="btn xs ev">[+] Agregar archivos</a></p>
		</div>
		<div class="col-sm-12">
			@if($notice->files->count() > 0)
      @include('admin.notices.files-list')
			@else
			<p>Sin archivos</p>
			<a href='{{url("dashboard/convocatorias/agregar-archivos/$notice->id")}}' class="btn xs view">Agregar archivo</a>
			@endif
		</div>
	</div>
</div>

@endsection
