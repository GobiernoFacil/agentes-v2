
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
    .page_break { page-break-before: always; }
    </style>
  </head>
  <body class ="">
    <section>
      <!--content-->
  		<div class="container">
        <div class="box">
        <div class="row">
        	<div class="col-sm-12">
        		<h1>Resultados de encuestas de <strong>satisfacción</strong></h1>
            <h2>{{date('d-m-Y')}}</h2>
        		<div class="divider top"></div>
        	</div>
        </div>
        <div class="page_break"></div>
        <div class="box">
        	<div class="row">
        		<div class="col-sm-12">
        			<div class="divider top"></div>
              <ol class="list line">
                <li class="row">
                  <div class="col-sm-9">
                    <h3>¿En qué grado consideras que la estructura de la plataforma (sesión de inicio, módulos, foros, etc.) es adecuada para su uso?</h3>
                    <small><strong>Respuestas: {{$all->count()}}</strong></small>
                  </div>
                  <img src='{{base_path()."/csv/survey_images_fellow/su_sur_1.jpg"}}' width="100%">
                  <h2>Comentarios</h2>
                    <small>Total: {{$all->count()}}</small>
                    @foreach($all as $data)
                      <p>{{$data->sur_j1}}</p>
                    @endforeach
                </li>
                <div class="page_break"></div>
                <li class="row">
                  <div class="col-sm-9">
                    <h3>¿En qué grado consideras que el diseño de la plataforma (accesibilidad, navegación en secciones, etc.) es adecuado para su uso?</h3>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_2.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <h2>Comentarios</h2>
                    <small>Total: {{$all->count()}}</small>
                    @foreach($all as $data)
                      <p>{{$data->sur_j2}}</p>
                    @endforeach
                  </div>
                </li>
                <div class="page_break"></div>
                <li class="row">
                  <div class="col-sm-9">
                    <h3>¿En qué grado consideras que la estructura organizativa de las siguientes secciones es adecuada?</h3>
                    <small><strong>Respuestas: {{$all->count()}}</strong></small>
                    <div>Login de la Plataforma</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_3_1.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Módulos</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_3_2.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Cursos</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_3_3.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Sesiones</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_3_4.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Evaluaciones</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_3_5.jpg"}}' width="100%">
                  </div>
                </li>
                <div class="page_break"></div>
                <li class="row">
                  <div class="col-sm-9">
                    <h3>¿Consideras que el lenguaje utilizado en la plataforma es claro?, ¿facilita el uso de la misma?</h3>
                    <small><strong>Respuestas: {{$all->count()}}</strong></small>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_4.jpg"}}' width="100%">
                  </div>
                </li>
                <div class="page_break"></div>
                <li class="row">
                  <div class="col-sm-9">
                    <h3>Con respecto a los contenidos multimedia (vídeos y webinars), ¿cómo calificas su calidad en cuanto a los siguientes aspectos? </h3>
                    <small><strong>Respuestas: {{$all->count()}}</strong></small>
                    <div>Imagen</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_5_1.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Audio</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_5_2.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Duración</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_5_3.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Pertinencia del contenido</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_5_4.jpg"}}' width="100%">
                    <div class="page_break"></div>
                  </div>
                </li>
                <div class="page_break"></div>
                <li class="row">
                  <div class="col-sm-9">
                    <h3>Señala el orden en el que has usado con mayor o menor frecuencia los siguientes recursos</h3>
                    <small><strong>Respuestas: {{$all->count()}}</strong></small>
                    <div>Lecturas</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_6_1.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Videos</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_6_2.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Foros</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_6_3.jpg"}}' width="100%">
                  </div>
                </li>
                <div class="page_break"></div>
                <li class="row">
                  <div class="col-sm-9">
                    <h3>Señala el orden en el que has interactuado con mayor o menor frecuencia con los siguientes usuarios en la plataforma</h3>
                    <small><strong>Respuestas: {{$all->count()}}</strong></small>
                    <div>Imagen</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_7_1.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Audio</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_7_2.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Duración</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_7_3.jpg"}}' width="100%">
                  </div>
                </li>
                <div class="page_break"></div>
                <li class="row">
                  <div class="col-sm-9">
                    <h3>¿Has experimentado dificultades técnicas para acceder a alguno de los recursos de la plataforma?</h3>
                    <small><strong>Respuestas: {{$all->count()}}</strong></small>
                  </div>
                  <img src='{{base_path()."/csv/survey_images_fellow/su_sur_8.jpg"}}' width="100%">
                  <div class="page_break"></div>
                  <h2>Comentarios</h2>
                    <small>Total: {{$all->count()}}</small>
                    @foreach($all as $data)
                      <p>{{$data->sur_j8}}</p>
                    @endforeach
                </li>
                <div class="page_break"></div>
                <li class="row">
                  <div class="col-sm-9">
                    <h3>¿Consideras de utilidad poder visualizar en la plataforma que usuario(s) se encuentran conectados para interactuar?</h3>
                    <small><strong>Respuestas: {{$all->count()}}</strong></small>
                  </div>
                  <img src='{{base_path()."/csv/survey_images_fellow/su_sur_9.jpg"}}' width="100%">
                  <div class="page_break"></div>
                  <h2>Comentarios</h2>
                    <small>Total: {{$all->count()}}</small>
                    @foreach($all as $data)
                      <p>{{$data->sur_j9}}</p>
                    @endforeach
                </li>
                <div class="page_break"></div>
                <li class="row">
                  <div class="col-sm-9">
                    <h3>¿Consideras que la plataforma, en términos generales, es amigable para el usuario?</h3>
                    <small><strong>Respuestas: {{$all->count()}}</strong></small>
                  </div>
                  <img src='{{base_path()."/csv/survey_images_fellow/su_sur_10.jpg"}}' width="100%">
                  <div class="page_break"></div>
                  <h2>Comentarios</h2>
                    <small>Total: {{$all->count()}}</small>
                    @foreach($all as $data)
                      <p>{{$data->sur_j10}}</p>
                    @endforeach
                </li>
                <div class="page_break"></div>
                <li class="row">
                  <div class="col-sm-9">
                    <h3>¿Qué tan satisfecho te sientes con la experiencia de uso de la Plataforma?</h3>
                    <small><strong>Respuestas: {{$all->count()}}</strong></small>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_11.jpg"}}' width="100%">
                  </div>
                </li>
                <div class="page_break"></div>
                <li class="row">
                  <div class="col-sm-9">
                    <h3>¿Qué mejoras consideras que podrían realizarse a la plataforma?</h3>
                    <small>Comentarios: {{$all->count()}}</small>
                    @foreach($all as $data)
                    <p>{{$data->sur_j12}}</p>
                    @endforeach
                  </div>
                </li>
                <div class="page_break"></div>
              </ol>
              <div class="divider"></div>
              <h2 class="sa_title">Valoración de cada sesión del Curso 1 “Gobierno Abierto y los ODS”</h2>
              <p>En una escala de 0 a 10, donde 0 es nada  y 10 es mucho, señala en qué grado cada elemento ha contruibuido a tu aprendizaje para la siguientes sesiones</p>
              <ol>
                <li class="row">
                  <div class="col-sm-9">
                    <h3>Sesión “Los ejes del Gobierno Abierto, la gobernanza y la atención de la corrupción”</h3>
                    <small><strong>Respuestas: {{$all->count()}}</strong></small>
                    <div>Lecturas</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_13_1.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Cápsulas de expertos</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_13_2.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Facilitador</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_13_3.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Contenido en general</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_13_4.jpg"}}' width="100%">
                  </div>
                </li>
                <div class="page_break"></div>
                <li class="row">
                  <div class="col-sm-9">
                    <h3>Sesión “Panorama internacional y el papel de los ODS en el Gobierno Abierto”</h3>
                    <small><strong>Respuestas: {{$all->count()}}</strong></small>
                    <div>Lecturas</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_14_1.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Cápsulas de expertos</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_14_2.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Facilitador</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_14_3.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Contenido en general</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_14_4.jpg"}}' width="100%">
                  </div>
                </li>
                <div class="page_break"></div>
                <li class="row">
                  <div class="col-sm-9">
                    <h3>Sesión “ODS en la Agenda Nacional de Gobierno Abierto”</h3>
                    <small><strong>Respuestas: {{$all->count()}}</strong></small>
                    <div>Lecturas</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_15_1.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Cápsulas de expertos</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_15_2.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Facilitador</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_15_3.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Contenido en general</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_15_4.jpg"}}' width="100%">
                  </div>
                </li>
                <div class="page_break"></div>
                <li class="row">
                  <div class="col-sm-9">
                    <h3>Sesión “Debates principales en Gobierno Abierto y Objetivo 16 "Paz Justicia e Instituciones Fuertes”</h3>
                    <small><strong>Respuestas: {{$all->count()}}</strong></small>
                    <div>Lecturas</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_16_1.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Cápsulas de expertos</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_16_2.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Facilitador</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_16_3.jpg"}}' width="100%">
                    <div class="page_break"></div>
                    <div>Contenido en general</div>
                    <img src='{{base_path()."/csv/survey_images_fellow/su_sur_16_4.jpg"}}' width="100%">
                  </div>
                </li>
                </ol>
        				<div class="divider"></div>
        		</div>
          </div>
        	</div>
        </div>
      </div>
  </section>
  </body>
</html>
