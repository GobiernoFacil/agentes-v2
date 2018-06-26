@extends('layouts.admin.a_master')
@section('title', 'Información acerca del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Información acerca del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'info')
@section('css-custom')
<link rel="stylesheet" href="{{url('css/logos.css')}}">
<link rel="stylesheet" href="{{url('css/jquerytour.css')}}">
@endsection
@section('content')
		<!-- title -->
		<div class="row">
			<div class="col-sm-12">
				<h1 class="center">Programa de Formación de <strong>Agentes Locales de Cambio</strong> en <strong>Gobierno Abierto</strong> y <strong>Desarrollo Sostenible</strong>.</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="allies">
				<h2>Impartido por:</h2>
				<div class="row">
					<a href="https://www.usaid.gov/mexico" class="usaid">USAID</a>
					<a href="http://www.mx.undp.org/" class="pnud">PNUD</a>
					<a href="http://inicio.ifai.org.mx/SitePages/ifai.aspx" class="inai">INAI</a>
					<a href="http://www.gesoc.org.mx/site/" class="gesoc">GESOC</a>
					<a href="https://gobiernofacil.com/" class="gf">Gobierno Fácil</a>
					<a href="http://www.prosociedad.org/" class="prosociedad">Prosociedad</a>
				</div>
				</div>
			</div>
		</div>

		<ul class="row sub_nav_program">
			<li class="col-sm-3">
				<a href="#" class="current tour_8" id="about_box_btn">Acerca del programa</a>
			</li>
			<li class="col-sm-3">
				<a href="#" class="tour_9" id="content_box_btn">Contenido</a>
			</li>
			<li class="col-sm-3">
				<a href="#" class="tour_10" id="how_box_btn">Reglamento</a>
			</li>
			<li class="col-sm-3">
			@if($activity)
				@if($user->new_diagnostic($activity->diagnosticInfo->id)->count() == 0)
						<a href='{{url("tablero/{$activity->session->module->program->slug}/aprendizaje/{$activity->session->module->slug}/{$activity->session->slug}/{$activity->slug}")}}' class="btn view tour_11">Comenzar Programa</a>
	       @else
						<a href="{{url('tablero')}}" class="btn view tour_11">Comenzar Programa</a>
				@endif
			@else
						<a href="{{url('tablero')}}" class="btn view tour_11">Comenzar Programa</a>
			@endif
			</li>
		</ul>
	</div><!-- cierra  container del master layout -->
</section><!-- cierra section del master layout -->
<section class="gray">
	<div class="container">
		<!-- about box -->
		<div class="about_box">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="center">Acerca del programa</h2>
					<p class="ap_textareacontent">{{$program->description}}</p>
					<p>El programa tiene como propósitos el fortalecimiento de capacidades, la vinculación y empoderamiento de una red de Agentes Locales que promuevan la consolidación de acciones orientadas a fortalecer prácticas de transparencia y participación ciudadana a nivel local en México.</p>
					<p>Al concluir la etapa formativa, se esperaría que los egresados se integren y participen activamente en los trabajos que se realizan en su entidad federativa en el marco de los ejercicios locales de Gobierno Abierto promovidos por el INAI.</p>
				</div>
				<div class="col-sm-10 col-sm-offset-1">
					<div class="box">
						<ul class="list_line">
							<li class="row">
								<span class="col-sm-3">
								Duración
								</span>
								<span class="col-sm-9">
								{{$program->number_hours ? $program->number_hours . 'horas' : '' }} del {{date("d-m-Y", strtotime($program->start))}} al {{date('d-m-Y', strtotime($program->end))}}
								</span>
							</li>
							<li class="row">
								<span class="col-sm-3">
								Seminarios presenciales
								</span>
								<span class="col-sm-9">
								2 seminarios
								</span>
							</li>
							<li class="row">
								<span class="col-sm-3">
								Semanas
								</span>
								<span class="col-sm-9">
								{{$program->modules->count()}}
								</span>
							</li>
							<li class="row">
								<span class="col-sm-3">
								Compromiso
								</span>
								<span class="col-sm-9">
								6 horas semanales
								</span>
							</li>
						</ul>
					</div>
					<div class="col-sm-12">
						<object data='{{url("archivos/plan-de-formacion-2018.pdf")}}' type="application/pdf" width="100%" height="600px">
				<p<a href='{{url("archivos/plan-de-formacion-2018.pdf")}}'>Plan de formación 2018</a></p>
			</object>
			<h4><a href='{{url("archivos/plan-de-formacion-2018.pdf")}}'>Plan de formación 2018</a></h4>
			<p></p>
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<p><a href='{{url("archivos/plan-de-formacion-2018.pdf")}}' class="btn view block sessions_l">Descargar</a></p>
				</div>
			</div>
					</div>
				</div>
			</div>
		</div>
		<!--ends about box -->


		<!--content_box -->
		<div class="content_box" style="display: none">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="center">Contenido del Programa</h2>
					@if($program->modules->count() > 0)
						@foreach ($program->modules as $module)
							@if($module->public)
								@include('fellow.info_program.list_program')
							@endif
						@endforeach
					@else
					<div class="box">
						<div class="row center">
							<h2>Sin módulos</h2>
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>
		<!--ends content_box -->


		<!--content_box -->
		<div class="how_box" style="display: none">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="center">Reglamento</h2>

					<!---Del alcance del reglamento y la terminología-->
					<div class="module">
						<div class="m_header">
							<div class="row">
								<div class="col-sm-6">
									<h4>1. Del alcance del reglamento y la terminología</h4>
								</div>
							</div>
						</div>
						<!--content-->
						<div class="m_content">
							<div class="row">
								<div class="col-sm-12">
									<p class="ap_time">El presente reglamento es de observancia general, sin excepción, para las y los participantes del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible 2018. Sus disposiciones son de interés formativo y tienen por objeto regular el desempeño y comportamiento de los participantes.</p>
									<p class="ap_time">Se entiende por “equipo coordinador” al grupo conformado por los actores desarrolladores del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible, a saber: el Programa de las Naciones Unidas para el Desarrollo (PNUD), el Instituto Nacional de Transparencia, Acceso a la información y Protección de Datos Personales (INAI), Gestión Social y Cooperación (GESOC), Gobierno Fácil y ProSociedad.</p>
									<p class="ap_time">Se entiende por “programa”, “programa de formación” o “fellowship”, al Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible.</p>
									<p class="ap_time">Se entiende por “plataforma” o “plataforma virtual”, a la interfaz que se encuentra en el sitio web http://apertus.org.mx a la cual se accede mediante un usuario y contraseña para visualizar los contenidos y subir archivos.</p>
									<p class="ap_time">Se entiende por “participantes”, “participante” o “fellows”, a las personas seleccionadas para cursar el programa de formación, quienes realizarán las actividades indicadas en la plataforma, así como las que formen parte de los seminarios presenciales.
</p>
								</div>
							</div>
						</div>
					</div>


					<!---2.-->
					<div class="module">
						<div class="m_header">
							<div class="row">
								<div class="col-sm-12">
									<h4>2. Sobre el contenido del programa y la metodología de evaluación</h4>
								</div>
							</div>
						</div>
						<!--content-->
						<div class="m_content">
							<div class="row">
								<div class="col-sm-12">
									<ol>
										<li class="ap_time">Las y los participantes recibirán una clave de usuario y contraseña para ingresar a la plataforma virtual mediante la cual podrán participar en todas las actividades virtuales y para ser informados sobre las actividades presenciales y por equipo.</li>
										<li class="ap_time">Es derecho del participante el ser informado, por medio de la plataforma virtual, con claridad y tiempo de todas las actividades relativas al programa. </li>
										<li class="ap_time">Dado que este programa es de orden virtual, es responsabilidad del participante conseguir los medios para poder cumplir en tiempo y forma con las actividades del mismo.</li>
										<li class="ap_time">De manera general, la evaluación consta de exámenes en línea, trabajos individuales, participación en los foros y trabajos por equipo.</li>
										<li class="ap_time">Para obtener una calificación final aprobatoria se deberá obtener al menos 70 puntos de 100 posibles, los cuales corresponden al trabajo final (40%), actividades en línea trabajos (30%), y la participación presencial en seminarios (30%). A continuación, se describe en qué consiste cada concepto:<br><br>
										<table class="table">
											<thead>
												<tr>
													<th>CONCEPTO</th>
													<th>DESCRIPCIÓN</th> 
													<th>VALOR</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><h4>Actividades de aprendizaje en línea</h4></td>
													<td>Se refieren, por un lado, a los cuestionarios y ejercicios virtuales
que se deben completar de forma individual durante o al final de
cada sesión virtual. Los cuestionarios usualmente son de opción múltiple y los ejercicios implican elaborar un producto que deberá
ser cargado como archivo en la plataforma.
Por otro lado, se refieren a los foros virtuales que se presentan en
algunas sesiones, en los cuales se deberá participar activamente.
Los cuestionarios y ejercicios tienen un valor del 80% y los foros
del 20% respecto del valor total del concepto.</td>
													<td>30%</td>
												</tr>
												<tr>
													<td><h4>Participación presencial en seminarios</h4></td>
													<td>Se refiere a la asistencia a los seminarios presenciales, así como a la realización de las actividades y participación activa durante el mismo.</td>
													<td>30%</td>
												</tr>
												<tr>
													<td><h4>Trabajo final</h4></td> 
													<td>Se refiere al producto final que será elaborado en equipo durante todo el programa de formación.</td>
													<td>40%</td>
												</tr>
											</tbody>
										</table>
										
										</li>
										<li class="ap_time">Al término del programa se otorgará una constancia de participación y cumplimiento de los requisitos del programa a las y los participantes que aprueben el programa.</li>
									</ol>
								</div>
							</div>
						</div>
					</div>

					
					<!---Sobre las sesiones y actividades en la plataforma-->
					<div class="module">
						<div class="m_header">
							<div class="row">
								<div class="col-sm-12">
									<h4>3. Sobre las sesiones y actividades en la plataforma</h4>
								</div>
							</div>
						</div>
						<!--content-->
						<div class="m_content">
							<div class="row">
								<div class="col-sm-12">
									<ol>
										<li class="ap_time">Las sesiones y actividades por realizar en la plataforma se encuentran organizadas por semana. La apertura de las sesiones dependerá de que se realicen en su totalidad las actividades de las mismas.</li>
										<li class="ap_time">Existen actividades que contemplan la elaboración de productos que tendrán que subirse a la plataforma, los cuales tendrán una fecha límite para ser revisados por el equipo coordinador.</li>
										<li class="ap_time">Si existe un retraso en la realización de las actividades que contemplan la elaboración y subida de un producto en la plataforma, las únicas situaciones que se consideran para justificar la entrega extemporánea son por fallas en la plataforma o en los contenidos de la misma, así como situaciones extraordinarias tales como: catástrofes naturales, enfermedades graves, accidentes o tratamientos médicos que interfieran con la realización de las actividades, maternidad o paternidad y riesgo durante el embarazo y la lactancia.</li>
										<li class="ap_time">Las situaciones anteriores, así como otras circunstancias puntuales no mencionadas, deberán ser comunicadas por los participantes al equipo coordinador máximo dos días después del cierre de la entrega, ante lo cual el equipo coordinador decidirá la procedencia sobre la justificación del retraso, así como los ajustes a la evaluación del participante.</li>

									</ol>
								</div>
							</div>
						</div>
					</div>

					<!---Sobre la entrega de trabajos y tareas-->
					<div class="module">
						<div class="m_header">
							<div class="row">
								<div class="col-sm-12">
									<h4>4. Sobre la entrega de trabajos y tareas</h4>
								</div>
							</div>
						</div>
						<!--content-->
						<div class="m_content">
							<div class="row">
								<div class="col-sm-12">
									<ol>
										<li class="ap_time">Las fechas de entrega de los trabajos y las tareas se indicarán en cada una de las actividades de las sesiones. </li>
										<li class="ap_time">No habrá prórrogas por entregas con retraso.</li>
										<li class="ap_time">Las únicas situaciones que se consideran para justificar una prórroga son por fallas en la plataforma o en los contenidos de la misma, así como situaciones extraordinarias tales como: catástrofes naturales, enfermedades graves, accidentes o tratamientos médicos que interfieran con la elaboración de los trabajos, maternidad o paternidad y riesgo durante el embarazo y la lactancia. Las anteriores, así como otras circunstancias puntuales no mencionadas, deberán ser comunicadas por los participantes al equipo coordinador antes de la fecha de entrega de los trabajos, ante lo cual el equipo coordinador decidirá la procedencia de la prórroga, así como los ajustes a la evaluación.</li>
										<li class="ap_time">Cualquier nivel de plagio o trabajos que se identifiquen como elaborados por terceros ocasionará que éste se anule, además que dejará precedente sobre la deshonestidad del/los participante/s ante el comité directivo, cuyas sanciones, dependiendo del grado, pueden incluir la expulsión del proceso. Cuando ocurra este caso, el equipo coordinador decidirá las sanciones de manera colegiada.</li>
										<li class="ap_time">El equipo coordinador podrá, previo a la entrega final de trabajos en equipo, solicitar una reunión virtual con las y los participantes para revisar y retroalimentar el trabajo que será presentado ante los Secretarios Técnicos Locales y/o autoridades locales.</li>

									</ol>
								</div>
							</div>
						</div>
					</div>

					<!--- Sobre las mentorías y el monitoreo del desempeño-->
					<div class="module">
						<div class="m_header">
							<div class="row">
								<div class="col-sm-12">
									<h4>5. Sobre las mentorías y el monitoreo del desempeño</h4>
								</div>
							</div>
						</div>
						<!--content-->
						<div class="m_content">
							<div class="row">
								<div class="col-sm-12">
									<ol>
										<li class="ap_time">Las mentorías tienen la finalidad de apoyar a los fellows en la realización del proyecto final, por lo que se realizarán de manera grupal.</li>
										<li class="ap_time">Para las mentorías, cada equipo tendrá un mentor asignado, del cual se les informará durante el primer mes del programa, y en ocasiones habrá un mentor de apoyo especialista de acuerdo con los temas y problemáticas en las que las y los participantes busquen incidir.</li>
										<li class="ap_time">La mentoría consiste en revisar avances y ayudar a resolver problemas metodológicos y prácticos relacionados con la elaboración del proyecto. </li>
										<li class="ap_time">Las mentorías podrán llevarse a cabo con una sola persona de cada equipo en caso de que existan dificultades para que todos los integrantes estén presentes. Cuando sea el caso, la mentoría tendrá lugar en estas condiciones previo acuerdo entre los miembros del equipo.</li>
										<li class="ap_time">La periodicidad de las mentorías por equipo será mensual durante el programa, y podrán considerarse hasta dos o tres mentorías posteriores al programa relacionadas con el trabajo de incidencia del equipo en sus respectivos estados.</li>
										<li class="ap_time">El monitoreo del desempeño de los fellows consiste en la revisión periódica de su avance durante el programa por parte del equipo coordinador, así como en apoyarlos en situaciones de índole académica que afecten su desempeño en el programa. Se realizará un contacto periódico con cada participante por los medios oficiales de manera mensual. Adicionalmente, cuando el equipo coordinador detecte un bajo rendimiento por parte de algún participante, se le contactará para ayudarle a solventar, en la medida de lo posible, aquello que le impida avanzar en su proceso.</li>


									</ol>
								</div>
							</div>
						</div>
					</div>

					<!--- Sobre los seminarios presenciales-->
					<div class="module">
						<div class="m_header">
							<div class="row">
								<div class="col-sm-12">
									<h4>6. Sobre los seminarios presenciales</h4>
								</div>
							</div>
						</div>
						<!--content-->
						<div class="m_content">
							<div class="row">
								<div class="col-sm-12">
									<ol>
										<li class="ap_time">La finalidad de los seminarios en modalidad presencial es la de introducir y reforzar los contenidos temáticos del programa de tal modo que se puedan resolver dudas de manera inmediata. De igual manera, pretenden ser un espacio para que los participantes logren interactuar entre ellos, así como con expertos y otros actores clave, con el fin de promover la generación de una Red de Agentes de Cambio.</li>
										<li class="ap_time">El equipo coordinador será el encargado de realizar los arreglos logísticos necesarios para que todos los participantes asistan a los seminarios presenciales. Esto incluye asegurar y asumir los costos para el traslado, el hospedaje y la alimentación de las y los participantes en los lugares donde se realicen las sesiones presenciales. Para esto, el equipo coordinador contactará con la mayor anticipación posible a cada participante para informarle sobre las fechas, horarios y medios de transporte disponibles para su traslado.</li>
										<li class="ap_time">Será responsabilidad de los y las participantes presentarse puntualmente en la fecha y hora definidas para el traslado al lugar donde se realizarán los seminarios presenciales. Para el caso de vuelos, es responsabilidad de los participantes adecuarse a las políticas señaladas por la aerolínea en la que viajarán respecto a la anticipación con la que deberán presentarse en la sala de abordar, la documentación de equipaje, etc. En caso de perder algún vuelo por negligencia o causas no imputables al proyecto, el costo del traslado correrá a cuenta del participante.</li>
										<li class="ap_time">La asistencia de los participantes a los seminarios es obligatoria. La ausencia de los mismos sólo será justificada por situaciones extraordinarias tales como: catástrofes naturales, enfermedades graves, accidentes o tratamientos médicos que impidan el traslado del participante o interfieran con su desempeño durante las sesiones, maternidad o paternidad y riesgo durante el embarazo y la lactancia. Las anteriores, así como otras circunstancias puntuales no mencionadas, deberán ser comunicadas por los participantes al equipo coordinador con anticipación, mínimo una semana ante situaciones no emergentes, a la fecha de inicio de cada seminario, quien decidirá de manera colegiada la procedencia de la ausencia, así como los ajustes a la evaluación del participante. La determinación a la que llegue el equipo coordinador será comunicada al participante por alguna de las líneas de comunicación del programa.</li>
									</ol>
								</div>
							</div>
						</div>
					</div>


					<!---  Líneas de comunicación-->
					<div class="module">
						<div class="m_header">
							<div class="row">
								<div class="col-sm-12">
									<h4>7.  Líneas de comunicación</h4>
								</div>
							</div>
						</div>
						<!--content-->
						<div class="m_content">
							<div class="row">
								<div class="col-sm-12">
									<ol>
										<li class="ap_time">El medio oficial de comunicación oficial será la plataforma del programa.</li>
										<li class="ap_time">Para avisos especiales, es posible que el equipo coordinador utilice otros medios de contacto además de la plataforma, como lo son el correo electrónico y/o el teléfono.</li>
									</ol>
								</div>
							</div>
						</div>
					</div>


					<!--- Aclaraciones y dudas-->
					<div class="module">
						<div class="m_header">
							<div class="row">
								<div class="col-sm-12">
									<h4>8. Aclaraciones y dudas</h4>
								</div>
							</div>
						</div>
						<!--content-->
						<div class="m_content">
							<div class="row">
								<div class="col-sm-12">
									<ol>
										<li class="ap_time">Para solicitar alguna aclaración o alguna respuesta durante el desarrollo del  programa de formación se podrá contactar al equipo de ProSociedad: <a href="mailto:carlos.bauche@prosociedad.org">carlos.bauche@prosociedad.org</a> y  <a href="mailto:german@prosociedad.org">german@prosociedad.org</a>  </li>
										<li class="ap_time">Para cualquier pregunta/problema respecto al funcionamiento de la plataforma (acceso, problemas al cargar tareas o ensayos, actividades o evaluaciones que no se acreditan en la plataforma, etc.) el medio de comunicación será con el equipo de Gobierno Fácil a través del foro de soporte técnico. </li>
										<li class="ap_time">Para cualquier Asunto General del programa, como retroalimentación del desarrollo del programa y contenidos, de la plataforma, dudas/aclaraciones de cualquier otro tema, por favor comunicarse con el equipo de PNUD al mail: <a href="mailto:mariana.garcia@undp.org">mariana.garcia@undp.org</a>     </li>
									</ol>
								</div>
							</div>
						</div>
					</div>

					<!--- Situaciones extracurriculares-->
					<div class="module">
						<div class="m_header">
							<div class="row">
								<div class="col-sm-12">
									<h4>9. Situaciones extracurriculares</h4>
								</div>
							</div>
						</div>
						<!--content-->
						<div class="m_content">
							<div class="row">
								<div class="col-sm-12">
									<ol>
										<li class="ap_time">Se prohíbe cualquier tipo de discriminación, acoso, amedrentamiento, abuso, hacia cualquier participante del programa, asesores, personal de soporte o facilitadores, por cualquier medio virtual o físico que se disponga.</li>
										<li class="ap_time">Se prohíbe cualquier tipo de propaganda religiosa y/o partidista ajena a los contenidos del curso.     </li>
										<li class="ap_time">Se prohíbe cualquier tipo de violación a la propiedad intelectual, mediante el plagio o cualquier otro medio.</li>
									</ol>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!--ends content_box -->

@endsection

@section('js-content')
<script type="text/javascript" src="{{url('js/jquery-1.4.4.min.js')}}"></script>
<script src="{{url('js/jquery.easing.1.3.js')}}"></script>
<script src="{{url('js/cufon-yui.js')}}"></script>
<script src="{{url('js/modal_fellow/modal.js')}}"></script>

@endsection
