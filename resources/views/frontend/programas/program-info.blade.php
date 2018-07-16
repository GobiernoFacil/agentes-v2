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
<?php /*
						<table class="table">
							<thead>
								<tr><th><h3>TEMAS TRANSVERSALES</h3></th></tr>
							</thead>
							<tbody>
								<tr><td><h4>Enfoque de género</h4></td></tr>
								<tr><td><h4>Enfoque territorial</h4></td></tr>
								<tr><td><h4>Enfoque de derechos</h4></td></tr>
								<tr><td><h4><em>Leave no one behind</em> – No dejar a nadie atrás</h4></td></tr>
								<tr><td><h4>Desarrollo de Capacidad Local</h4></td></tr>
							</tbody>
						</table>

						</div>
					</li>
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
					<!--Evaluación-->
					<li>
						<h3>Evaluación y Reconocimiento</h3>
						<span></span>
						<div class="panel">
						<p>El curso se desarrollará con la guía de los Coordinadores y mentores por medio de la Plataforma de Formación. Semanalmente se presentarán actividades y cuestionarios que serán calificados. Así mismo, el participante al cierre del curso presentará un proyecto en equipo, concreto y factible que, a través del uso de las herramientas adquiridas durante el programa, enfrente un reto local de desarrollo por medio de la realización de acciones que promuevan la transparencia, la participación, la rendición de cuentas, y la innovación cívica y tecnológica.</p>
						<p>La evaluación final se integrará de la siguiente manera:</p>
						<ul>
							<li>Actividades y ensayos 30%</li>
							<li>Cuestionarios de conocimientos 20%</li>
							<li>Proyecto final 50%</li>
						</ul>
						<p>A quienes acrediten el 70% de los puntos a evaluar serán acreedores a un reconocimiento que avale su participación en el programa.</p>
						</div>
					</li>
					*/
					?>
				</ul>
			</div>

			<div class="col-sm-3">
				<h2></h2>
				<a href="{{url('programa-gobierno-abierto/alcance')}}" class="icon i_alcance"><span>ALCANCE DEL PROGRAMA</span></a>
				<a href="{{url('programa-gobierno-abierto/aliados')}}" class="icon i_aliados">CONOCE A LOS ALIADOS</a>
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
