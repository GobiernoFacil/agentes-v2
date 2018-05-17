@extends('layouts.frontend.master')
@section('title', 'Criterios y metodología de selección')
@section('description', "¿Cómo se seleccionaron los candidatos para la $notice->title del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible?")
@section('body_class', 'convocatoria methodology')
@section('canonical', url("convocatoria/$notice->slug/metodologia") )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_convocatoria')

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>¿Cómo se seleccionaron los candidatos para la {{$notice->title}} del <strong>Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</strong>?</h1>
		<h2>Criterios y metodología de selección  <a href="#nota"><sup>1</sup></a></h2>
		<p>El proceso de selección tuvo por objeto elegir 40 integrantes del <strong>Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</strong>, edición {{DateTime::createFromFormat("Y-m-d", $notice->start)->format("Y")}}. Como criterio inicial se buscó seleccionar a 4 candidatos por cada una de las {{$states->count()}} entidades federativas que se incorporaron a esta convocatoria ({{implode(", ", $states->pluck('state')->toArray())}}).</p>

		<p>El proceso de selección se llevó a cabo con base en el total de postulaciones recibidas, así como en los requisitos establecidos en la convocatoria. El proceso de selección se conformó por las siguientes etapas:</p>
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		<!--Fase 1: Verificación documental-->
		<h2>Fase 1: Verificación documental</h2>
		<p>Como primer paso, el Comité dictaminador verificó que las postulaciones recibidas cumplieran con los requisitos especificados en la convocatoria, que fueron:</p>
		<ul>
			<li>Formato de registro debidamente llenado.</li>
			<li>Documento que acredite la residencia del postulante en las entidades federativas objetivo ({{implode(", ", $states->pluck('state')->toArray())}}).</li>
			<li>Currículum vitae y/o publicaciones, investigaciones o documentos que muestren conocimiento previo y experiencia del aspirante en temas relacionados con Gobierno Abierto o Desarrollo Sostenible.</li>
			<li>Ensayo en el que cada aspirante manifieste las razones por las cuales está interesado en participar en el Programa, así como las aportaciones que pueden brindar a su contexto local como resultado de su participación en este programa. </li>
			<li>Video breve en donde el postulante presente una idea para desarrollar un proyecto en su entidad federativa en el que, a través del uso de herramientas de gobierno abierto, se pueda atender exitosamente un reto local de desarrollo sostenible.</li>
		</ul>
		<p>Al cierre de la convocatoria se recibieron un total de {{$notice->aspirants->count()}} intenciones de participación, de las cuales solamente {{$notice->aspirants_app_already_evaluated()->count()}} contaron con la documentación completa para avanzar en la siguiente fase del proceso. La distribución por entidad federativa de los aspirantes que entregaron su documentación completa fue la siguiente:</p>
		<table class="table">
			<thead>
				<tr>
					<th>Entidad Federativa</th>
					<th>Aspirantes</th>
				</tr>
			</thead>
			<tbody>
        <?php $count = 0;?>
        @foreach($states as $state)
          <tr>
  					<td>{{$state->state}}</td>
						@if($state->state==='Estado de México')
							<td>{{$notice->aspirants_approved_proof_by_state('México')->count()}}</td>
							<?php $count = $notice->aspirants_approved_proof_by_state('México')->count()+$count;?>
						@else
  						<td>{{$notice->aspirants_approved_proof_by_state($state->state)->count()}}</td>
							<?php $count = $notice->aspirants_approved_proof_by_state($state->state)->count()+$count;?>
						@endif
  				</tr>
        @endforeach
				<tr>
					<td><strong>Total</strong></td>
					<td><strong>{{$count}}</strong>	 </td>
				</tr>
			</tbody>
		</table>

		<!-- fase 2-->
		<h2>Fase 2: Evaluación de experiencia previa y de propuesta de proyecto</h2>
		<p>En una segunda etapa, el Comité Dictaminador evaluó la experiencia de los candidatos preseleccionados en proyectos/actividades relacionados con temas de gobierno abierto y/o desarrollo sostenible, así como las propuestas de proyecto presentadas en el ensayo y el video. Cada uno de los componentes evaluados en esta fase del proceso se ponderó de la siguiente manera:</p>
		<ul>
			<li>Experiencia previa en proyectos de GA y/o DS (revisión de CV): <strong>30 por ciento</strong>.</li>
			<li>Ensayo escrito: <strong>35 por ciento</strong>.												 </li>
			<li>Video de presentación: <strong>35 por ciento</strong>.										 </li>
		</ul>
		<p>Con base en estos criterios, las calificaciones obtenidas por los {{$notice->aspirants_app_already_evaluated()->count()}} candidatos que avanzaron a esta fase del proceso fueron las siguientes:</p>
		<table id="tabla2" class="table">
  <thead>
    <tr>
      <th>Folio Interno</th>
      <th>Estado</th>
      <th>CV (33.3%)</th>
      <th>Ensayo (33.3%)</th>
      <th>Video (33.3%)</th>
      <th>Total (100%)</th>
    </tr>
  </thead>
  <tbody>
		@foreach($notice->aspirants_app_already_evaluated_front()->orderBy('state','asc')->get() as $aspirant)
			<tr>
				<td>{{$aspirant->id}}</td>
				<td>{{ strpos( $aspirant->state,"xico")  ? "Estado de México" :   $aspirant->state  }}<br>
				<td>{{number_format($aspirant->AspirantEvaluation()->whereNotNull('experienceGrade')->sum('experienceGrade')/3,2)}}</td>
				<td>{{number_format($aspirant->AspirantEvaluation()->whereNotNull('essayGrade')->sum('essayGrade')/3,2)}}</td>
				<td>{{number_format($aspirant->AspirantEvaluation()->whereNotNull('videoGrade')->sum('videoGrade')/3,2)}}</td>
				<td>{{number_format($aspirant->global_grade->grade,2)}}</td>
			</tr>

		@endforeach

	</tbody>
