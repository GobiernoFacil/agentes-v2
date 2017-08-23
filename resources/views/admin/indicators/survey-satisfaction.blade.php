@extends('layouts.admin.a_master')
@section('title', 'Resultados de encuestas de satisfacción')
@section('description', 'Resultados de encuesta de satisfacción')
@section('body_class', '')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Resultados de encuesta de <strong>satisfacción</strong></h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<div class="divider top"></div>
			<ol class="list line">
				<li class="row">
					<span class="col-sm-9">
						<h3>¿En qué grado consideras que la estructura de la plataforma (sesión de inicio, módulos, foros, etc.) es adecuada para su uso?</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
					</span>
					<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_1"></svg>
					<h2>Comentarios</h2>
						<small>Total: {{$all->count()}}</small>
						@foreach($all as $data)
							<p>{{$data->sur_j1}}</p>
						@endforeach
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>¿En qué grado consideras que el diseño de la plataforma (accesibilidad, navegación en secciones, etc.) es adecuado para su uso?</h3>
						<svg width="1000" height="500"style ="padding-left:40px; padding-top:20px"  id ="sur_2"></svg>
						<h2>Comentarios</h2>
						<small>Total: {{$all->count()}}</small>
						@foreach($all as $data)
							<p>{{$data->sur_j2}}</p>
						@endforeach
					</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>¿En qué grado consideras que la estructura organizativa de las siguientes secciones es adecuada?</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
						<span>Login de la Plataforma</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_3_1"></svg>
						<span>Módulos</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_3_2"></svg>
						<span>Cursos</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_3_3"></svg>
						<span>Sesiones</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_3_4"></svg>
						<span>Evaluaciones</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_3_5"></svg>
					</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>¿Consideras que el lenguaje utilizado en la plataforma es claro?, ¿facilita el uso de la misma?</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px"  id ="sur_4"></svg>
					</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>Con respecto a los contenidos multimedia (vídeos y webinars), ¿cómo calificas su calidad en cuanto a los siguientes aspectos? </h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
						<span>Imagen</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_5_1"></svg>
						<span>Audio</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_5_2"></svg>
						<span>Duración</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_5_3"></svg>
						<span>Pertinencia del contenido</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_5_4"></svg>
					</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>Señala el orden en el que has usado con mayor o menor frecuencia los siguientes recursos</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
						<span>Lecturas</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_6_1"></svg>
						<span>Videos</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_6_2"></svg>
						<span>Foros</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_6_3"></svg>
					</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>Señala el orden en el que has interactuado con mayor o menor frecuencia con los siguientes usuarios en la plataforma</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
						<span>Imagen</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_7_1"></svg>
						<span>Audio</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_7_2"></svg>
						<span>Duración</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_7_3"></svg>
					</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>¿Has experimentado dificultades técnicas para acceder a alguno de los recursos de la plataforma?</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
					</span>
					<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_8"></svg>
					<h2>Comentarios</h2>
						<small>Total: {{$all->count()}}</small>
						@foreach($all as $data)
							<p>{{$data->sur_j8}}</p>
						@endforeach
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>¿Consideras de utilidad poder visualizar en la plataforma que usuario(s) se encuentran conectados para interactuar?</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
					</span>
					<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_9"></svg>
					<h2>Comentarios</h2>
						<small>Total: {{$all->count()}}</small>
						@foreach($all as $data)
							<p>{{$data->sur_j9}}</p>
						@endforeach
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>¿Consideras que la plataforma, en términos generales, es amigable para el usuario?</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
					</span>
					<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_10"></svg>
					<h2>Comentarios</h2>
						<small>Total: {{$all->count()}}</small>
						@foreach($all as $data)
							<p>{{$data->sur_j10}}</p>
						@endforeach
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>¿Qué tan satisfecho te sientes con la experiencia de uso de la Plataforma?</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px"  id ="sur_11"></svg>
					</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>¿Qué mejoras consideras que podrían realizarse a la plataforma?</h3>
						<small>Comentarios: {{$all->count()}}</small>
						@foreach($all as $data)
						<p>{{$data->sur_j12}}</p>
						@endforeach
					</span>
				</li>
			</ol>
			<div class="divider"></div>
			<h2 class="sa_title">Valoración de cada sesión del Curso 1 “Gobierno Abierto y los ODS”</h2>
			<p>En una escala de 0 a 10, donde 0 es nada  y 10 es mucho, señala en qué grado cada elemento ha contruibuido a tu aprendizaje para la siguientes sesiones</p>
			<ol>
				<li class="row">
					<span class="col-sm-9">
						<h3>Sesión “Los ejes del Gobierno Abierto, la gobernanza y la atención de la corrupción”</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
						<span>Lecturas</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_13_1"></svg>
						<span>Cápsulas de expertos</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_13_2"></svg>
						<span>Facilitador</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_13_3"></svg>
						<span>Contenido en general</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_13_4"></svg>
					</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>Sesión “Panorama internacional y el papel de los ODS en el Gobierno Abierto”</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
						<span>Lecturas</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_14_1"></svg>
						<span>Cápsulas de expertos</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_14_2"></svg>
						<span>Facilitador</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_14_3"></svg>
						<span>Contenido en general</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_14_4"></svg>
					</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>Sesión “ODS en la Agenda Nacional de Gobierno Abierto”</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
						<span>Lecturas</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_15_1"></svg>
						<span>Cápsulas de expertos</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_15_2"></svg>
						<span>Facilitador</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_15_3"></svg>
						<span>Contenido en general</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_15_4"></svg>
					</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>Sesión “Debates principales en Gobierno Abierto y Objetivo 16 "Paz Justicia e Instituciones Fuertes”</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
						<span>Lecturas</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_16_1"></svg>
						<span>Cápsulas de expertos</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_16_2"></svg>
						<span>Facilitador</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_16_3"></svg>
						<span>Contenido en general</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_16_4"></svg>
					</span>
				</li>
		    </ol>
		</div>
	</div>
</div>
@endsection