@extends('layouts.frontend.master')
@section('title', 'Criterios y metodología de selección 2018')
@section('description', "¿Cómo se seleccionaron los candidatos para la $notice->title del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible?")
@section('body_class', 'convocatoria methodology')
@section('canonical', url("convocatoria/$notice->slug/metodologia") )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_convocatoria')

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>¿Cómo se seleccionaron los candidatos para la {{$notice->title}} del <strong>Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</strong>?</h1>
		<h2>Criterios y metodología de selección</h2>
		<p>El proceso de selección tuvo por objeto elegir 40 integrantes del <strong>Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</strong>, edición {{DateTime::createFromFormat("Y-m-d", $notice->start)->format("Y")}}. Como criterio inicial se buscó seleccionar a 4 candidatos por cada una de las {{$states->count()}} entidades federativas que se incorporaron a esta convocatoria ({{implode(", ", $states->pluck('state')->toArray())}}).</p>

		<p>El proceso de selección se llevó a cabo considerando el total de postulaciones recibidas y con base en los requisitos establecidos en la Convocatoria. El proceso de selección se conformó por las siguientes etapas:</p>
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		<!--Fase 1: Verificación documental-->
		<h2>Fase 1: Verificación documental</h2>
		<p>Como primer paso, el Comité dictaminador verificó que las postulaciones recibidas cumplieran con los requisitos especificados en la convocatoria, que fueron:</p>
		<ul>
			<li>Formato de registro debidamente llenado.</li>
			<li>Copia de comprobante de domicilio reciente que acreditara la residencia del candidato en alguno de los 10 estados que participan en esta Convocatoria
 ({{implode(", ", $states->pluck('state')->toArray())}}).</li>
			<li>Exposición de motivos en la que se manifestaran las razones por las cuales los postulantes estuvieran interesados en participar en el programa de formación de Agentes Locales de Cambio, así como las aportaciones que pudieran brindar a su contexto local como resultado de su participación en este programa (máx. 400 palabras).</li>
			<li>Perfil curricular actualizado, en el que se mostrase la evidencia de su experiencia en el desarrollo de proyectos relacionados con los principios de Gobierno Abierto y Desarrollo Sostenible.</li>
			<li>Video breve – alrededor de 1 minuto– en donde el postulante realizara una presentación y destacara las cualidades que lo distinguieran como un(a) candidato(a) idóneo para participar en el Programa de Formación.</li>
			<li>Aviso de Privacidad por medio del cual se otorgaba el consentimiento relativo al tratamiento de sus datos personales, disponible en <a href="http://apertus.org.mx/">www.apertus.org.mx</a>.</li>
		</ul>
		<p>Al cierre de la convocatoria se recibieron un total de <strong>{{$notice->aspirants->count()}} intenciones de participación</strong>, de las cuales solamente <strong>{{$notice->aspirants_app_already_evaluated()->count()}} completaron la documentación para avanzar a la siguiente fase del proceso</strong>. En primer lugar, se realizó una verificación de la totalidad de comprobantes de domicilio enviados por los aspirantes, para acreditar su residencia en alguna de las diez entidades consideradas en la convocatoria. Producto de esta verificación, se descartaron aspirantes que no entregaron evidencia suficiente para acreditar su residencia.</p>
		<p>La distribución por entidad federativa de los <strong>{{$notice->aspirants_app_already_evaluated()->count()}} aspirantes que entregaron la documentación completa y que cumplieron con el criterio de residencia en el estado</strong> fue la siguiente:</p>
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
		<h2>Fase 2: Evaluación de experiencia previa y perfil del candidato</h2>
		<p>En una segunda etapa, el Comité Dictaminador realizó una evaluación considerando:  la experiencia previa, el perfil y la idoneidad de la candidatura de los {{$notice->aspirants_app_already_evaluated()->count()}}  aspirantes que completaron de forma satisfactoria la etapa de revisión documental. Cada uno de los componentes evaluados en esta fase del proceso fueron: </p>
		<ul>
			<li>Experiencia previa en proyectos de Gobierno Abierto y/o Desarrollo Sostenible (perfil curricular):  <strong>33.3 por ciento</strong>.</li>
			<li>Exposición de motivos: <strong>33.3 por ciento</strong>.												 </li>
			<li>Video de presentación de candidatura: <strong>33.3 por ciento</strong>.										 </li>
		</ul>
		<p>El proceso de distribución de aspirantes para ser evaluados se realizó de forma aleatoria. En cada uno de los elementos arriba mencionados, los integrantes del Comité Dictaminador evaluaron el conocimiento y el uso previo de conceptos relacionados con Gobierno Abierto y Desarrollo Sostenible; la capacidad de expresión oral de los aspirantes; así como la calidad de su exposición de motivos.</p>

		<p>En todos los casos, cada uno de los {{$notice->aspirants_app_already_evaluated()->count()}} postulantes fue evaluado, de forma separada y ciega, por representantes de tres de las organizaciones que integran el Comité Dictaminador (El Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales (<strong>INAI</strong>), la Oficina para México del Programa de Naciones Unidas para el Desarrollo (<strong>PNUD-México</strong>), <strong>GESOC</strong>, Agencia para el Desarrollo, A.C., <strong>ProSociedad</strong> Hacer Bien el Bien, A.C., y <strong>Gobierno Fácil</strong>.</p>

		<p>Cada una de las tres organizaciones evaluó, en una escala de cero a diez, cada uno de los insumos proporcionados por los aspirantes; y la calificación final resultó de promediar las tres notas generadas por cada institución. Con base en estos criterios, las calificaciones obtenidas por los {{$notice->aspirants_app_already_evaluated()->count()}} candidatos que avanzaron a esta fase del proceso fueron las siguientes:</p>
		
		<p class="note">Solo se incluyen los folios de las personas que pasaron el filtro de la etapa documental.</p>
		
		<table id="tabla2" class="table">
  <thead>
    <tr>
      <th>Folio Interno</th>
      <th>Entidad Federativa</th>
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
		<p>Una vez concluida la evaluación documental, el Comité Dictaminador se reunió el día <strong>20 de abril</strong> para seleccionar a los aspirantes que pasarían a la fase final de entrevistas de la convocatoria. En este caso, la selección se realizó empleando criterios de mérito, equilibrio entre entidades federativas e igualdad de género. Derivado de este proceso fueron seleccionados <strong>{{ $notice->aspirants_interviews()->count()}} aspirantes para avanzar a la etapa de entrevistas</strong>. Se eligieron 48 mujeres y 48 hombres.</p>
		<table id="tabla3" class="table">
  <thead>
    <tr>
      <th>Folio interno</th>
      <th>Entidad Federativa</th>
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
		<p>El Comité Dictaminador informó a los {{ $notice->aspirants_interviews()->count()}} aspirantes preseleccionados sobre la fecha y la hora en la que se realizaría la entrevista final para participar en el Programa de Formación de Agentes Locales. Cada entrevista tuvo una duración aproximada de 20 minutos, en donde se preguntó a cada candidato sobre temas clave de la agenda de gobierno abierto y desarrollo sostenible en lo local en México. Las entrevistas se realizaron entre el 23 de abril y el 11 mayo de forma remota, principalmente vía telefónica. Las preguntas que se emplearon como guía para todas las entrevistas fueron las siguientes:</p>
		<h3>Preguntas sustantivas:</h3>
		<ol>
			<li>¿Cómo visualizas al gobierno abierto como una palanca para el desarrollo sostenible?</li>
			<li>¿Has desarrollado algún proyecto de manera colaborativa anteriormente? Si es así, cuéntanos tu experiencia y con qué actores participaste. Si no es así, ¿cómo articularías un proceso de este tipo?</li>
			<li>¿Qué atributos consideras que te hacen un agente local de cambio?</li>
			<li>¿Cuáles son los principales retos de tu estado? ¿Cómo se vinculan a los ODS?</li>
	</ol>

		<h3>Preguntas Extra:</h3>
		<ol>
			<li>¿Cuál es tu disponibilidad de tiempo para realizar las actividades contempladas en el programa (actividades en línea y seminarios presenciales)?</li>
		</ol>
		<p>Las entrevistas se distribuyeron entre las cinco organizaciones que forman parte del Comité Dictaminador. Cada entrevista fue evaluada por dos organizaciones, y la calificación final de la misma, resultó de promediar las dos notas generadas por cada institución. Cabe mencionar que la distribución de entrevistas se determinó de manera que ningún evaluador tuviera conocimiento de la etapa previa, es decir que no conocía ni el perfil ni la motivación del postulante.</p>

		<table class="table">
			<thead>
				<tr>
					<th>Folio interno			</th>
					<th>Entidad Federativa</th>
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


		<p>Posteriormente, el Comité Dictaminador se reunió en las instalaciones del INAI el 15 de mayo del presente, para determinar la selección final de los 40 candidatos -cuatro aspirantes por entidad federativa- para participar en el Programa de Formación. Para la selección final, se emplearon los siguientes criterios:</p>
		
		<ol>
			<li>Con base en el mérito se seleccionaron a 4 aspirantes de cada entidad federativa que obtuvieron la mayor calificación en el promedio final, sin importar su sexo o su sector de procedencia. </li>
			<li>Posterior a la primera selección, se buscó el equilibrio por género y por sector de procedencia.  Es decir, en aquellos estados donde no había paridad, se buscó equilibrio de género; y en aquellos estados donde no había presencia del sector gubernamental, se equilibró incluyendo un aspirante de gobierno para asegurar que todos los sectores fueran representados en función de la pluralidad de actores del estado.</li>
		</ol>
		
		<p>El proceso anterior, permitió que, en la selección final de los 40 participantes, se asegurara el equilibrio de género y sector de procedencia, es decir:</p>
		<ol>
			<li>Todos los estados tienen al menos dos mujeres entre los candidatos seleccionados.</li>
			<li>En todos los estados se cuenta al menos con un candidato del sector gubernamental.<a href="#nota"><sup>1</sup></a></li>
		</ol>
		<p>Los 40 candidatos que fueron seleccionados para formar parte del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible, edición 2018 se enlistan a continuación:</p>
		<table class="table">
			<thead>
				<tr>
					<th>Entidad Federativa</th>
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
			<p><sup>1</sup>  El estado de Tabasco fue la excepción dado el perfil de los aspirantes que pasaron a entrevistas. Ninguno de ellos pertenece al sector gubernamental.</p>
		</div>
	</div>
</div>
@endsection
