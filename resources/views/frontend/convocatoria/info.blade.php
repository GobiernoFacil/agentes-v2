@extends('layouts.frontend.master')
@section('title', 'Convocatoria Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Convocatoria Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'convocatoria')
@section('canonical', url('convocatoria') )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_convocatoria')

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
	<h1><strong>Convocatoria</strong> PROGRAMA DE FORMACIÓN DE <strong>AGENTES LOCALES DE CAMBIO</strong> EN <strong>GOBIERNO ABIERTO</strong> Y DESARROLLO SOSTENIBLE</strong>
	</h1>
		<p>El Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales (INAI), la Oficina para México del Programa de Naciones Unidas para el Desarrollo (PNUD-México), GESOC, Agencia para el Desarrollo, A.C., ProSociedad Hacer Bien el Bien, A.C., y Gobierno Fácil – con el apoyo de la Agencia de los Estados Unidos para el Desarrollo Internacional (USAID) – convocan a los sectores gubernamental, social, empresarial y académico de los estados de Chihuahua, Morelos, Nuevo León, Oaxaca y Sonora y, en general, a cualquier persona interesada de las entidades federativas antes señaladas a participar en la edición 2017 del <strong>Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</strong>, a realizarse entre los meses de mayo y noviembre de 2017.</p>
	
		<div class="row">
				<div class="col-sm-4">
					<p class="center"><a href="{{url('convocatoria/aplicar')}}" class="btn gde i_convoca_w">Participa</a></p>
				</div>
				<div class="col-sm-4">
					<p><a href="{{url('archivos/ConvocatoriaFellowship.pdf')}}" class="btn gde download i_download" download>Convocatoria</a></p>
				</div>
				
				<div class="col-sm-4">
					<p><a href="{{url('archivos/ConsentimientoDatosPersonales.pdf')}}" class="btn gde download i_download" download>Aviso de Privacidad</a></p>

					<?php /*
					<p><a href="{{url('convocatoria/proceso-de-seleccion')}}" class="btn gde process">Proceso de Selección</a></p>
					*/ ?>
				</div>
				
			</div>
		</div>
	<div class="col-sm-8 col-sm-offset-2">
		<h2>Bases</h2>
		<ol class="toggle-view">
			<li>
				<h3>Objetivo</h3>
				<span></span>
				<div class="panel">
				<p>El programa tiene como propósitos el fortalecimiento de capacidades, la vinculación y empoderamiento de una red de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible que promuevan la consolidación de acciones orientadas a fortalecer prácticas de transparencia y participación ciudadana a nivel local en México. Este programa ofrecerá una plataforma única para el aprendizaje, la reflexión, el intercambio de ideas y experiencias, así como para la realización de proyectos que puedan ponerse en marcha en el corto plazo, y que utilicen las perspectivas de gobierno abierto y desarrollo sostenible para transformar alguna realidad de su localidad o región. Al concluir la etapa formativa, se esperaría que los egresados se integren y participen activamente en los trabajos que se realizan en su entidad federativa en el marco de los ejercicios locales de Gobierno Abierto promovidos por el INAI.</p>
				</div>
			</li>

			<li>
				<h3>Modalidad y resultados esperados</h3>
				<span></span>
				<div class="panel">
				<p>Durante los siete meses de duración del programa, los contenidos y actividades se realizarán fundamentalmente en una plataforma en línea. Además, se tiene prevista la realización de dos rondas de seminarios y talleres presenciales – conducidos por expertos reconocidos en temas de Gobierno Abierto y Desarrollo Sostenible –a finales del mes de mayo y durante el mes de agosto en sedes por definir en la Ciudad de México y/o en algún estado de la República Mexicana. Los costos de traslado, hospedaje y alimentación de los Agentes Locales de Cambio para participar en estos seminarios presenciales correrán a cargo de las organizaciones convocantes.<a href="#note1"><sup>1</sup></a></p>
				<p>Además de adquirir capacidades y de vincularse a la red de Agentes Locales de Cambio, se espera que los participantes elaboren y presenten al final de los siete meses un proyecto en equipo, concreto y factible que, a través del uso de las herramientas adquiridas durante el programa, enfrente un reto local de desarrollo por medio de la realización de acciones que promuevan la transparencia, la participación, la rendición de cuentas, y la innovación cívica y tecnológica. Aquellos participantes que cumplan satisfactoriamente con todos los requisitos académicos al concluir el programa, recibirán una constancia de participación.</p>
				</div>
			</li>
			<!--perfil de egreso-->
			<li>
				<h3>Perfil de egreso</h3>
				<span></span>
				<div class="panel">
				<p>Al concluir la etapa formativa, se espera que los participantes:</p>
				<ul>
					<li>Cuenten con una formación sólida en temas de gobierno abierto y desarrollo sostenible que les permitirán incidir en debates y en el desarrollo de acciones innovadoras orientadas a resolver problemas puntuales de su localidad y región.</li>
					<li>Formen parte de una red de líderes y expertos a través de la cual podrán intercambiar ideas y desarrollar proyectos en conjunto que permitan enfrentar retos de desarrollo de alcance local y regional, desde una perspectiva de apertura gubernamental.</li>
					<li>Sean capaces de elaborar proyectos colaborativos que generen soluciones concretas e innovadoras para atender problemas públicos con base en los principios de gobierno abierto. </li>
					<li>Se comprometan a participar activamente en los ejercicios locales de gobierno abierto promovidos por el INAI en colaboración con los Secretariados Técnicos de cada una de las entidades federativas consideradas en esta convocatoria.</li>
					<li>Se conviertan en replicadores de las capacidades y habilidades adquiridas durante el programa en su contexto, y que permita la consolidación de la perspectiva de gobierno abierto a nivel local.</li>
				</ul>
				</div>
			</li>
		
			<li>
				<h3>Perfil y elegibilidad de los participantes</h3>
				<span></span>
				<div class="panel">
				<p>Para la edición 2017 de este programa de formación se seleccionarán hasta 20 participantes, mismos que serán elegidos a través de un proceso abierto y transparente por un Comité Dictaminador integrado por un representante de cada una de las organizaciones convocantes. Dado el cupo de participantes, en esta primera edición, y considerando que es un ejercicio piloto de fortalecimiento de capacidades, se recibirán exclusivamente postulaciones de candidatos provenientes de los estados de Sonora, Chihuahua, Morelos, Nuevo León y Oaxaca, que forman parte del proyecto de <strong>Gobierno Abierto: Cocreación desde lo Local impulsado por el Sistema Nacional de Transparencia y el INAI</strong>. Entre los criterios que la Junta del Proyecto utilizó para seleccionar a estas entidades fueron:</p>
				<div class="row">
					<div class="col-sm-6">
					<h4>Generales</h4>
					<ol>
						<li>Que ninguna entidad atravesara por procesos electorales en 2017</li>
						<li>Que a criterio de la Secretaría Técnica de la Comisión Permanente de Gobierno Abierto del INAI, los ejercicios muestren condiciones propicias para su desarrollo pero que requieran el fortalecimiento de capacidades para su sostenibilidad en el mediano plazo.</li>
					</ol>
						</div>
						<div class="col-sm-6">				
					<h4>Particulares</h4>
					<ol>
						<li>Dos entidades que hayan lanzado su Plan de Acción Local (PAL) a más tardar al cierre de 2016; una que haya concluido con su implementación y otra que se encuentre en el proceso de conclusión</li>
						<li>Tres entidades que se hayan incorporado a la iniciativa en 2016</li>
					</ol>
					</div>
				</div>
				<p>Hay que señalar que en futuras ediciones, la convocatoria se ampliará a 10 entidades federativas más. El Comité Dictaminador garantizará el equilibrio de género en la selección de los participantes en el programa de formación, así como en el sector de procedencia (sector social, académico, privado o gubernamental). Igualmente, en el proceso de selección se procurará tener una representación equitativa de cada entidad federativa participante en función de las postulaciones recibidas.</p>
				
				<p>Los interesados en participar en el programa deberán:</p>
				<ol>
					<li>Ser jóvenes líderes de entre 25 y 40 años que formen parte de los sectores gubernamental, social, empresarial o académico; que radiquen en los estados de Sonora, Chihuahua, Morelos, Nuevo León y Oaxaca.</li>
					<li>Contar con conocimiento previo y experiencia probada en el desarrollo de investigaciones o de proyectos de incidencia de alcance local relacionados con Gobierno Abierto o Desarrollo Sostenible. Es deseable la experiencia en redes o trabajo colaborativo. </li>
					<li>Tener un sólido entendimiento y sensibilidad sobre los principales problemas y retos de desarrollo que se enfrentan en la entidad federativa de residencia.</li>
					<li>Ser innovadores y estar comprometidos para formar parte de una red de líderes para el intercambio de experiencias y el desarrollo de proyectos de gobierno abierto con alcance local y regional.</li>
				</ol>

				<p>Como parte del proceso de postulación, los interesados deberán<a href="#note2"><sup>2</sup></a>:</p>
				<ol>
					<li>Llenar el formato de registro, disponible en el sitio <a href="{{url('')}}">{{url('')}}</a>.</li>
					<li>Elaborar un ensayo – no mayor a cinco cuartillas –<a href="#note3"><sup>3</sup></a> en el que manifiesten las razones por las cuales estén interesados en participar en el programa de formación de Agentes Locales de Cambio, así como las aportaciones que pueden brindar a su contexto local como resultado de su participación en este programa.</li>
					<li>Elaborar un video breve – alrededor de 2 minutos – en donde el postulante presente una idea para desarrollar un proyecto en su entidad federativa en el que, a través del uso de herramientas de gobierno abierto, se pueda atender exitosamente un reto local de desarrollo sostenible.<a href="#note4"><sup>4</sup></a></li>
					<li>Perfil curricular actualizado, en el que se muestre evidencia de su experiencia probada en los temas de gobierno abierto y/o desarrollo sostenible (publicaciones, investigaciones o documentos probatorios que muestren la participación en el desarrollo de proyectos relacionados con estos temas).</li>
					<li>Presentar una carta membretada que muestre el sector de procedencia del aspirante (sociedad civil, gobierno, académica, iniciativa privada).</li>
					<li>Presentar una copia de comprobante de domicilio que acredite la residencia del candidato.</li>
					<li>Descargar, leer, firmar (en caso de aceptar) y enviar el <a href="aviso-privacidad">Aviso de Privacidad</a> por medio del cual otorguen el consentimiento relativo al tratamiento de sus datos personales, disponible en <a href="{{url('archivos/ConsentimientoDatosPersonales.docx')}}" download>{{url('archivos/ConsentimientoDatosPersonales.docx')}}</a>.</li>
				</ol>
				
				<p>De los participantes en el programa de formación de Agentes Locales de Cambio en gobierno abierto y desarrollo sostenible se espera:</p>
				<ul>
					<li>Una participación activa durante la duración de todo el programa. En caso de que un participante decida abandonar el programa, dicho espacio será ocupado por el aspirante rechazado con la calificación más alta en el proceso de selección.</li>
					<li>Que realicen todas las actividades en línea y presenciales de aprendizaje previstas durante el programa. Se tiene prevista una carga semanal de alrededor de ocho horas dedicadas a las actividades del curso.</li>
					<li>Disponibilidad para viajar y asistir a las dos rondas de seminarios y talleres que se realizarán en sedes por definir en la Ciudad de México y/o en algún estado de la República Mexicana. Cada ronda de seminarios tendrá una duración de tres días.</li>
					<li>Que desarrollen un proyecto final en equipo – uno por cada entidad federativa – en el que apliquen los conocimientos adquiridos durante el curso para enfrentar un reto local de desarrollo empleando las herramientas de gobierno abierto; y que sea factible de ser implementado en el corto plazo.</li>
					<li>Que muestren disposición para mantener el vínculo con la red de Agentes Locales de Cambio, y para desarrollar proyectos de alcance local y regional una vez concluida la duración del proyecto.												 	   													 </li>
					<li>Que se comprometan a integrarse y a participar activamente en los Secretariados Técnicos Locales y en los trabajos que se realizan en su entidad federativa en el marco de la iniciativa Gobierno Abierto: Cocreación desde lo Local del INAI.	   													 </li>
					<li>Que realicen todas las actividades previstas en la convocatoria y acreditar de manera satisfactoria todos los módulos del Programa.</li>
				</ul>
				</div>
			</li>
		
		<li>
			<h3>Plazos y proceso de postulación</h3>
			<span></span>
			<div class="panel">
			<p>La presente convocatoria estará abierta del 21 de marzo hasta el 28 de abril de 2017 a las 15:00 horas (tiempo de la Ciudad de México). No se recibirá ninguna postulación extemporánea. El proceso de postulación se realizará exclusivamente en línea en el sitio: <a href="{{url('convocatoria/aplicar')}}">{{url('convocatoria/aplicar')}}</a>.</p>
			
			<p>Una vez cerrado el plazo de postulaciones, el Comité Dictaminador integrado por un representante de las organizaciones convocantes revisará la documentación entregada por los postulantes, y preseleccionará a un grupo de candidatos que serán invitados a una ronda de entrevistas en línea, que permitirán evaluar con mayor detalle la idoneidad del perfil. Posteriormente, el Comité Dictaminador seleccionará por consenso un máximo de 20 participantes que cumplan satisfactoriamente con los requisitos establecidos en esta convocatoria y que hayan destacado en la ronda de entrevistas. El Comité Dictaminador estará integrado por:</p>
			<ul>
				<li>Un representante de la oficina para México del Programa de Naciones Unidas para el Desarrollo.</li>
				<li>Un representante del Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales.</li>
				<li>Un representante de la organización Gesoc, Agencia para el Desarrollo, A.C.	</li>
				<li>Un representante de la organización ProSociedad, Hacer Bien el Bien, A.C.</li>
				<li>Un representante de la organización Gobierno Fácil	 </li>
				<li>Un representante de la oficina para México de la Agencia de los Estados Unidos para el Desarrollo Internacional (USAID).</li>
				<li>Un académico especialista en temas de gobierno abierto y/o desarrollo sostenible, quien fungirá como testigo del proceso de selección.</li>
			</ul>
			<p>Los candidatos seleccionados serán notificadas por vía electrónica y los resultados serán publicados en el sitio <a href="{{url('')}}">{{url('')}}</a>, a más tardar el 19 de mayo de 2017.</p>
			
			<p>Los trabajos de la primera edición del programa de formación de Agentes Locales de Cambio iniciarán en mayo de 2017, preferentemente, en el marco de la I Cumbre de Gobierno Abierto en lo Local. En este marco, se llevará a cabo la primera ronda de seminarios presenciales. En todo caso, el Comité Dictaminador decidirá sobre la fecha de inicio de los trabajos.</p>
			</div>
		</li>
		
		<li>
			<h3>Casos no previstos</h3>
			<span></span>
			<div class="panel">
				<p>Cualquier situación no prevista en esta convocatoria, será resuelta por el Comité Dictaminador.</p>
			</div>
		</li>
				
		<li>
			<h3>Contacto</h3>
			<span></span>
			<div class="panel">
				<p>Para mayor información con respecto a la presente convocatoria y al programa de formación de capacidades, favor de contactar a <strong>Mariana García</strong>, coordinadora del proyecto en los teléfonos (55) 4000-9819 o (55) 1079-3994, o al correo electrónico <a href="{{url('mailto:mariana.garcia@undp.org')}}">mariana.garcia@undp.org</a>. 
</p>
			</div>
		</li>
		</ol>
		
		</div>
		<div class="col-sm-8 col-sm-offset-2">
		<div class="notes">
		<p> <a id="note1"></a>
			<sup>1</sup> La realización de este programa es posible gracias al apoyo y financiamiento otorgado por USAID en el marco del proyecto: “Local Capacities in Open Government (OG) for the Achievement of the Sustainable Development Goals (SGDs) in Mexico /Programa de fortalecimiento de capacidades en gobierno abierto para el cumplimiento de los objetivos de desarrollo sostenible en lo local.”<br>
			 <a id="note2"></a>
			 <sup>2</sup> Los datos personales recabados, serán protegidos de acuerdo a lo establecido en el <a href="{{url('aviso-privacidad')}}">Aviso de Privacidad</a> de la Convocatoria al Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible Edición 2017, disponible en <a href="{{url('aviso-privacidad')}}">{{url('aviso-privacidad')}}</a> .<br> 
			  <a id="note3"></a>
			  <sup>3</sup> Letra Arial 12, interlineado doble, márgenes de 3 centímetros en todos los lados.<br>
			  <a id="note4"></a>
			  <sup>4</sup>El video puede realizarse con cualquier dispositivo (teléfono móvil, tableta o cámara digital), y deberá ser subido a la plataforma en línea http://www.youtube.com 
			
			
		</p>
		</div>
	</div>

</div>
@endsection