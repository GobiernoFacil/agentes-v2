@extends('layouts.frontend.master')
@section('title', 'Campeche, ejercicio local de Gobierno Abierto')
@section('description', 'El 20 de junio de 2016, el estado de Campeche se integró formalmente a los Ejercicios Locales de Gobierno Abierto a través de la firma de la Declaración Conjunta para la Implementación de las Acciones para un Gobierno Abierto')
@section('body_class', 'programa alcance campeche')
@section('canonical', url('programa-gobierno-abierto/alcance/campeche') )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_programa')

@section('content')
<form>
		<p><select id="card-selector-app-select"></select></p>
	</form>
<div id="card-selector-app-container">
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>@{{ state }}</h1>
	</div>
	<div class="col-sm-6 col-sm-offset-6">
		<div v-for="val in values">
			<div v-if="val.name == 'Capital de la entidad federativa'">
				<p>Capital: <strong>@{{val.value}}</strong> <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
			</div>
			<div v-if="val.name == 'Poblacion total'">
				<p>Población: <strong>@{{val.value}} habitantes</strong> <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
			</div>
			<div v-if="val.name == 'Porcentaje de poblacion femenina'">
				<p>Población Femenina: <strong>@{{val.value * 100}}</strong>% <span class="ap_nacional">@{{val.national * 100}} %</span> <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
			</div>
			<div v-if="val.name == 'Porcentaje de poblacion indigena'">
				<p>Población Indígena: <strong>@{{val.value * 100}}</strong>% <span class="ap_nacional">@{{val.national * 100}} %</span> <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
			</div>
			
		</div>
	</div>
	<!--pobreza-->
	<div class="col-sm-10 col-sm-offset-1">
		<h2>Pobreza</h2>
	</div>
	<div class="col-sm-6 col-sm-offset-6">
		<div v-for="val in values">
			<div v-if="val.name == 'Porcentaje de poblacion en situacion de pobreza'">
				<p>Porcentaje de población en situación de pobreza: <strong>@{{val.value * 100}}</strong>% <span class="ap_nacional">@{{val.national * 100}} %</span> <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
			</div>
			<div v-if="val.name == 'Porcentaje de población en situación de pobreza extrema'">
				<p>Porcentaje de población en situación de pobreza extrema: <strong>@{{val.value * 100}}</strong>%  <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
			</div>
			<div v-if="val.name == 'Porcentaje de población en situación de pobreza moderada'">
				<p>Porcentaje de población en situación de pobreza moderada: <strong>@{{val.value * 100}}</strong>%  <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
			</div>
			
		</div>
	</div>
	
	<!--Salud-->
	<div class="col-sm-10 col-sm-offset-1">
		<h2>Salud</h2>
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		<div v-for="val in values">
			<div v-if="val.name == 'Esperanza de vida (años)'" class="row">
				<div class="col-sm-8">
				<p>Esperanza de vida (años) <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2"> 
					<p><strong>@{{val.value}}</strong></p>
				</div>
				<div class="col-sm-2"> 
					<p><span class="ap_nacional block">@{{val.national}}</span></p>
				</div> 
			</div>
			<div v-if="val.name == 'Razón de mortalidad materna (por cada 100 mil nacidos vivos)'" class="row">
				<div class="col-sm-8">
				<p>Razón de mortalidad materna (por cada 100 mil nacidos vivos): <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2"> 
					<p><strong>@{{val.value}}</strong></p>
				</div>
				<div class="col-sm-2"> 
					<p><span class="ap_nacional block">@{{val.national}}</span></p>
				</div>
			</div>
			<div v-if="val.name == 'Tasa de mortalidad infantil (por cada mil nacidos vivos)'" class="row">
				<div class="col-sm-8">
				<p>Tasa de mortalidad infantil (por cada mil nacidos vivos): <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2"> 
					<p><strong>@{{val.value}}</strong></p>
				</div>
				<div class="col-sm-2"> 
					<p><span class="ap_nacional block">@{{val.national}}</span></p>
				</div>
			</div>
		</div>
	</div>
	
	
	<!--Educación-->
	<div class="col-sm-10 col-sm-offset-1">
		<h2>Educación</h2>
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		<div v-for="val in values">
			<div v-if="val.name == 'Años promedio de escolarización'" class="row">
				<div class="col-sm-8">
				<p>Años promedio de escolarización <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2"> 
					<p><strong>@{{val.value}}</strong></p>
				</div>
				<div class="col-sm-2"> 
					<p><span class="ap_nacional block">@{{val.national}}</span></p>
				</div> 
			</div>
			<div v-if="val.name == 'Asistencia escolar (población de 6 a 12 años)'" class="row">
				<div class="col-sm-8">
				<p>Asistencia escolar (población de 6 a 12 años): <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2"> 
					<p><strong>@{{val.value}}</strong></p>
				</div>
				<div class="col-sm-2"> 
					<p><span class="ap_nacional block">@{{val.national}}</span></p>
				</div>
			</div>
			<div v-if="val.name == 'Tasa de analfabetización (población de 15 y más años)'" class="row">
				<div class="col-sm-8">
				<p>Tasa de analfabetización (población de 15 y más años): <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2"> 
					<p><strong>@{{val.value}}</strong></p>
				</div>
				<div class="col-sm-2"> 
					<p><span class="ap_nacional block">@{{val.national}}</span></p>
				</div>
			</div>
			<div v-if="val.name == 'Tasa de analfabetización mujeres (población de 15 y más años)'" class="row">
				<div class="col-sm-8">
				<p>Tasa de analfabetización mujeres (población de 15 y más años): <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2"> 
					<p><strong>@{{val.value}}</strong></p>
				</div>
				
			</div>
			<div v-if="val.name == 'Tasa de analfabetización hombres (población de 15 y más años)'" class="row">
				<div class="col-sm-8">
				<p>Tasa de analfabetización hombres (población de 15 y más años): <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2"> 
					<p><strong>@{{val.value}}</strong></p>
				</div>
				
			</div>
		</div>
	</div>
	
	<!--Competitividad-->
	<div class="col-sm-10 col-sm-offset-1">
		<h2>Competitividad</h2>
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		<div v-for="val in values">
			<div v-if="val.name == 'Producto Interno Bruto Estatal (millones de pesos a precios de 2013)'" class="row">
				<div class="col-sm-6">
				<p>Producto Interno Bruto Estatal (millones de pesos a precios de 2013) <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-3"> 
					<p class="right"><strong>@{{Format(val.value)}}</strong></p>
				</div>
				<div class="col-sm-3"> 
					<p><span class="ap_nacional block">@{{Format(val.national)}}</span></p>
				</div> 
			</div>
			<div v-if="val.name == 'PIBE per cápita (pesos a precios de 2013)'" class="row">
				<div class="col-sm-6">
				<p>PIBE per cápita (pesos a precios de 2013): <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-3"> 
					<p class="right"><strong>@{{Format(val.value)}}</strong></p>
				</div>
				<div class="col-sm-3"> 
					<p><span class="ap_nacional block">@{{Format(val.national)}}</span></p>
				</div>
			</div>
			<div v-if="val.name == 'Crecimiento (variación real)'" class="row">
				<div class="col-sm-6">
				<p>Crecimiento (variación real): <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-3"> 
					<p class="right"><strong>@{{val.value}}</strong></p>
				</div>
				<div class="col-sm-3"> 
					<p><span class="ap_nacional block">@{{val.national}}</span></p>
				</div>
			</div>
			<div v-if="val.name == 'Tasa de desocupación'" class="row">
				<div class="col-sm-6">
				<p>Tasa de desocupación: <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-3"> 
					<p class="right"><strong>@{{val.value}}</strong></p>
				</div>
				<div class="col-sm-3"> 
					<p><span class="ap_nacional block">@{{val.national}}</span></p>
				</div>
			</div>
			<div v-if="val.name == 'Tasa de informalidad laboral'" class="row">
				<div class="col-sm-6">
				<p>Tasa de informalidad laboral: <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-3"> 
					<p class="right"><strong>@{{val.value}}</strong></p>
				</div>
				<div class="col-sm-3"> 
					<p><span class="ap_nacional block">@{{val.national}}</span></p>
				</div>
			</div>
		</div>
	</div>
	<?php /*
	<div class="col-sm-10 col-sm-offset-1">
		<h1><strong>Campeche</strong>, ejercicio local de gobierno abierto</h1>
		<h2>¿Quiénes conforman el ejercicio?</h2>
		<p>El Secretariado Técnico Local (STL), está conformado por: </p>
		<ul>
			<li>
				<h3>2 representantes de la <strong>Sociedad Civil</strong></h3>				 
				<ol>
					<li>Visión de Mujer, Misión de Vida, A.C.</li>
					<li>Creadores de Arte Popular del Estado de Campeche, A.C.</li>
				</ol>
			</li>
			<li><h3>2 representantes del Gobierno								 </h3>
				<ol>
					<li>Secretaría de Administración e Innovación Gubernamental.</li>
					<li>Subsecretaría de Asuntos Jurídicos y Derechos Humanos.</li>
				</ol>
			</li>
			<li><h3>2 representantes del Órgano Garante de Acceso a la Información</h3>
				<ol>
					<li>Comisión de Transparencia y Acceso a la Información Pública del Estado de Campeche.</li>
				</ol>
			</li>
		</ul>
		
		<h3>Facilitador:</h3>
		<p>Mtro. Andrés Hofmann Furth – Consultor especializado en Gobierno Abierto.</p>
		<!---contexto-->
		<h2>Contexto</h2>
			<p>El 20 de junio de 2016, el estado de Campeche se integró formalmente a los Ejercicios Locales de Gobierno Abierto a través de la firma de la <a href="http://inicio.ifai.org.mx/doc/DGGAT/LGTAP70XLVIIID/FirmaDeclaratoriaCampechereu.pdf">Declaración Conjunta para la Implementación de Acciones para un Gobierno Abierto</a>.</p>
			<p>En esta Declaración, firmada por un representante del Gobierno del Estado, un representante de la sociedad civil y el Organismo Garante de Acceso a la Información y Protección de Datos Personales en la entidad, Campeche se comprometió a establecer actividades y trabajos encaminados a consolidar y expandir la apertura institucional y la participación ciudadana.</p> 
			<p>Luego de la firma de la Declaración Conjunta, en Campeche se impartió una sesión de sensibilización con organizaciones de la sociedad civil y público en general, donde se informó y socializó el ejercicio Gobierno Abierto “Co-creación desde lo Local” y se capacitó a servidores públicos que mostraron interés hacia el proyecto.</p>
			<p>Posteriormente, el 31 de agosto de 2016 se instaló el Secretariado Técnico en la entidad, mismo que coordinó la celebración de mesas de trabajo durante los meses de diciembre de 2016 y enero de 2017, en las cuales intervinieron representantes de la sociedad civil, autoridades gubernamentales y el propio Organismo Garante.</p>
			<p>Este proceso dio como resultado que el 19 de septiembre de 2017 se publicara el <a href="http://inicio.ifai.org.mx/Ms_Transparencia/PracticasExitosas/Nacionales/campeche/PAL%2520GobiernoAbierto%2520V.imprenta.pdf">Plan de Acción Local</a>. El documento está integrado por 6 compromisos puntuales, realizables, relevantes y medibles, con duración de un año:</p>
			<ul>
				<li><strong>Compromiso 1:</strong> Seguimiento ciudadano a la obra pública en el Estado de Campeche.																								 </li>
				<li><strong>Compromiso 2:</strong> Difundir y consolidar el portal y aplicación móvil de preinscripciones escolares en línea en los niveles básicos de educación.								 </li>
				<li><strong>Compromiso 3:</strong> Consolidar el portal de calificaciones y aplicación móvil como las principales herramientas tecnológicas en los niveles básicos de educación.					 </li>
				<li><strong>Compromiso 4:</strong> El fortalecimiento de la pesquería de pulpo en el estado mediante un proyecto estratégico orientado a integrar a los actores de la cadena productiva del pulpo.</li>
				<li><strong>Compromiso 5:</strong> Desarrollar una aplicación móvil para el reporte de fallas en los servicios públicos de Ciudad del Carmen.													 </li>
				<li><strong>Compromiso 6:</strong> Implementar un Programa de Educación Ambiental para el Saneamiento de la Bahía de San Francisco de Campeche.													 </li>
			</ul>
		<h2>Estatus</h2>
		<p>En proceso de implementación del primer plan de acción.</p>

	</div>
</div>
*/?>

	<div class="col-sm-10 col-sm-offset-1">
		<ul>
			<li v-for="val in values">
				<p>nombre: @{{val.name}}</p>
				<p>fuente: @{{val.source}}</p>
				<p>año: @{{val.year}}</p>
				<p>valor: @{{val.value}}</p>
				<p>valor nacional: @{{val.national}}</p>
				
			</li>
		</ul>
	</div>
</div>
</div>

@endsection

@section('js-content')
<script src="{{ url('js/bower_components/underscore/underscore-min.js') }}"></script>
<script src="{{ url('js/bower_components/d3/d3.min.js') }}"></script>
<script src="{{ url('js/vue.min.js') }}"></script>
<script src="{{ url('js/indicadores/main.js')}}"></script>
<script>
  var Format         = d3.format(",");
  </script>
@endsection