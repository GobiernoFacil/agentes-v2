@extends('layouts.frontend.master')
@section('title', 'Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible 2018')
@section('description', 'Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible 2018')
@section('body_class', 'programa 2018')
@section('canonical', url('programa-gobierno-abierto/'.$program->slug))
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_programa')

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
    <?php $date = new DateTime($program->start);?>
		<h1>Edición {{$date->format('Y')}} - PROGRAMA DE FORMACIÓN DE <strong>AGENTES LOCALES DE CAMBIO</strong> EN <strong>GOBIERNO ABIERTO</strong> Y DESARROLLO SOSTENIBLE<a href="#nota"><sup>1</sup></a></h1>

    <div class="row">
			<div class="col-sm-9">
				<ul class="toggle-view">
					<!---perfil-->
					<li>
						<h3>Perfil de Egreso</h3>
						<span></span>
						<div class="panel">
					        {!!$program->notice->notice_data->profile!!}
						</div>
					</li>

					<!---Metodología-->
					<li>
						<h3>Metodología y Modalidad</h3>
						<span></span>
						<div class="panel">
						        {!!$program->notice->notice_data->modality_results!!}
						</div>
					</li>
					<!--Contenido Temático-->
					<li>
						<h3>Contenido Temático y Modalidad</h3>
						<span></span>
						<div class="panel">
						<table class="table">
							<thead>
								<tr>
									<th>Módulo</th>
									<th>Sesión / Modalidad</th>
								</tr>
							</thead>
							<tbody>
                <?php $count = 1; ?>
                @foreach($program->fellow_modules as $module)
								<tr>
									<td><h4>{{$count}}. {{$module->title}}</h4></td>
									<td>
										<table class="table">
                      <?php $session_count = 1; ?>
                      @foreach($module->sessions as $session)
											<tr><td>{{$count}}.{{$session_count}} {{$session->name}}.</td>
												<td>{{$module->modality}}</td>
											</tr>
                      <?php $session_count++; ?>
                      @endforeach
										</table>
									</td>
								</tr>
                <?php $count++; ?>
                @endforeach
							</tbody>
						</table>

						
						</div>
					</li>
					<!--Evaluación-->
					<li>
						<h3>Evaluación</h3>
						<span></span>
						<div class="panel">
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
					</li>
					<li>
						<h3><a href="{{url('/archivos/Programa-Fellowship_Mazatlan_junio2018.pdf')}}" download>Primer seminario presencial del programa de formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible, del 6 al 8 de junio de 2018 en la ciudad de Mazatlán, Sinaloa.</a></h3>
					</li>
					<li>
						<h3><a href="{{url('/archivos/ProgramaSegundoSeminario14sep2018.pdf')}}" download>Segundo seminario presencial del programa de formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible, del 19 al 21 de septiembre de 2018 en la ciudad de México.</a></h3>
					</li>
					<?php /*
					<!-- coordinandores-->
					<li>
						<h3>Coordinadores Académicos</h3>
						<span></span>
						<div class="panel">
						<ul>
							<li>
							<h3>Irina Alberro Behocaray</h3>
							<p>Previamente trabajó como Profesora-Investigadora en El Colegio de México (2007-2011). También ha sido Profesora en la Universidad Iberoamericana, la Universidad de Northwestern y Profesora Invitada en el Departamento de Ciencia Política de la Universidad de Minnesota. Adicionalmente ha ocupado diversos puestos en la Administración Pública Federal, en particular en la Secretaría de Hacienda y la Secretaría de Agricultura. Sus publicaciones incluyen capítulos en libros y revistas académicas nacionales e internacionales, en temas de elecciones, perfil socioeconómico de los votantes, opinión pública y administración pública.
							Estudió la licenciatura en Economía en el ITAM, la Maestría en Políticas Públicas en la Universidad de Chicago y la Maestría y el Doctorado en Ciencia Política en la Universidad de Northwestern.)</p>
							</li>
							<li>
							<h3>Carlos Bauche Madero</h3>
							<p>Maestro en Desarrollo Social por la UP Campus Guadalajara con Mención Honorífica, Posgrado en Filosofía (UNIVA), Desarrollo de base e International Counseling por la universidad de LeHigh (Pennsylvania) y Licenciado en Psicología por el ITESO. Profesor en ITESO en temáticas de diseño e implementación de programas de prevención social, así como políticas y programas de alimentación. Fue asesor de la Secretaría de Desarrollo Social en el diseño e implementación de estrategias nacionales para impulsar la seguridad alimentaria en México. Cuenta con 12 años de experiencia en la Investigación, el diagnóstico, diseño, implementación y evaluación de programas sociales en distintos escenarios locales, regionales, nacionales e internacionales. Es representante local de la marca de consultoría en responsabilidad social y sustentabilidad, ACCSE Occidente. En donde ha colaborado en proyectos con empresas que buscan acreditarse como ESR, y en la creación de herramientas de diagnóstico institucional.</p>
							</li>
							<li>
							<h3>Max Henderson Hernández</h3>
							<p>Es licenciado en Economía por el Instituto Tecnológico Autónomo de México (ITAM) y obtuvo la Maestría y Doctorado en la Universidad de Chicago, donde hizo la tesis doctoral con Robert Fogel (Premio Nobel en Economía 1993), por la que obtuvo los máximos honores. En la academia ha trabajado en la Universidad Nacional Autónoma de México (UNAM), la Universidad de Chicago y la Universidad de Minnesota. Dentro del sector público ha sido Subsecretario (en funciones) de Prospectiva, Planeación y Evaluación en la Secretaría de Desarrollo Social (SEDESOL) de México, así como Jefe de la Unidad de Planeación y Relaciones Internacionales dentro de la misma Secretaría. También ha sido Director de Comercialización de Diconsa y funcionario del Instituto Nacional de Estadística y Geografía (INEGI). En el sector privado fue consultor de Mckinsey & Co. y emprendedor independiente.</p>
							</li>
							<li>
							<h3>Ana Magdalena Rodríguez Romero</h3>
							<p>Magdalena Rodríguez es Ingeniera Industrial y de Sistemas por el ITESM Campus Guadalajara y maestra en Gestión de Desarrollo por la London School of Economics and Political Science (LSE), graduada con mérito académico. Es socia fundadora de ProSociedad. Su experiencia profesional se centra en el diseño, gestión estratégica y evaluación de programas y proyectos con impacto social; así́ como el fortalecimiento de Organizaciones de la Sociedad Civil, con énfasis en el desarrollo institucional y la sustentabilidad financiera. En 2015 fue acreedora al segundo lugar del Premio a la Investigación sobre Sociedad Civil 2015 promovido por Centro Mexicano para la Filantropía (CEMEFI). Como docente ha colaborado con la Universidad Panamericana, Tec de Monterrey y el ITESO, en donde ha impartido materias en temas de Gestión de Proyectos de Cooperación Internacional para el Desarrollo, Economía Social, Responsabilidad Social Empresarial e Innovación Social.</p>
							</li>
							<li>
							<h3>María Elena Valencia González </h3>
							<p>Elena es licenciada en Administración y Negocios Internacionales  y cuenta con maestría en Desarrollo Social ambas por la Universidad Panamericana sede Guadalajara. Fue becada por la Comisión Europea para realizar estudios de maestría en Gestión Estratégica de Proyectos por la Universidad Heriot-Watt de Escocia, el Politécnico di Milano y la Universidad de Umea en Suecia, graduándose con honores con la tesis de investigación <em>"Development of wind farm projects through partnership as a strategic decision. An empirical study of different partners’ perspective"</em>. </p>
							</li>
						</ul>
						</div>
					</li>
					<!---Ponentes invitados-->
					<li>
						<h3>Ponentes invitados</h3>
						<span></span>
						<div class="panel">
							<p>Como parte del programa contaremos con la participación de ponentes expertos en las materias y temáticas a abordar. En Seminarios, Charlas y Webinars contaremos con la participación de ponentes de miembros de organizaciones de referencia: INAI, PNUD y el Sistema de Naciones Unidas, UNAM, CIDE, Tec de Monterrey, el COLMEX, entre otros.</p>
						</div>
					</li>
					
					*/
					?>
				</ul>
			</div>

			<div class="col-sm-3">
				<h2></h2>
				<a href="{{url('programa-gobierno-abierto/alcance')}}" class="icon i_alcance"><span>ALCANCE DEL PROGRAMA</span></a>
				<a href="{{url('programa-gobierno-abierto/programa-2018/ver-contenido')}}" class="icon i_contenido"><span>CONTENIDO DEL PROGRAMA</span></a>
				<a href="{{url('programa-gobierno-abierto/aliados')}}" class="icon i_aliados">CONOCE A LOS ALIADOS</a>
				<a href="{{url('programa-gobierno-abierto/programa-2018/ver-generacion')}}" class="icon i_cfellows"><span>CONOCE A LOS FELLOWS</span></a>
				<a href="{{url('convocatoria')}}" class="icon i_convocatoria"><span>CONVOCATORIA</span></a>
				<a href="{{url('programa-gobierno-abierto/antecedentes')}}" class="icon i_antecedentes">ANTECEDENTES</a>
			</div>

		</div>
		<a name="nota"></a>
		<div class="notes">
		<p><sup>1</sup> El <strong>Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</strong> es promovido por el Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales (INAI), la Oficina para México del Programa de Naciones Unidas para el Desarrollo (PNUD-México), GESOC, Agencia para el Desarrollo, A.C., ProSociedad Hacer Bien el Bien, A.C., y Gobierno Fácil – con el apoyo de la Agencia de los Estados Unidos para el Desarrollo Internacional (USAID) en el marco del proyecto: “Local Capacities in Open Government (OG) for the Achievement of the Sustainable Development Goals (SGDs) in Mexico /Programa de fortalecimiento de capacidades en gobierno abierto para el cumplimiento de los objetivos de desarrollo sostenible en lo local.”</p>
		</div>
	</div>
</div>
@endsection
