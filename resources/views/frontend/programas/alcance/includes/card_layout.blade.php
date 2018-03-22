<div id="card-selector-app-container">
	
	
	<div class="row">
		<div class="col-sm-12">
			<h1 class="ap_title"><strong>@{{ state }}</strong></h1>
		</div>
		<div class="col-sm-6">
			<div class="ap_map">
				<div>
				@include('layouts.mapas.mapa-mexico')
				</div>
			</div>
		</div>
		<div class="col-sm-5">
			<div v-for="val in values">
				<div v-if="val.name == 'Capital de la entidad federativa'">
					<p>Capital: <strong>@{{val.value}}</strong></p>
				</div>
				<div v-if="val.name == 'Poblacion total'">
					<p>Población: <strong>@{{Format(val.value)}} habitantes</strong> </p>
				</div>
			</div>
			<div v-for="val in values">
				<div v-if="val.name == 'Indice de Gobierno Abierto 2017'">
					<p>Indice de Gobierno Abierto 2017 <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
					<div class="row">
						<div class="col-sm-10">
						<div class="row">
						<div class="col-sm-3">
							<p class="right">@{{ FormatDe(val.value * 100) }}%</p>
						</div>
						<div class="col-sm-9 ides"> 
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
				</div>
				<div v-if="val.name == 'Tasa de Incidencia de Corrupción'">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-2">
							<p class="ap_icon im_ods i_ods16"> @{{val.name}}<span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
						</div>
					
						<div class="col-sm-10">
						<div class="row">
						<div class="col-sm-3">
							<p class="right">@{{Format(val.value)}}</p>
						</div>
						<div class="col-sm-9 ides"> 
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
					<p class="ap_info"><b></b> Nacional</p>
				</div>
					
			</div>
		</div>
	</div>



	<!-- NAVEGACIÓN -->
	<div class="row">
		<div class="col-sm-12">
			<!-- LOS TABS PRINCIPALES -->
			<ul class="ap_alcance">
				<li><a href="#" class="main-tab active" data-container="ficha-estatal-content">Ficha estatal</a></li>
				<li><a href="#" class="main-tab" data-container="objetivos-content">Objetivos de Desarrollo Sostenible</a></li>
				<li><a href="#" class="main-tab" data-container="ejercicio-local-content">Ejercicio Local de Gobierno Abierto</a></li>
				<li><a href="#" class="main-tab" data-container="indicadores-content">Métrica de Gobierno Abierto</a></li>
				<li><a href="#" class="main-tab" data-container="ides-content">IDES</a></li>
			</ul>
		</div>
	</div>
	<!-- TERMINA NAVEGACIÓN -->
	
<div class="row">	
	
	<div id="ficha-estatal-content" class="main-docker">
		<!-- LOS TABS SECUNDARIOS -->
		<div class="col-sm-10 col-sm-offset-1">
			<ul class="ap_alcance_ficha">
			  <li><a href="#" class="second-tab active" data-container="pobreza-content">1. pobreza</a></li>
			  <li><a href="#" class="second-tab" data-container="salud-content">2. salud</a></li>
			  <li><a href="#" class="second-tab" data-container="educacion-content">3. educación</a></li>
			  <li><a href="#" class="second-tab" data-container="competitividad-content">4. competitividad</a></li>
			  <li><a href="#" class="second-tab" data-container="genero-content">5. género</a></li>
			  <li><a href="#" class="second-tab" data-container="gobierno-content">6. gobierno</a></li>
			</ul>
		</div>

	  <!-- ficha-estatal-content -->
	  <div class="second-docker" id="pobreza-content">
	    <!--pobreza-->
		<div class="col-sm-10 col-sm-offset-1">
			<h2>Pobreza</h2>
		</div>
		<div class="col-sm-4 col-sm-offset-1">
			<svg id="pie-chart" width="200" height="200"></svg>
			<svg id="stack-chart" width="200" height="400"></svg>
		</div>
		<div class="col-sm-6">
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
			<p class="ap_info"><b></b> Nacional</p>
		</div>
	    
	  </div>
	  <!--Salud-->
	  <div class="second-docker" style="display: none" id="salud-content"> 
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
		  	 <p class="ap_info"><b></b> Nacional</p>
		  </div>		  
	  </div>
	  <!--Educación-->
	  <div class="second-docker" style="display: none" id="educacion-content">
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
		  	 <p class="ap_info"><b></b> Nacional</p>
	  	</div>	  
	  </div>
	  <!--Competitividad-->
	  <div class="second-docker" style="display: none" id="competitividad-content">
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
	  				<p>PIB per cápita (pesos a precios de 2013): <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
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
	  					<p class="ap_icon tasa">@{{val.name}} <span class="ap_source">Fuente: @{{val.source}}, @{{val.year}}</span></p>
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
		  	 <p class="ap_info"><b></b> Nacional</p>
	  	</div>
	  </div>
	  <!--Género-->
	  <div class="second-docker" style="display: none" id="genero-content">
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
		  	 <p class="ap_info"><b></b> Nacional</p>
	  	</div>	  
	  </div>
	  <!--Gobierno-->
	  <div class="second-docker" style="display: none" id="gobierno-content">
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
	  </div>
	  
	 
	</div>
	
	
	
	
	
	<!--ODs-->
	<div id="objetivos-content" class="main-docker" style="display: none"> 
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
			<p class="ap_info right"><b></b> Nacional</p>
		</div>
	</div>
	
	<!--Indice de Gobierno Abierto 2017-->
	<div id="indicadores-content" class="main-docker" style="display: none">
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
			<p class="ap_info right"><b></b> Nacional</p>
		</div>
	</div>
	
	<!--IDES 2017 - GESOC-->
	<div id="ides-content" class="main-docker" style="display: none">
		<div class="col-sm-10 col-sm-offset-1">
			<h2>ÍNDICE ESTATAL DE CAPACIDADES PARA EL DESARROLLO SOCIAL (IDES) 2017 – GESOC</h2>
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
	</div> <!-- ENDs ides-->
	
	<!--ejercicio local-->
	<div id="ejercicio-local-content" class="main-docker" style="display: none"> 
		@include('frontend.programas.alcance.includes.' . $include_state)
	</div>
</div>

	<?php /*
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
	*/?>
</div>