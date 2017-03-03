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
		<p>El objetivo del proyecto es contribuir al fortalecimiento de una buena gobernanza en México a partir de prácticas de gobierno abierto, participación ciudadana, transparencia y anticorrupción. Durante los tres años de implementación de las estrategias, se buscará contribuir al cumplimiento de la agenda de prevención de la corrupción del Estado mexicano, así como de los Objetivos de Desarrollo Sostenible (ODS). </p>
		
		<p>Para alcanzar el objetivo, el componente se implementará en apoyo a las estrategias de gobierno abierto del INAI, con la colaboración de tres organizaciones de la sociedad civil (Gesoc, Gobierno Fácil, y ProSociedad Hacer Bien el Bien, A.C), que cuentan con experiencia en la implementación de prácticas de gobierno abierto y rendición de cuentas.</p>
		<div class="row">
			<div class="col-sm-9">
			<h2>Objetivo específico </h2>
			<p>El objetivo específico del componente es contribuir al ejercicio pleno de los derechos de las personas y abatir los factores de riesgo que propician la corrupción a nivel local, por medio de la puesta en marcha de esquemas innovadores de fortalecimiento de capacidades y de vinculación social que permitan el empoderamiento de agentes de cambio de gobierno abierto, así como del fortalecimiento de espacios de diálogo y co creación a nivel subnacional. Este objetivo se alcanzará a partir de la implementación de principios y prácticas de gobierno abierto que fortalezcan la participación de organizaciones de la sociedad civil (OSC), así como la creación de plataformas sociales que promuevan el compromiso cívico. De acuerdo con varias investigaciones, las prácticas de gobierno abierto proporcionan información para el diseño de políticas públicas, mejoran la provisión de los servicios, actúan como un enlace entre el gobierno y la ciudadanía mejorando la rendición de cuentas y fortalecen la democracia. </p>

			<p>La igualdad de género se considera un aspecto transversal del programa de fortalecimiento de capacidades de las y los agentes de cambio en gobierno abierto y desarrollo sostenible, así como en el diseño de los planes de acción. Asimismo, y como parte del proceso de institucionalización de los espacios locales de diálogo y co creación, se buscará integrar Secretariados Técnicos plurales que privilegien una membresía equitativa entre hombres y mujeres, y se procurará la paridad en el marco del fellowship que se describirá más adelante.</p>
			
			<p>Por último, dada la orientación última del proyecto al cumplimiento de los Objetivos de Desarrollo Sostenible, se espera que el diseño y puesta en marcha de Planes de Acción de gobierno abierto robustos y con metas ambiciosas abonen a la atención efectiva de grupos tradicionalmente excluidos en el ámbito local como mujeres, jóvenes, indígenas, personas con discapacidad, entre otros. </p>
			
			
			<h2>Producto #1. Programa de fortalecimiento de capacidades para agentes de cambio del gobierno abierto (fellowship)</h2>
			
			<h2>Producto #2. Plataforma en línea de vinculación, aprendizaje continuo, intercambio de experiencias y acción coordinada de los agentes de cambio formados en el fellowship.</h2>
				
			<h2>Producto #3. Fortalecimiento e institucionalización de espacios de diálogo y co-creación subnacional (Secretariados Técnicos)</h2>
				
			<h2>Producto #4. Planes de Acción de gobierno abierto locales robustos, diseñados a través de espacios institucionalizados de diálogo y co creación; y que se orientan a la resolución integral de problemas de desarrollo y corrupción</h2>
				
				
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