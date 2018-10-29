@extends('layouts.frontend.master')
@section('title', '¿Qué es Gobierno Abierto?')
@section('description', 'Definición de Gobierno Abierto, recursos y ejercicios locales.')
@section('body_class', 'abierto')
@section('canonical', url('gobierno-abierto') )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_gobiernoabierto')


@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>¿Qué es Gobierno <strong>Abierto</strong>?</h1>
		<p><strong>Gobierno Abierto</strong> es un enfoque que propone una forma particular de entender los procesos de gobierno, a partir de principios como los de la transparencia y la participación ciudadana. Esta perspectiva se ha construido en años recientes como consecuencia de al menos tres fenómenos observados: i) la globalización, en cuanto a que algunas dinámicas políticas nacionales –y locales- están condicionadas por factores que trascienden las fronteras de los Estados; ii) el reconocimiento, cada vez más recurrente, de que la gubernamental no es la única esfera legítima y capaz para definir y atender las necesidades crecientemente complejas de las comunidades; y iii) la búsqueda de mecanismos político-administrativos alternativos a los tradicionales que fortalezcan la legitimidad de los Estados, más allá de las elecciones. Estos tres fenómenos han llevado, consecuentemente, a una reflexión sobre el modo como debería reconfigurarse el quehacer público y gubernamental; esto es, el actual modelo de gobernanza.</p>
	<div class="row">
	<div class="col-sm-8">
		<p>De tal suerte, <strong>Gobierno Abierto</strong> como perspectiva surgió del reconocimiento de los problemas de legitimidad y capacidad que enfrentan los gobiernos para responder a las cada vez más numerosas, diversas y complejas de demandas sociales, en un contexto globalizado. En este escenario, las tendencias mundiales de reforma político-administrativa de los últimos años han apuntado hacia la incorporación de los ciudadanos y de organizaciones de la sociedad civil en los procesos de planeación, ejecución y evaluación de las actividades gubernamentales. Desde esta lógica, el ciudadano es parte la solución de los problemas públicos, y aquél se erige en un sujeto con pleno derecho para influir en la definición de la agenda y de las estrategias gubernamentales.</p>
		<p>En consonancia con lo anterior, el <strong>Gobierno Abierto</strong> como enfoque y propuesta de cambio del paradigma gubernativo es compatible con marcos teóricos y analíticos –como el de gobernanza- que ponen el acento en la conformación de escenarios de gobierno horizontales y con una presencial plural de actores (privados y sociales) en los procesos decisionales de la política pública, en un plano de coordinación. De igual manera, <strong>Gobierno Abierto</strong> es una perspectiva compatible con enfoques de corte gerencial que proponen una nueva forma de entender el quehacer público, a partir de la introducción en el sector público de nuevas actitudes y aptitudes que permitan incorporar efectivamente al ciudadano en la gestión pública. Desde estos enfoques gerenciales, el ciudadano es visto como una pieza fundamental en el desarrollo de esquemas que permiten una gestión dinámica y de calidad, orientados a la creación de valor público y de innovaciones constantes.</p>
		
		<p>Al conjugar estas dos perspectivas teóricas de las que <strong>Gobierno Abierto</strong> se nutre –gobernanza y enfoques gerenciales-, los gobiernos dejan de ser un conjunto de autoridades públicas unidas por un proyecto único, para transformarse en un espacio para la producción de decisiones y de cursos de acción, que no necesariamente está monopolizado por un conjunto limitado de actores políticos o burocráticos. En este sentido, Aguilar agrega que:</p>
		
		<blockquote>“Gobernar en contextos políticos plurales y autónomos, de alta intensidad ciudadana y con graves problemas sociales irresueltos, parece exigir dos requisitos fundamentales: gobernar por políticas y gobernar con sentido público. Las estrategias de gobierno homogéneas y globales, así como los estilos de gobierno secretos, excluyentes y clientelares, están previsiblemente condenadas en el futuro inmediato a la ineficacia administrativa, al castigo electoral y a la hostilidad política” (Aguilar, 1992: 30).</blockquote>
		
		<p>La búsqueda de mecanismos que incorporen la opinión y la decisión de distintas redes de actores en los procesos de decisión y gestión pública coadyuvan, se sugiere desde el <strong>Gobierno Abierto</strong>, a la generación de confianza entre gobernantes y gobernados. El modo particular de entender la gobernanza democrática desde el <strong>Gobierno Abierto</strong> permite, en términos prácticos, incorporar talento, creatividad, ideas y voluntad en la búsqueda de soluciones a los problemas públicos considerados como relevantes dentro de una comunidad política particular. En este ámbito, <strong>Gobierno Abierto</strong> abona a la reconstitución y al fortalecimiento de la legitimidad política de los Estados y de los regímenes democráticos.</p>
			
			
		<p><em>Fragmento extraído del <strong>Modelo de <strong>Gobierno Abierto</strong> del INAI y el SNT</strong>, disponible en: <a href="{{url('gobierno-abierto/recursos/modelo-gobierno-abierto')}}">Documento Teórico del Modelo de Gobierno Abierto</a></em>
		</p>
	</div>
		<div class="col-sm-4">
			<h2 class="center">Recursos</h2>
				<a href="{{url('gobierno-abierto/recursos/secretariado-tecnico-local')}}" class="icon i_crecursos">
					<span>RECURSOS PARA STL</span>
				</a>
				<a href="{{url('gobierno-abierto/recursos/lecturas')}}" class="icon i_lectura">
					<span>LECTURAS</span>
				</a>
				<a href="{{url('programa-gobierno-abierto/alcance')}}" class="icon i_alcance">
					<span>EJERCICIOS LOCALES</span>
				</a>
		</div>
	</div>
	</div>
</div>
@endsection