</table>
		<p>Una vez obtenidas estas calificaciones, se seleccionó a los 6 aspirantes de cada entidad federativa que obtuvieron las mayores calificaciones para avanzar a la última fase del proceso de selección. Los folios y calificaciones los aspirantes seleccionados por entidad federativa fueron las siguientes:</p>
		<table id="tabla3" class="table">
  <thead>
    <tr>
      <th>Folio interno</th>
      <th>Estado</th>
      <th>Calificación</th>
    </tr>
  </thead>
  <tbody>
		@foreach($notice->aspirants_interviews()->orderBy('state','asc')->get() as $aspirant)
			<tr><td>{{$aspirant->id}}</td>
				<td>{{ strpos( $aspirant->state,"xico")  ? "Estado de México" :   $aspirant->state  }}<br>
				<td>{{number_format($aspirant->global_grade->grade,2)}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
		<!--- fase 3-->
		<h2>Fase 3: Entrevistas</h2>
		<p>El Comité Dictaminador informó el 15 de mayo pasado a los 30 aspirantes preseleccionados sobre la fecha y la hora en la que se realizará la entrevista final para participar en el Programa de Formación de Agentes Locales. Cada entrevista tuvo una duración aproximada de 30 minutos, en donde se cuestionó a cada candidato sobre temas clave de la agenda de gobierno abierto y desarrollo sostenible en lo local en México. Todas las entrevistas se realizaron entre el 17 y el 18 de mayo de forma remota, ya fuera a través de la plataforma Skype o por vía telefónica. Las preguntas que se emplearon como guía para todas las entrevistas fueron las siguientes:</p>
		<h3>Preguntas sustantivas:</h3>
		<ol>
			<li>¿Cómo visualizas al gobierno abierto como una palanca para el desarrollo sustentable?</li>
			<li>¿Has desarrollado algún proyecto de manera colaborativa anteriormente? Si es así cuéntanos tu experiencia y qué actores han participado. Si no ¿cómo lo harías?</li>
			<li>¿Qué atributos consideras que te hacen un agente local de cambio? (liderazgo, incidencia, movilización, etc.)</li>
			<li>¿Cuáles son los principales retos de tu estado? ¿Cómo se vinculan a los ODS?</li>
	</ol>

		<h3>Preguntas Extra:</h3>
		<ol>
			<li>¿Cuál es tu disponibilidad de tiempo para realizar las actividades contempladas en el programa?</li>
		</ol>
		<p>Las entrevistas se distribuyeron por cada una de las organizaciones que forman parte del Grupo de Trabajo del proyecto. Así, <strong>INAI</strong> entrevistó a los candidatos de Nuevo León, <strong>PNUD</strong> a los de Sonora, <strong>Gesoc</strong> a los de Chihuahua, <strong>ProSociedad</strong> a los de Oaxaca y, finalmente, <strong>Gobierno Fácil</strong> a los de Morelos. Las calificaciones obtenidas por los aspirantes en esta fase de entrevistas fueron las siguientes:</p>

		<table class="table">
			<thead>
				<tr>
					<th>Folio interno			</th>
					<th>Estado					</th>
					<th>Calificación experiencia</th>
					<th>Calificación entrevistas</th>
				</tr>
			</thead>
			<tbody>
				@foreach($notice->aspirants_interviews()->orderBy('state','asc')->get() as $aspirant)
					<tr><td>{{$aspirant->id}}</td>
						<td>{{ strpos( $aspirant->state,"xico")  ? "Estado de México" :   $aspirant->state  }}<br>
							<td>{{number_format($aspirant->global_grade->grade,2)}}</td>
							<td>{{number_format($aspirant->global_interview_grade->score,2)}}</td>
						</tr>
				@endforeach
			</tbody>
		</table>


		<p>Los cuatro aspirantes que obtuvieron las mayores calificaciones en la fase de entrevista por entidad federativa fueron los que resultaron seleccionados al Programa de Formación. El listado de aspirantes seleccionados es el siguiente:</p>

		<table class="table">
			<thead>
				<tr>
					<th>Estado</th>
					<th>Nombre</th>
				</tr>
			</thead>
			<tbody>
        @foreach($notice->selected_aspirant_order_by_state()->get() as $aspirant)
          <tr>
            <td>{{ strpos( $aspirant->state,"xico")  ? "Estado de México" :   $aspirant->state  }}<br>
            </td>
            <td>{{mb_convert_case($aspirant->name,  MB_CASE_TITLE, 'UTF-8')}} {{mb_convert_case($aspirant->surname,  MB_CASE_TITLE, 'UTF-8')}} {{mb_convert_case($aspirant->lastname,  MB_CASE_TITLE, 'UTF-8')}}
	         </tr>
        @endforeach
			</tbody>
		</table>
	</div>
	<div class="col-sm-12">
		<div class="divider"></div>
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		<a id="nota"></a>
		<div class="notes">
			<p><sup>1</sup>  <strong>Nota</strong>: Dos candidatos declinaron su participación en el Programa por motivos personales, y a un candidato no se le formalizó su candidatura al no cumplir con los requisitos establecidos en la convocatoria y la documentación solicitada en el marco del proyecto. Por lo tanto, los tres candidatos que los sustituyeron fueron seleccionados de acuerdo al criterio establecido en la Base 4 de la Convocatoria “<em>…En caso de que un participante decida abandonar el programa, dicho espacio será ocupado por el aspirante rechazado con la calificación más alta en el proceso de selección</em>”.</p>
		</div>
	</div>
</div>
@endsection
