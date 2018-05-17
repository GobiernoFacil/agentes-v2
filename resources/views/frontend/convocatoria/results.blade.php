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
		<h2>Candidatos seleccionados <a href="#nota"><sup>1</sup></a></h2>

	</div>
	<div class="col-sm-8 col-sm-offset-2">

		<ul>
       @foreach($notice->fellows as $fellow)
          <li>{{str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($fellow->aspirant->name)))).' '.str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($fellow->aspirant->surname)))).' '.str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($fellow->aspirant->lastname))))}}</li>
       @endforeach
		</ul>
	</div>
	<div class="row">
				<div class="col-sm-6 col-sm-offset-2">
					<p class="center"><a href='{{url("convocatoria/$notice->slug/metodologia")}}' class="btn gde download">Criterios y metodología de selección &gt;&gt;</a></p>
				</div>
        <?php /*
				<div class="col-sm-8 col-sm-offset-2">
				<a id="nota"></a>
				<div class="notes">
					<p><sup>1</sup>  <strong>Nota</strong>: Dos candidatos declinaron su participación en el Programa por motivos personales, y a un candidato no se le formalizó su candidatura al no cumplir con los requisitos establecidos en la convocatoria y la documentación solicitada en el marco del proyecto. Por lo tanto, los tres candidatos que los sustituyeron fueron seleccionados de acuerdo al criterio establecido en la Base 4 de la Convocatoria “<em>…En caso de que un participante decida abandonar el programa, dicho espacio será ocupado por el aspirante rechazado con la calificación más alta en el proceso de selección</em>”.</p>
				</div>
				</div>

        */
        ?>

			</div>
		</div>

</div>
@endsection
