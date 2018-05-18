@extends('layouts.frontend.master')
@section('title', "Resultados de $notice->title, Convocatoria Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible")
@section('description', "Resultados de la $notice->title del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible")
@section('body_class', 'convocatoria results')
@section('canonical', url("convocatoria/$notice->slug/resultados") )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_convocatoria')

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1><strong>Lista de Candidatos Seleccionados de la {{$notice->title}}</strong> del PROGRAMA DE FORMACIÓN DE <strong>AGENTES LOCALES DE CAMBIO</strong> EN <strong>GOBIERNO ABIERTO</strong> Y DESARROLLO SOSTENIBLE</strong>
		</h1>
		<h2>Candidatos seleccionados</h2>

	</div>
	<div class="col-sm-8 col-sm-offset-2">

		<ol>
       @foreach($notice->fellows as $fellow)
          <li>
          {{mb_convert_case($fellow->aspirant->name,  MB_CASE_TITLE, 'UTF-8')}} {{mb_convert_case($fellow->aspirant->surname,  MB_CASE_TITLE, 'UTF-8')}} {{mb_convert_case($fellow->aspirant->lastname,  MB_CASE_TITLE, 'UTF-8')}} </li>
       @endforeach
		</ol>
	</div>
	<div class="row">
				<div class="col-sm-6 col-sm-offset-2">
					<p class="center"><a href='{{url("convocatoria/$notice->slug/metodologia")}}' class="btn gde download">Criterios y metodología de selección &gt;&gt;</a></p>
				</div>
			</div>
		</div>

</div>
@endsection
