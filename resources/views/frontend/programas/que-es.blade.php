@extends('layouts.frontend.master')
@section('title', 'Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'programa')
@section('canonical', url('programa-gobierno-abierto'))
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_programa')

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>PROGRAMA DE FORMACIÓN DE <strong>AGENTES LOCALES DE CAMBIO</strong> EN <strong>GOBIERNO ABIERTO</strong> Y DESARROLLO SOSTENIBLE</h1>
		<p>El programa tiene como propósitos el fortalecimiento de capacidades, la vinculación y empoderamiento de una <strong>red de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</strong> que promuevan la consolidación de acciones orientadas a fortalecer prácticas de transparencia y participación ciudadana a nivel local en México.  </p>
		
		<p>Este programa ofrecerá una plataforma única para el aprendizaje, la reflexión, el intercambio de ideas y experiencias, así como para la realización de proyectos que puedan ponerse en marcha en el corto plazo, y que utilicen las perspectivas de gobierno abierto y desarrollo sostenible para transformar alguna realidad de su localidad o región.</p>
		<p>Al concluir la etapa formativa, se esperaría que los egresados se integren y participen activamente en los trabajos que se realizan en su entidad federativa en el marco de los ejercicios locales de Gobierno Abierto promovidos por el INAI.</p>
		<div class="row">
			<div class="col-sm-9">
				<h2>Perfil de Egreso </h2>
				<p>Al concluir la etapa formativa, se espera que los participantes:</p>
				<ul>
					<li>Cuenten con una formación sólida en temas de gobierno abierto y desarrollo sostenible que les permitirán incidir en debates y en el desarrollo de acciones innovadoras orientadas a resolver problemas puntuales de su localidad y región.				</li>
					<li>Formen parte de una red de líderes y expertos a través de la cual podrán intercambiar ideas y desarrollar proyectos en conjunto que permitan enfrentar retos de desarrollo de alcance local y regional, desde una perspectiva de apertura gubernamental.</li>
					<li>Sean capaces de elaborar proyectos colaborativos que generen soluciones concretas e innovadoras para atender problemas públicos con base en los principios de gobierno abierto. 																		</li>
					<li>Participen activamente en los ejercicios locales de gobierno abierto promovidos por el INAI en colaboración con los Secretariados Técnicos de cada una de las entidades federativas consideradas en esta convocatoria. 									</li>
					<li>Se conviertan en replicadores de las capacidades y habilidades adquiridas durante el programa en su contexto, y que permita la consolidación de la perspectiva de gobierno abierto a nivel local.</li>
				</ul>
			
				<h2>Metodología y Modalidad</h2>
				<p>Durante los siete meses de duración del programa, los contenidos y actividades se realizarán fundamentalmente en una plataforma en línea. Además, se tiene prevista la realización de dos rondas de seminarios y talleres presenciales – conducidos por expertos reconocidos en temas de Gobierno Abierto y Desarrollo Sostenible –a finales del mes de mayo y durante el mes de agosto en sedes por definir en la Ciudad de México y/o en algún estado de la República Mexicana. Para complementar su formación y desarrollar competencias blandas las y los participantes contarán con el acompañamiento de un mentor que contribuirá a la potencialización de los conocimientos y habilidades adquiridas a través de los demás mecanismos de formación del programa.</p>
				<p>Además de adquirir capacidades y de vincularse a la red de Agentes Locales de Cambio, se espera que los participantes elaboren y presenten al final de los siete meses un proyecto en equipo, concreto y factible que, a través del uso de las herramientas adquiridas durante el programa, enfrente un reto local de desarrollo por medio de la realización de acciones que promuevan la transparencia, la participación, la rendición de cuentas, y la innovación cívica y tecnológica. Aquellos participantes que cumplan satisfactoriamente con todos los requisitos académicos al concluir el programa, recibirán una constancia de participación.</p>
				
				<h2>Evaluación y Reconocimiento</h2>
				<p>El curso se desarrollará con la guía de los Coordinadores y mentores por medio de la Plataforma de Formación. Semanalmente se presentarán actividades y cuestionarios que serán calificados. Así mismo, el participante al cierre del curso presentará un proyecto en equipo, concreto y factible que, a través del uso de las herramientas adquiridas durante el programa, enfrente un reto local de desarrollo por medio de la realización de acciones que promuevan la transparencia, la participación, la rendición de cuentas, y la innovación cívica y tecnológica.</p>
				<p>La evaluación final se integrará de la siguiente manera:</p>
				<ul>
					<li>Actividades y ensayos 30%</li>
					<li>Cuestionarios de conocimientos 20%</li>
					<li>Proyecto final 50%</li>
				</ul>
A quienes acrediten el 80% de los puntos a evaluar serán acreedores a un reconocimiento que acredite su participación en el programa.

			</div>
			<div class="col-sm-3">
				<h2></h2>
				<a href="{{url('programa-gobierno-abierto/alcance')}}" class="icon i_alcance"><span>ALCANCE DEL PROGRAMA</span></a>
				<a href="{{url('programa-gobierno-abierto/aliados')}}" class="icon i_aliados">CONOCE A LOS ALIADOS</a>
				<a href="{{url('convocatoria')}}" class="icon i_convocatoria"><span>CONVOCATORIA</span></a>
			</div>

		</div>
		
		
	</div>
</div>
@endsection