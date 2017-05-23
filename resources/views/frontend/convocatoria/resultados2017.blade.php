@extends('layouts.frontend.master')
@section('title', 'Resultados 2017, Convocatoria Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Resultados de la Convocatoria 2017 del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'convocatoria resultado17')
@section('canonical', url('convocatoria/resultados-2017') )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_convocatoria')

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1><strong>Lista de Candidatos Seleccionados de la Convocatoria 2017</strong> del PROGRAMA DE FORMACIÓN DE <strong>AGENTES LOCALES DE CAMBIO</strong> EN <strong>GOBIERNO ABIERTO</strong> Y DESARROLLO SOSTENIBLE</strong>
		</h1>
		<h2>Candidatos seleccionados</h2>
		
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		<!--Chihuahua-->
		<h2>Chihuahua</h2>
		<ul>
			<li>Denisse Herrera Benavides</li>
			<li>Carlos Martín Castañeda Márquez</li>
			<li>Sergio Eugenio Velasco Medina</li>
			<li>Célida Jazmín Torres Molina</li>
		</ul>
		<!--Morelos-->
		<h2>Morelos</h2>
		<ul>
			<li>Roberto Salinas Ramírez</li>
			<li>Julio Jorge Mendez Alvarez</li>
			<li>Mireya Arteaga Dirzo</li>
			<li>Flor Dessire Leon Hernandez</li>
		</ul>
		<!--Nuevo León-->
		<h2>Nuevo León</h2>
		<ul>
			<li>Aldo Felipe Rodríguez Verduzco</li>
			<li>Alfonso Noé Martinez Alejandre</li>
			<li>Eric Hernández Quintero</li>
			<li>Emmanuel Aguilar Burgoa</li>
		</ul>
		<!--Oaxaca-->
		<h2>Oaxaca</h2>
		<ul>
			<li>Fermín Sosa Pérez</li>
			<li>Carolina Chávez Mendoza</li>
			<li>Nayeli Lucero López Padilla</li>
			<li>Jazmin Aquino Cruz</li>		
		</ul>
		<!--Sonora-->
		<h2>Sonora</h2>
		<ul>
			<li>Jesus Anwar Benitez Acosta</li>		
			<li>Marisol Bárbara Calzada Torres</li>
			<li>Adán Gurrola Ruiz</li>
			<li>Ernesto Urbina Miranda</li>
		</ul>
	</div>
	<div class="row">
				<div class="col-sm-6 col-sm-offset-2">
					<p class="center"><a href="{{url('convocatoria/metodologia-2017')}}" class="btn gde download">Criterios y metodología de selección &gt;&gt;</a></p>
				</div>
				
				
				
			</div>
		</div>
	
</div>
@endsection