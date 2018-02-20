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







	<!-- NAVEGACIÓN DE EJEMPLO 
		/*
		 *
		 *
		 *
		-->

	<!-- LOS TABS PRINCIPALES -->
	<ul>
		<li><a href="#" class="main-tab active" data-container="ejercicio-local-content">Ejercicio local</a></li>
		<li><a href="#" class="main-tab" data-container="ficha-estatal-content">Ficha estatal</a></li>
		<li><a href="#" class="main-tab" data-container="objetivos-content">Objetivos de desarrollo</a></li>
		<li><a href="#" class="main-tab" data-container="indicadores-content">Indicadores</a></li>
	</ul>

	<div id="ejercicio-local-content" class="main-docker"> ejercicio local </div>

	<div id="ficha-estatal-content" class="main-docker" style="display: none">
		<!-- LOS TABS SECUNDARIOS -->
	  <ul>
	  	<li><a href="#" class="second-tab active" data-container="pobreza-content">1. pobreza</a></li>
	  	<li><a href="#" class="second-tab" data-container="salud-content">2. salud</a></li>
	  	<li><a href="#" class="second-tab" data-container="educacion-content">3. educación</a></li>
	  	<li><a href="#" class="second-tab" data-container="competitividad-content">4. competitividad</a></li>
	  	<li><a href="#" class="second-tab" data-container="genero-content">5. género</a></li>
	  	<li><a href="#" class="second-tab" data-container="gobierno-content">6. gobierno</a></li>
	  </ul>


	  <!-- EL CONTENIDO SECUNDARIO -->
	  <div class="second-docker" id="pobreza-content"> pobreza content </div>
	  <div class="second-docker" style="display: none" id="salud-content"> salud content </div>
	  <div class="second-docker" style="display: none" id="educacion-content"> educación content </div>
	  <div class="second-docker" style="display: none" id="competitividad-content"> competitividad content </div>
	  <div class="second-docker" style="display: none" id="genero-content"> género content </div>
	  <div class="second-docker" style="display: none" id="gobierno-content"> gobierno content </div>

	</div>

	<div id="objetivos-content" class="main-docker" style="display: none"> objetivos de desarrollo </div>

	<div id="indicadores-content" class="main-docker" style="display: none"> indicadores </div>



	
	<!-- TERMINA NAVEGACIÓN DE EJEMPLO -->















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
				<p>Población: <strong>@{{Format(val.value)}} habitantes</strong> <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
			</div>
			<div v-if="val.name == 'Porcentaje de poblacion femenina'">
				<p>Población Femenina: <strong>@{{val.value * 100}}</strong>% <span class="ap_nacional">@{{val.national * 100}} %</span> <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
			</div>
			<div v-if="val.name == 'Porcentaje de poblacion indigena'">
				<p>Población Indígena: <strong>@{{ FormatDe(val.value * 100)}}</strong>% <span class="ap_nacional">@{{FormatDe(val.national * 100)}} %</span> <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
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
				<p>Porcentaje de población en situación de pobreza: <strong>@{{ FormatDe(val.value * 100) }}</strong>% <span class="ap_nacional">@{{ FormatDe(val.national * 100) }} %</span> <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
			</div>
			<div v-if="val.name == 'Porcentaje de población en situación de pobreza extrema'">
				<p>Porcentaje de población en situación de pobreza extrema: <strong>@{{ FormatDe(val.value * 100) }}</strong>%  <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
			</div>
			<div v-if="val.name == 'Porcentaje de población en situación de pobreza moderada'">
				<p>Porcentaje de población en situación de pobreza moderada: <strong>@{{ FormatDe(val.value * 100) }}</strong>%  <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
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
				<p class="ap_icon esperanza">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
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
				<p class="ap_icon">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
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
				<p class="ap_icon infantil">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
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
				<p  class="ap_icon escolarizacion">Años promedio de escolarización <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
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
					<p class="ap_icon asistencia">@{{val.name}}: <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2"> 
					<p><strong>@{{val.value}}%</strong></p>
				</div>
				<div class="col-sm-2"> 
					<p><span class="ap_nacional block">@{{val.national}}%</span></p>
				</div>
			</div>
			<div v-if="val.name == 'Tasa de analfabetización (población de 15 y más años)'" class="row">
				<div class="col-sm-8">
					<p class="ap_icon analfabeta">@{{val.name}}: <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
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
					<p class="ap_icon i_emujer">@{{val.name}}: <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2"> 
					<p><strong>@{{val.value}}</strong></p>
				</div>
				
			</div>
			<div v-if="val.name == 'Tasa de analfabetización hombres (población de 15 y más años)'" class="row">
				<div class="col-sm-8">
					<p class="ap_icon i_ehombre">@{{val.name}}: <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
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
					<p class="ap_icon pib">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
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
					<p class="ap_icon pib">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
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
	
	<!--Género-->
	<div class="col-sm-10 col-sm-offset-1">
		<h2>Género</h2>
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		<div v-for="val in values">
			<div v-if="val.name == 'Tasa de prevalencia de violencia de pareja contra la mujer (total)'" class="row">  
				<div class="col-sm-6">
				<p>@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2"> 
					<p class="right"><strong>@{{FormatDe(val.value * 100)}}%</strong></p>
				</div>
				<div class="col-sm-2"> 
					<p><span class="ap_nacional block">@{{FormatDe(val.national*100)}}%</span></p>
				</div> 
			</div>
			<div v-if="val.name == 'Tasa de prevalencia de violencia de pareja contra la mujer (violencia emocional)'" class="row">
				<div class="col-sm-5">
				<p>@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2">
					<p class="right">@{{FormatDe(val.value * 100)}}%</p>
				</div>
				<div class="col-sm-5"> 
					<div class="ap_bar">
						<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
					</div>
				</div>
			</div>
			<div v-if="val.name == 'Tasa de prevalencia de violencia de pareja contra la mujer (violencia económica)'" class="row">
				<div class="col-sm-5">
					<p>@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2">
					<p class="right">@{{ FormatDe(val.value * 100)}}%</p>
				</div>
				<div class="col-sm-5"> 
					<div class="ap_bar">
						<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
					</div>
				</div>
			</div>
			<div v-if="val.name == 'Tasa de prevalencia de violencia de pareja contra la mujer (violencia física)'" class="row">
				<div class="col-sm-5">
					<p>@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2">
					<p class="right">@{{ FormatDe(val.value * 100)}}%</p>
				</div>
				<div class="col-sm-5"> 
					<div class="ap_bar">
						<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
					</div>
				</div>
			</div>
			<div v-if="val.name == 'Tasa de prevalencia de violencia de pareja contra la mujer (violencia sexual)'" class="row">
				<div class="col-sm-5">
					<p>@{{val.name}}: <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2">
					<p class="right">@{{ FormatDe(val.value * 100)}}%</p>
				</div>
				<div class="col-sm-5"> 
					<div class="ap_bar">
						<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	
	<!--Gobierno-->
	<div class="col-sm-10 col-sm-offset-1">
		<h2>Gobierno</h2>
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		<div class="row">
			<div v-for="val in values">
				<div v-if="val.name == 'Gobernador'">  
					<div class="col-sm-6">
						<h3>@{{val.value}}</h3>
						<p>@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
					</div>
				</div>
				<div v-if="val.name == 'Periodo de gobierno gobernador'">  
					<div class="col-sm-3">
						<p class="center"><strong>@{{val.value}}</strong></p>
					</div>
				</div>
				<div v-if="val.name == 'Partido o coalicion del gobernador'">  
					<div class="col-sm-3">
						<p class="center"><strong>@{{val.value}}</strong></p>
					</div>
				</div>
			</div>
		</div>
		
		<div v-for="val in values">
			<div v-if="val.name == 'Numero de diputados locales'">
				<p>@{{val.name}}: <strong>@{{Format(val.value)}}</strong> <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
			</div>
		</div>
	</div>
	
	
	<!--ODs-->
	<div class="col-sm-10 col-sm-offset-1">
		<h2>Objetivos de Desarrollo Sostenible</h2>
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		<div v-for="val in values" class="ods">
			
			<div v-if="val.name == 'Porcentaje de la poblacion con ingreso inferior a la línea de bienestar mínimo'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods1">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{ FormatDe(val.value * 100) }}%</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3">
						<p class="right"><span class="ap_nacional">@{{val.national * 100}}%</span></p>
					</div>
					<div class="col-sm-9">
						<div class="ap_bar national">
							<span  v-bind:style='"width:" + (val.national * 100)  + "%"'></span>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			<div v-if="val.name == 'Porcentaje de la poblacion con carencia por acceso a alimentacion'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods2">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{ FormatDe(val.value * 100)}}%</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3">
						<p class="right"><span class="ap_nacional">@{{val.national * 100}}%</span></p>
					</div>
					<div class="col-sm-9">
						<div class="ap_bar national">
							<span  v-bind:style='"width:" + (val.national * 100)  + "%"'></span>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			
			<div v-if="val.name == 'Porcentaje de la poblacion con acceso a servicios de salud'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods3">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{ FormatDe(val.value * 100) }}%</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3">
						<p class="right"><span class="ap_nacional">@{{FormatDe(val.national * 100)}}%</span></p>
					</div>
					<div class="col-sm-9">
						<div class="ap_bar national">
							<span  v-bind:style='"width:" + (val.national * 100)  + "%"'></span>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			<div v-if="val.name == 'Eficiencia terminal primaria'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods4">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{val.value}}%</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + val.value  + "%"'></span>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3">
						<p class="right"><span class="ap_nacional">@{{ val.national}}%</span></p>
					</div>
					<div class="col-sm-9">
						<div class="ap_bar national">
							<span  v-bind:style='"width:" + val.national   + "%"'></span>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			<div v-if="val.name == 'Eficiencia terminal secundaria'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods4">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{val.value}}%</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + val.value  + "%"'></span>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3">
						<p class="right"><span class="ap_nacional">@{{ val.national}}%</span></p>
					</div>
					<div class="col-sm-9">
						<div class="ap_bar national">
							<span  v-bind:style='"width:" + val.national   + "%"'></span>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			<div v-if="val.name == 'Porcentaje de presidentas municipales'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods5">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{ FormatDe(val.value * 100)}}%</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3">
						<p class="right"><span class="ap_nacional">@{{FormatDe(val.national * 100)}}%</span></p>
					</div>
					<div class="col-sm-9">
						<div class="ap_bar national">
							<span  v-bind:style='"width:" + (val.national * 100)  + "%"'></span>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			
			<div v-if="val.name == 'Tasa de participación economica de mujeres'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods5">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{val.value}}%</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + val.value  + "%"'></span>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3">
						<p class="right"><span class="ap_nacional">@{{ val.national}}%</span></p>
					</div>
					<div class="col-sm-9">
						<div class="ap_bar national">
							<span  v-bind:style='"width:" + val.national   + "%"'></span>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			
			<div v-if="val.name == 'Porcentaje de viviendas con acceso a red de agua potable'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods6">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{ FormatDe(val.value * 100) }}%</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3">
						<p class="right"><span class="ap_nacional">@{{FormatDe(val.national * 100)}}%</span></p>
					</div>
					<div class="col-sm-9">
						<div class="ap_bar national">
							<span  v-bind:style='"width:" + (val.national * 100)  + "%"'></span>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			
			<div v-if="val.name == 'Porcentaje de viviendas con acceso a electricidad'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods7">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{ FormatDe(val.value * 100)}}%</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3">
						<p class="right"><span class="ap_nacional">@{{FormatDe(val.national * 100)}}%</span></p>
					</div>
					<div class="col-sm-9">
						<div class="ap_bar national">
							<span  v-bind:style='"width:" + (val.national * 100)  + "%"'></span>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			<div v-if="val.name == 'Tasa de crecimiento del PIB per capita anual'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods8">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{val.value}}%</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + val.value  + "%"'></span>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3">
						<p class="right"><span class="ap_nacional">@{{ val.national}}%</span></p>
					</div>
					<div class="col-sm-9">
						<div class="ap_bar national">
							<span  v-bind:style='"width:" + val.national  + "%"'></span>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			
			<div v-if="val.name == 'Porcentaje de viviendas que cuentan con internet'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods9">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{ FormatDe(val.value * 100)}}%</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3">
						<p class="right"><span class="ap_nacional">@{{FormatDe(val.national * 100)}}%</span></p>
					</div>
					<div class="col-sm-9">
						<div class="ap_bar national">
							<span  v-bind:style='"width:" + (val.national * 100)  + "%"'></span>
						</div>
					</div>
					</div>
				</div>
			</div>
			

			
			<div v-if="val.name == 'Indice de Gini'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods11">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{ val.value }}</p>
					</div>
					<div class="col-sm-9"> 
						<?php /*
						<div class="ap_bar">
							<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
						</div> */?>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3">
						<p class="right"><span class="ap_nacional">@{{ val.national}}</span></p>
					</div>
					<div class="col-sm-9">
						<?php /*
						<div class="ap_bar national">
							<span  v-bind:style='"width:" + (val.national * 100)  + "%"'></span>
						</div> */?>
					</div>
					</div>
				</div>
			</div>
			
			
			<div v-if="val.name == 'Porcentaje de viviendas que separan sus residuos'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods12">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{ FormatDe(val.value * 100) }}%</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3">
						<p class="right"><span class="ap_nacional">@{{FormatDe(val.national * 100)}}%</span></p>
					</div>
					<div class="col-sm-9">
						<div class="ap_bar national">
							<span  v-bind:style='"width:" + (val.national * 100)  + "%"'></span>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			<div v-if="val.name == 'Declaratorias de emergencia'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods13">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
						<div class="col-sm-3">
							<p class="right"><strong>@{{val.value}}</strong></p>
						</div>
					</div>
				</div>
			</div>
			
			
			<div v-if="val.name == 'Declaratorias de desastre natural'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods13">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
						<div class="col-sm-3">
							<p class="right"><strong>@{{val.value}}</strong></p>
						</div>
					</div>
				</div>
			</div>
			
			<div v-if="val.name == 'Porcentaje de superficie estatal cubierta por regiones terrestres prioritarias'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods15">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{ FormatDe(val.value * 100) }}%</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3">
						<p class="right"><span class="ap_nacional">@{{FormatDe(val.national * 100)}}%</span></p>
					</div>
					<div class="col-sm-9">
						<div class="ap_bar national">
							<span  v-bind:style='"width:" + (val.national * 100)  + "%"'></span>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			
			<div v-if="val.name == 'Tasa de homicidios dolosos (por 100 mil habitantes)'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods16">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{val.value}}%</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + val.value  + "%"'></span>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3">
						<p class="right"><span class="ap_nacional">@{{ val.national}}%</span></p>
					</div>
					<div class="col-sm-9">
						<div class="ap_bar national">
							<span  v-bind:style='"width:" + val.national   + "%"'></span>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			<div v-if="val.name == 'Tasa de Incidencia de Corrupción'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods16">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{Format(val.value)}}</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + (val.value * 100) / 70000 + "%"'></span>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3">
						<p class="right"><span class="ap_nacional">@{{ Format(val.national) }}</span></p>
					</div>
					<div class="col-sm-9">
						<div class="ap_bar national">
							<span  v-bind:style='"width:" + (val.national * 100) / 70000   + "%"'></span>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			<div v-if="val.name == 'Ingresos propios como proporcion del PIB'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods17">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{ FormatDe(val.value * 100) }}%</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			<div v-if="val.name == 'Dependencia de aportaciones federales'" class="row">
				<div class="col-sm-5">
					<p class="ap_icon im_ods i_ods17">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{ FormatDe(val.value * 100) }}%</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
						</div>
					</div>
					</div>
					
				</div>
			</div>
			
		</div>
	</div>
	
	
	<!--Indice de Gobierno Abierto 2017-->
	<div class="col-sm-10 col-sm-offset-1">
		<h2>Indice de Gobierno Abierto 2017</h2>
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		<div v-for="val in values" class="iga">
			
			<div v-if="val.name == 'Indice de Gobierno Abierto 2017'" class="row">
				<div class="col-sm-5">
					<p>@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{ FormatDe(val.value * 100) }}%</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3">
						<p class="right"><span class="ap_nacional">@{{val.national * 100}}%</span></p>
					</div>
					<div class="col-sm-9">
						<div class="ap_bar national">
							<span  v-bind:style='"width:" + (val.national * 100)  + "%"'></span>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			<div v-if="val.name == 'Subindice de Transparencia 2017'" class="row">
				<div class="col-sm-5">
					<p>@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{ FormatDe(val.value * 100) }}%</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3">
						<p class="right"><span class="ap_nacional">@{{val.national * 100}}%</span></p>
					</div>
					<div class="col-sm-9">
						<div class="ap_bar national">
							<span  v-bind:style='"width:" + (val.national * 100)  + "%"'></span>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			<div v-if="val.name == 'Subindice de Participacion 2017'" class="row">
				<div class="col-sm-5">
					<p>@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-7">
					<div class="row">
					<div class="col-sm-3">
						<p class="right">@{{ FormatDe(val.value * 100) }}%</p>
					</div>
					<div class="col-sm-9"> 
						<div class="ap_bar">
							<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3">
						<p class="right"><span class="ap_nacional">@{{ FormatDe(val.national * 100)}}%</span></p>
					</div>
					<div class="col-sm-9">
						<div class="ap_bar national">
							<span  v-bind:style='"width:" + (val.national * 100)  + "%"'></span>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			
		</div>
	</div>
	
	
	<!--IDES 2017 - GESOC-->
	<div class="col-sm-10 col-sm-offset-1">
		<h2>IDES 2017 - GESOC</h2>
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		<div v-for="val in values" class="ides">
			<div v-if="val.name == 'Posicion (Rank) de la entidad federativa en el Indice Estatal de Capacidades para el Desarrollo Social'" class="row">
				<div class="col-sm-5">
					<p>@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2"> 
					<p class="right"><strong>@{{val.value}}</strong></p>
				</div>
			</div>
			<div v-if="val.name == 'Calificacion de la entidad federativa en el Indice Estatal de Capacidades para el Desarrollo Social'" class="row">
				<div class="col-sm-5">
					<p>@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2"> 
					<p class="right"><strong>@{{val.value}}</strong></p>
				</div>
			</div>
			<div v-if="val.name == 'Nivel de capacidad institucional para la implementacion de la politica social estatal'" class="row">
				<div class="col-sm-5">
					<p>@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2"> 
					<p class="right"><strong>@{{val.value}}</strong></p>
				</div>
			</div>
			<div v-if="val.name == 'Porcentaje de cumplimiento de la categoria Planeacion Programatica Presupuestal'" class="row">
				<div class="col-sm-5">
					<p>@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2"> 
					<p class="right"><strong>@{{ FormatDe(val.value * 100) }}%</strong></p>
				</div>
				<div class="col-sm-5">
					<div class="ap_bar">
						<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
					</div>
				</div>
			</div>
			<div v-if="val.name == 'Porcentaje de cumplimiento de la categoria Gestion Eficiente'" class="row">
				<div class="col-sm-5">
					<p>@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2"> 
					<p class="right"><strong>@{{ FormatDe(val.value * 100) }}%</strong></p>
				</div>
				<div class="col-sm-5">
					<div class="ap_bar">
						<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
					</div>
				</div>							 
			</div>
			<div v-if="val.name == 'Porcentaje de cumplimiento de la categoria Monitoreo y Evaluacion'" class="row">
				<div class="col-sm-5">
					<p>@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2"> 
					<p class="right"><strong>@{{ FormatDe(val.value * 100) }}%</strong></p>
				</div>
				<div class="col-sm-5">
					<div class="ap_bar">
						<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
					</div>
				</div>
			</div>
			<div v-if="val.name == 'Porcentaje de cumplimiento de la categoria Apertura y Participacion Ciudadana'" class="row">
				<div class="col-sm-5">
					<p>@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
				</div>
				<div class="col-sm-2"> 
					<p class="right"><strong>@{{ FormatDe(val.value * 100) }}%</strong></p>
				</div>
				<div class="col-sm-5">
					<div class="ap_bar">
						<span  v-bind:style='"width:" + (val.value * 100)  + "%"'></span>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	
	
	
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
	<?php /**/?>
</div>

@endsection

@section('js-content')
<script src="{{ url('js/bower_components/underscore/underscore-min.js') }}"></script>
<script src="{{ url('js/bower_components/d3/d3.min.js') }}"></script>
<script src="{{ url('js/vue.min.js') }}"></script>
<script src="{{ url('js/indicadores/main.js')}}"></script>
<script>
  var Format         = d3.format(",2");
  var FormatDe       = d3.format(",.2f");
  </script>
@endsection