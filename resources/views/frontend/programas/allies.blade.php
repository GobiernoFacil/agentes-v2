@extends('layouts.frontend.master')
@section('title', 'Equipo del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Equipo del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'programa aliados')
@section('canonical', url('programa-gobierno-abierto/equipo'))
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_programa')

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1><strong>Alianzas</strong> del PROGRAMA DE FORMACIÓN DE <strong>AGENTES LOCALES DE CAMBIO</strong> EN <strong>GOBIERNO ABIERTO</strong> Y DESARROLLO SOSTENIBLE</h1>
		<p>El componente estará apoyado por actores tanto del gobierno como de la sociedad civil, lo cual contribuirá a alcanzar los objetivos planteados.</p>
		
		<div class="row">
			<div class="col-sm-9">
				<!--pnud-->
				<h2 class="row">
					<span class="col-sm-1"><b class="pnud"></b> </span> 
					<span class="col-sm-11">Programa de las Naciones Unidas para el Desarrollo en México (PNUD México)</span></h2>
				
				
				</ul>
				
				<!--inai-->
				<h2 class="row">
					<span class="col-sm-2"><b class="inai"></b> </span> 
					<span class="col-sm-10">Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales (INAI)</span>
				</h2>
				
				
				<!--gesoc-->
				<h2 class="row">
					<span class="col-sm-3"><b class="gesoc"></b> </span> 
					<span class="col-sm-9">Gestión Social y Cooperación (GESOC)</span></h2>
								
				<!--gobierno fácil-->
				<h2 class="row">
					<span class="col-sm-3"><b class="gf"></b> </span> 
					<span class="col-sm-9">Gobierno Fácil</span></h2>
				
				
				<!--prosociedad-->
				<h2>
					<a class="row" href="">
					<span class="col-sm-3"><b class="prosociedad"></b> </span> 
					<span class="col-sm-9">ProSociedad.</span></a></h2>
				

			</div>
			<div class="col-sm-3">
				<h2></h2>
				<a href="{{url('programa-gobierno-abierto')}}" class="icon i_programa">PROGRAMA</a>
				<a href="{{url('programa-gobierno-abierto/alcance')}}" class="icon i_alcance"><span>ALCANCE DEL PROGRAMA</span></a>
				<a href="{{url('convocatoria')}}" class="icon i_convocatoria"><span>CONVOCATORIA</span></a>
			</div>

		</div>
		
		
	</div>
</div>
@endsection