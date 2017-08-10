@extends('layouts.admin.a_master')
@section('title', 'Respuestas de encuesta de satisfacción de ' . $fellow->user->name . ' ' . $fellow->user->fellowData->surname)
@section('description', 'Respuestas de encuesta de satisfacción de ' . $fellow->user->name . ' ' . $fellow->user->fellowData->surname)
@section('body_class', '')

@section('content')

<div class="row">
	<div class="col-sm-12">
		<h1>Respuestas de encuesta de satisfacción de <strong>{{$fellow->user->name.' '.$fellow->user->fellowData->surname." ".$fellow->user->fellowData->lastname}}</strong></h1>
		<div class="divider top"></div>
	</div>
	<!--info fellow-->
	<div class="col-sm-1 center">
		@if($fellow->user->image)
		<img src='{{url("img/users/{$fellow->user->image->name}")}}' width="100%">
		@else
		<img src='{{url("img/users/default.png")}}' height="40px">
		@endif
	</div>
	<div class="col-sm-5">
		<p>{{$fellow->user->fellowData->city}}, {{$fellow->user->fellowData->state}}</p>
	</div>
	<div class="col-sm-3">
		<p>{{$fellow->user->fellowData->origin}}</p>
	</div>
	<div class="col-sm-3">
		<p>Contestado <a title="{{date('d-m-Y H:i', strtotime($fellow->created_at))}}">{{$fellow->created_at->diffForHumans()}}</a></p>
	</div>
</div>

