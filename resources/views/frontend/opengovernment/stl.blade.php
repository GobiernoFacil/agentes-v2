@extends('layouts.frontend.master')
@section('title', 'Lecturas sobre Gobierno Abierto')
@section('description', 'Lecturas sobre Gobierno Abierto')
@section('body_class', 'abierto lecturas')
@section('canonical', url('gobierno-abierto/recursos/lecturas') )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_gobiernoabierto')


@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>Recursos para <strong>Secretariado Técnico Local</strong></h1>
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		<ol>
			<li><h2><a href="{{ url('archivos/kits-gobierno-abierto/KIT-00_Presentacion-ToolkitsdeGobiernoAbiertoyDesarrolloSostenible.pdf') }}">Presentación de la caja de herramientas para el Gobierno Abierto y el Desarrollo Sostenible</a> </h2>	 
			<p>Los ToolKits abarcan una serie de temáticas que van desde la construcción de compromisos de Gobierno Abierto, pasando por la elaboración de planes estratégicos, hasta la construcción de indicadores con un enfoque de Desarrollo Sostenible.</p>
			</li>
			
			<li><h2><a href="{{ url('archivos/kits-gobierno-abierto/KIT-01_PNUD-ST-ConocermassobreGA.pdf') }}">Kit 1. Conocer más sobre el Gobierno Abierto y su importancia para la gobernanza democrática</a> </h2>	 
			<p>Tiene la intención de proporcionar conocimientos básicos sobre el Gobierno Abierto y para la comprensión de su papel en el logro de sociedades más democráticas. En este sentido, con este kit se pretende, por un lado, que los miembros de un STL estén familiarizados con los conceptos básicos de esta agenda y, por otro, que cuentan con un documento de base para sensibilizar a otros actores sobre el tema.</p>
			</li>
			
			<li><h2><a href="{{ url('archivos/kits-gobierno-abierto/KIT-02_PNUD-ST-Promoverlapluralidadylaparticipacion.pdf') }}">Kit 2. Promover la pluralidad y la participación de la sociedad civil</a> </h2>	 
			<p>Se dirige principalmente a integrar y consolidar el núcleo de sociedad civil de los STL. Para esto, se comparten algunos conceptos
fundamentales sobre la participación pública y se señalan algunas de las habilidades necesarias para impulsarla. De igual modo, se presentan algunas herramientas específicas que pueden ser de ayuda para generar procesos participativos y con ello hacer más sólido el núcleo de sociedad civil.</p>
			</li>
			
			<li><h2><a href="{{ url('archivos/kits-gobierno-abierto/KIT-03_PNUD-ST-Trabajarenespaciosmultiactor.pdf') }}">Kit 3. Trabajar en espacios multiactor insertos en contextos inestables</a> </h2>	 
			<p>Se construyó con el objetivo de proporcionar los elementos necesarios para poner en marcha el diálogo democrático. De este modo, se busca que los miembros puedan consolidar el STL como un auténtico espacio de participación y cocreación que además sea capaz de lidiar con las situaciones que lo pongan en riesgo.</p>
			</li>
			
			<li><h2><a href="{{ url('archivos/kits-gobierno-abierto/KIT-04_PNUD-ST-Elaborarunplanestrategico.pdf') }}">Kit 4. Elaborar un plan estratégico e implementación de mecanismos de gestión</a> </h2>	 
			<p>Se enfoca principalmente a la consolidación del STL en términos organizativos y operativos. Para esto se proporcionan los elementos básicos para que el espacio logre formular con claridad sus fines y la forma de alcanzarlos.</p>
			</li>
			
			<li><h2><a href="{{ url('archivos/kits-gobierno-abierto/KIT-05_PNUD-ST-Definircompromisosdemaneraparticipativa.pdf') }}">Kit 5. Definir compromisos de manera participativa</a> </h2>	 
			<p>Es un complemento del Kit 2, y se enfoca concretamente hacia la construcción de los compromisos del Plan de Acción Local. En este sentido, se
busca proporcionar las bases para que las propuestas hechas por el STL sean construidas bajo los principios del Gobierno Abierto, principalmente, el de la participación, y en términos amplios, bajo criterios democráticos.</p>
			</li>
			
			<li><h2><a href="{{ url('archivos/kits-gobierno-abierto/KIT-06_PNUD-ST-ConstruircompromisosdeDesarrolloSostenible.pdf') }}">Kit 6. Construir compromisos de Desarrollo Sostenible y propuestas efectivas de solución a problemas públicos</a> </h2>	 
			<p>Tiene la finalidad de proporcionar algunos elementos metodológicos para que los compromisos elaborados por el STL apunten a la solución efectiva de los problemas públicos identificados y además integren la perspectiva de la Agenda 2030 para el Desarrollo Sostenible. En este sentido, se presentan los conceptos básicos para el diagnóstico y solución de problemas públicos, y el modo en que las propuestas del STL pueden aportar al cumplimiento de los Objetivos de Desarrollo Sostenible (ODS).</p>
			</li>
			
			<li><h2><a href="{{ url('archivos/kits-gobierno-abierto/KIT-07_PNUD-ST-ColocarelGA.pdf') }}">Kit 7. Colocar el Gobierno Abierto y los compromisos en la agenda de instituciones y funcionarios clave</a> </h2>	 
			<p>Fue creado con la intención de proporcionar al STL elementos que les puedan ayudar a la sensibilización entre autoridades y funcionarios clave sobre la agenda de Gobierno Abierto y los ODS, así como para impulsar los compromisos que elaboren. De este modo, se presentan los principales aspectos a tomar en cuenta para acercarse de manera estratégica a los actores clave y decisivos que podrían impulsar las propuestas del STL.</p>
			</li>
			
			<li><h2><a href="{{ url('archivos/kits-gobierno-abierto/KIT-08_PNUD-ST-Implementacionevaluacionyseguimientodecompromisos.pdf') }}">Kit 8. Implementación, seguimiento y evaluación de compromisos</a> </h2>	 
			<p>Tiene como objetivo proporcionar los elementos metodológicos básicos para la puesta en marcha de las propuestas del STL, así como para monitorearlas e identificar si efectivamente lograron solucionar el problema público identificado. Para esto, se comparten algunos aspectos fundamentales para definir actividades concretas y los indicadores que le permitirán al STL dar seguimiento a su realización e identificar los cambios que se van produciendo a partir de las mismas</p>
			</li>
			
			
		</ol>
	</div>
</div>
@endsection