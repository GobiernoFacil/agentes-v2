@extends('layouts.admin.fellow_master')
@section('title', 'Convocatorias en la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible' )
@section('description', 'Lista de convocatorias en la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'aspirante convocatoria')
@section('breadcrumb_type', 'notice index')
@section('breadcrumb', 'layouts.aspirant.breadcrumb.b_notices')

@section('content')

<!-- title -->
<div class="row">
	<div class="col-sm-12">
    	<h3 class ="center">Convocatorias</h3>
		<div class="divider"></div>
	</div>
</div>

<!-- lista de convocatorias-->
@if($notices->count() > 0)
    @foreach($notices as $single)
    <div class="box session_list">
	  	<div class="row">
			<!--icono-->
			<div class="col-sm-1 right">
				<b class="icon_h session list_s"></b>
			</div>
			<div class="col-sm-7">
				<h2><a href='{{ url("tablero-aspirante/convocatorias/{$single->notice->slug}") }}'>{{$single->notice->title}}</a></h2>
				<div class="divider"></div>
					<div class="row">
						<div class="col-sm-8">
							<p>{{$single->notice->objective}}</p>
						</div>
						<div class="col-sm-4 notes">
							<p class="right">Fechas:<br>{{date("d-m-Y", strtotime($single->notice->start))}} al {{date('d-m-Y', strtotime($single->notice->end))}}</p>
						</div>
					</div>
				</div>
				<!-- ver convocatoria-->
				<div class="col-sm-2">
					<a class="btn view"  href='{{ url("tablero-aspirante/convocatorias/{$single->notice->slug}") }}'>Ver convocatoria</a>
				</div>

				<div class="col-sm-2">
					<a class="btn view "  href='{{ url("tablero-aspirante/convocatorias/{$single->notice->slug}/ver-archivos") }}'>Ver archivos</a>
				</div>
			
			</div>
		</div>
    @endforeach
@else
<div class="box">
	<div class="row center">
		<h2>No existen convocatorias abiertas</h2>
	</div>
</div>
@endif


@endsection