<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<div class="divider top"></div>
				<ol class="list line">
					<li class="row">
						<span class="col-sm-9">
						<h3>En una escala de 0 a 10, donde cero es nada adecuada y diez es muy adecuada ¿En qué grado consideras que la estructura de la plataforma (sesión de inicio, módulos, foros, etc.) es adecuada para su uso?</h3>
						<p><strong>Respuesta:</strong> {{$fellow->sur_1}}</p>
						<p><strong>Justificación: </strong>{{$fellow->sur_j1}}</p>
						</span>
					</li>
					<li class="row">
						<span class="col-sm-9">
							<h3>En una escala de 0 a 10, donde cero es nada adecuado y diez es muy adecuado ¿En qué grado consideras que el diseño de la plataforma (accesibilidad, navegación en secciones, etc.) es adecuado para su uso?</h3>
							<p><strong>Respuesta:</strong> {{$fellow->sur_2}}</p>
							<p><strong>Justificación: </strong>{{$fellow->sur_j2}}</p>
						</span>
					</li>
					<li class="row">
						<span class="col-sm-9">
							<h3>En una escala de 0 a 10, donde cero es nada adecuada y diez es completamente adecuada ¿En qué grado consideras que la estructura organizativa de las siguientes secciones es adecuada?</h3>
              <span>Login de la Plataforma</span>
							<p><strong>Respuesta:</strong> {{$fellow->sur_3_1}}</p>
              <span>Módulos</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_3_2}}</p>
              <span>Cursos</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_3_3}}</p>
              <span>Sesiones</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_3_4}}</p>
              <span>Evaluaciones</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_3_5}}</p>
						</span>
					</li>
          <li class="row">
						<span class="col-sm-9">
						<h3>En una escala de 0 a 10, donde cero es nada claro y diez es completamente claro ¿Consideras que el lenguaje utilizado en la plataforma es claro?, ¿facilita el uso de la misma?</h3>
						<p><strong>Respuesta:</strong> {{$fellow->sur_4}}</p>
						</span>
					</li>
          <li class="row">
						<span class="col-sm-9">
							<h3>En una escala de 0 a 10, donde cero es muy deficiente y diez es excelente, con respecto a los contenidos multimedia (vídeos y webinars), ¿cómo calificas su calidad en cuanto a los siguientes aspectos?</h3>
              <span>Imagen</span>
							<p><strong>Respuesta:</strong> {{$fellow->sur_5_1}}</p>
              <span>Audio</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_5_2}}</p>
              <span>Duración</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_5_3}}</p>
              <span>Pertinencia del contenido</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_5_4}}</p>
						</span>
					</li>
          <li class="row">
            <span class="col-sm-9">
              <h3>Señala el orden en el que has usado con mayor o menor frecuencia los siguientes recursos, selecciona en un rango de 1 a 3, en donde 1 es el de mayor uso y 3 el de menor uso</h3>
              <span>Lecturas</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_6_1}}</p>
              <span>Videos</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_6_2}}</p>
              <span>Foros</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_6_3}}</p>
            </span>
          </li>
          <li class="row">
            <span class="col-sm-9">
              <h3>Señala el orden en el que has interactuado con mayor o menor frecuencia con los siguientes usuarios en la plataforma, selecciona en un rango de 1 a 3, en donde 1 es el de mayor uso y 3 el de menor uso </h3>
              <span>Otro/a Agente de Cambio</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_7_1}}</p>
              <span>Con facilitador/a</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_7_2}}</p>
              <span>Con soporte técnico</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_7_3}}</p>
            </span>
          </li>
          <li class="row">
            <span class="col-sm-9">
            <h3>¿Has experimentado dificultades técnicas para acceder a alguno de los recursos de la plataforma?</h3>
            <p><strong>Respuesta:</strong> {{$fellow->sur_8 ? 'Sí' : 'No' }}</p>
            <p><strong>Justificación: </strong>{{$fellow->sur_80 == 'Sí' ? $fellow->sur_j8 : 'Ninguno'}}</p>
            </span>
          </li>
          <li class="row">
						<span class="col-sm-9">
						<h3>En una escala de 0 a 10, donde cero es nada de acuerdo y diez es completamente de acuerdo ¿Consideras de utilidad poder visualizar en la plataforma que usuario(s) se encuentran conectados para interactuar?</h3>
						<p><strong>Respuesta:</strong> {{$fellow->sur_9}}</p>
						<p><strong>Justificación: </strong>{{$fellow->sur_j9}}</p>
						</span>
					</li>
          <li class="row">
						<span class="col-sm-9">
						<h3>En una escala de 0 a 10, donde cero es nada de acuerdo y diez es completamente de acuerdo, ¿Consideras que la plataforma, en términos generales, es amigable para el usuario?</h3>
						<p><strong>Respuesta:</strong> {{$fellow->sur_10}}</p>
						<p><strong>Justificación: </strong>{{$fellow->sur_j10}}</p>
						</span>
					</li>
          <li class="row">
						<span class="col-sm-9">
						<h3>En una escala de 0 a 10, donde cero es nada satisfecho y diez es completamente satisfecho ¿Qué tan satisfecho te sientes con la experiencia de uso de la Plataforma?</h3>
						<p><strong>Respuesta:</strong> {{$fellow->sur_11}}</p>
						</span>
					</li>
          <li class="row">
						<span class="col-sm-9">
						<h3>¿Qué mejoras consideras que podrían realizarse a la plataforma?</h3>
						<p><strong>Comentarios: </strong>{{$fellow->sur_j12}}</p>
						</span>
					</li>
				</ol>
				<div class="divider"></div>
		</div>
	</div>
  <div class="row">
		<div class="col-sm-12">
      <h2 class="sa_title">Valoración de cada sesión del Curso 1 “Gobierno Abierto y los ODS”</h2>
      <p>En una escala de 0 a 10, donde 0 es nada  y 10 es mucho, señala en qué grado cada elemento ha contruibuido a tu aprendizaje para la siguientes sesiones</p>
				<ol class="list line">
          <li class="row">
            <span class="col-sm-9">
              <h3>Sesión “Los ejes del Gobierno Abierto, la gobernanza y la atención de la corrupción” </h3>
              <span>Lecturas</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_13_1}}</p>
              <span>Cápsulas de expertos</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_13_2}}</p>
              <span>Facilitador</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_13_3}}</p>
              <span>Contenido en general</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_13_4}}</p>
            </span>
          </li>
          <li class="row">
            <span class="col-sm-9">
              <h3>Sesión “Panorama internacional y el papel de los ODS en el Gobierno Abierto” </h3>
              <span>Lecturas</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_14_1}}</p>
              <span>Cápsulas de expertos</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_14_2}}</p>
              <span>Facilitador</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_14_3}}</p>
              <span>Contenido en general</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_14_4}}</p>
            </span>
          </li>
          <li class="row">
            <span class="col-sm-9">
              <h3>Sesión “ODS en la Agenda Nacional de Gobierno Abierto”</h3>
              <span>Lecturas</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_15_1}}</p>
              <span>Cápsulas de expertos</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_15_2}}</p>
              <span>Facilitador</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_15_3}}</p>
              <span>Contenido en general</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_15_4}}</p>
            </span>
          </li>
          <li class="row">
            <span class="col-sm-9">
              <h3>Sesión “Debates principales en Gobierno Abierto y Objetivo 16 "Paz Justicia e Instituciones Fuertes”</h3>
              <span>Lecturas</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_16_1}}</p>
              <span>Cápsulas de expertos</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_16_2}}</p>
              <span>Facilitador</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_16_3}}</p>
              <span>Contenido en general</span>
              <p><strong>Respuesta:</strong> {{$fellow->sur_16_4}}</p>
            </span>
          </li>
				</ol>
				<div class="divider"></div>
		</div>
	</div>
</div>
@endsection
