@extends('layouts.frontend.master')
@section('title', 'Criterios y metodología de selección')
@section('description', "¿Cómo se seleccionaron los candidatos para la $notice->title del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible?")
@section('body_class', 'convocatoria methodology')
@section('canonical', url("convocatoria/$notice->slug/metodologia") )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_convocatoria')

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>¿Cómo se seleccionaron los candidatos para la {{$notice->title}} del <strong>Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</strong>?</h1>
		<h2>Criterios y metodología de selección  <a href="#nota"><sup>1</sup></a></h2>
		<p>El proceso de selección tuvo por objeto elegir 40 integrantes del <strong>Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</strong>, edición {{DateTime::createFromFormat("Y-m-d", $notice->start)->format("Y")}}. Como criterio inicial se buscó seleccionar a 4 candidatos por cada una de las {{$states->count()}} entidades federativas que se incorporaron a esta convocatoria ({{implode(", ", $states->pluck('state')->toArray())}}).</p>

		<p>El proceso de selección se llevó a cabo con base en el total de postulaciones recibidas, así como en los requisitos establecidos en la convocatoria. El proceso de selección se conformó por las siguientes etapas:</p>
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		<!--Fase 1: Verificación documental-->
		<h2>Fase 1: Verificación documental</h2>
		<p>Como primer paso, el Comité dictaminador verificó que las postulaciones recibidas cumplieran con los requisitos especificados en la convocatoria, que fueron:</p>
		<ul>
			<li>Formato de registro debidamente llenado.</li>
			<li>Documento que acredite la residencia del postulante en las entidades federativas objetivo ({{implode(", ", $states->pluck('state')->toArray())}}).</li>
			<li>Currículum vitae y/o publicaciones, investigaciones o documentos que muestren conocimiento previo y experiencia del aspirante en temas relacionados con Gobierno Abierto o Desarrollo Sostenible.</li>
			<li>Ensayo en el que cada aspirante manifieste las razones por las cuales está interesado en participar en el Programa, así como las aportaciones que pueden brindar a su contexto local como resultado de su participación en este programa. </li>
			<li>Video breve en donde el postulante presente una idea para desarrollar un proyecto en su entidad federativa en el que, a través del uso de herramientas de gobierno abierto, se pueda atender exitosamente un reto local de desarrollo sostenible.</li>
		</ul>
		<p>Al cierre de la convocatoria se recibieron un total de {{$notice->aspirants->count()}} intenciones de participación, de las cuales solamente {{$notice->aspirants_app_already_evaluated()->count()}} contaron con la documentación completa para avanzar en la siguiente fase del proceso. La distribución por entidad federativa de los aspirantes que entregaron su documentación completa fue la siguiente:</p>
		<table class="table">
			<thead>
				<tr>
					<th>Entidad Federativa</th>
					<th>Aspirantes</th>
				</tr>
			</thead>
			<tbody>
        <?php $count = 0;?>
        @foreach($states as $state)
          <tr>
  					<td>{{$state->state}}</td>
  					<td>{{$notice->aspirants_approved_proof_by_state($state->state)->count()}}</td>
  				</tr>
          <?php $count = $notice->aspirants_approved_proof_by_state($state->state)->count()+$count;?>
        @endforeach
				<tr>
					<td><strong>Total</strong></td>
					<td><strong>{{$count}}</strong>	 </td>
				</tr>
			</tbody>
		</table>

		<!-- fase 2-->
		<h2>Fase 2: Evaluación de experiencia previa y de propuesta de proyecto</h2>
		<p>En una segunda etapa, el Comité Dictaminador evaluó la experiencia de los candidatos preseleccionados en proyectos/actividades relacionados con temas de gobierno abierto y/o desarrollo sostenible, así como las propuestas de proyecto presentadas en el ensayo y el video. Cada uno de los componentes evaluados en esta fase del proceso se ponderó de la siguiente manera:</p>
		<ul>
			<li>Experiencia previa en proyectos de GA y/o DS (revisión de CV): <strong>30 por ciento</strong>.</li>
			<li>Ensayo escrito: <strong>35 por ciento</strong>.												 </li>
			<li>Video de presentación: <strong>35 por ciento</strong>.										 </li>
		</ul>
		<p>Con base en estos criterios, las calificaciones obtenidas por los 89 candidatos que avanzaron a esta fase del proceso fueron las siguientes:</p>
		<table id="tabla2" class="table">
  <thead>
    <tr>
      <th>Folio Interno</th>
      <th>Estado</th>
      <th>CV (30%)</th>
      <th>Ensayo (35%)</th>
      <th>Video (35%)</th>
      <th>Total (100%)</th>
    </tr>
  </thead>
  <tbody><tr><td>1</td><td>Morelos</td><td>2.4</td><td>2.52</td><td>2.1</td><td>7.02</td></tr><tr><td>2</td><td>Sonora</td><td>1.95</td><td>2.59</td><td>2.8</td><td>7.34</td></tr><tr><td>7</td><td>Morelos</td><td>2.4</td><td>1.82</td><td>2.8</td><td>7.02</td></tr><tr><td>11</td><td>Morelos</td><td>1.5</td><td>2.17</td><td>3.15</td><td>6.82</td></tr><tr><td>13</td><td>Sonora</td><td>2.25</td><td>3.01</td><td>1.05</td><td>6.31</td></tr><tr><td>19</td><td>Oaxaca</td><td>2.55</td><td>3.15</td><td>3.15</td><td>8.85</td></tr><tr><td>25</td><td>Chihuahua</td><td>2.25</td><td>2.1</td><td>1.05</td><td>5.4</td></tr><tr><td>27</td><td>Oaxaca</td><td>1.95</td><td>2.73</td><td>1.4</td><td>6.08</td></tr><tr><td>32</td><td>Chihuahua</td><td>1.2</td><td>2.03</td><td>0.7</td><td>3.93</td></tr><tr><td>35</td><td>Oaxaca</td><td>1.5</td><td>1.4</td><td>1.05</td><td>3.95</td></tr><tr><td>36</td><td>Chihuahua</td><td>1.95</td><td>2.24</td><td>2.8</td><td>6.99</td></tr><tr><td>37</td><td>Sonora</td><td>2.4</td><td>2.59</td><td>3.5</td><td>8.49</td></tr><tr><td>43</td><td>Sonora</td><td>1.5</td><td>2.94</td><td>3.5</td><td>7.94</td></tr><tr><td>44</td><td>Chihuahua</td><td>1.8</td><td>1.19</td><td>1.75</td><td>4.74</td></tr><tr><td>46</td><td>Oaxaca</td><td>2.4</td><td>3.29</td><td>3.5</td><td>9.19</td></tr><tr><td>49</td><td>Chihuahua</td><td>1.8</td><td>2.66</td><td>0.7</td><td>5.16</td></tr><tr><td>58</td><td>Sonora</td><td>1.65</td><td>1.47</td><td>0</td><td>3.12</td></tr><tr><td>60</td><td>Morelos</td><td>2.25</td><td>2.87</td><td>2.45</td><td>7.57</td></tr><tr><td>68</td><td>Morelos</td><td>1.5</td><td>1.54</td><td>2.1</td><td>5.14</td></tr><tr><td>70</td><td>Morelos</td><td>1.95</td><td>2.1</td><td>1.75</td><td>5.8</td></tr><tr><td>72</td><td>Morelos</td><td>1.5</td><td>0</td><td>1.4</td><td>2.9</td></tr><tr><td>88</td><td>Chihuahua</td><td>1.5</td><td>0</td><td>2.1</td><td>3.6</td></tr><tr><td>91</td><td>Chihuahua</td><td>1.5</td><td>1.68</td><td>2.66</td><td>5.84</td></tr><tr><td>104</td><td>Chihuahua</td><td>2.4</td><td>2.52</td><td>2.66</td><td>7.58</td></tr><tr><td>114</td><td>Chihuahua</td><td>2.1</td><td>2.66</td><td>3.5</td><td>8.26</td></tr><tr><td>118</td><td>Oaxaca</td><td>0.15</td><td>2.24</td><td>3.15</td><td>5.54</td></tr><tr><td>119</td><td>Morelos</td><td>1.5</td><td>2.17</td><td>1.4</td><td>5.07</td></tr><tr><td>120</td><td>Chihuahua</td><td>2.1</td><td>2.31</td><td>2.1</td><td>6.51</td></tr><tr><td>125</td><td>Oaxaca</td><td>2.4</td><td>2.52</td><td>3.15</td><td>8.07</td></tr><tr><td>128</td><td>Sonora</td><td>0.15</td><td>1.89</td><td>1.05</td><td>3.09</td></tr><tr><td>136</td><td>Sonora</td><td>1.5</td><td>2.03</td><td>1.4</td><td>4.93</td></tr><tr><td>143</td><td>Oaxaca</td><td>1.8</td><td>0.7</td><td>1.96</td><td>4.46</td></tr><tr><td>148</td><td>Chihuahua</td><td>2.25</td><td>2.31</td><td>3.15</td><td>7.71</td></tr><tr><td>151</td><td>Chihuahua</td><td>2.25</td><td>2.8</td><td>3.15</td><td>8.2</td></tr><tr><td>152</td><td>Nuevo León</td><td>2.25</td><td>1.12</td><td>2.66</td><td>6.03</td></tr><tr><td>153</td><td>Oaxaca</td><td>2.25</td><td>3.08</td><td>2.45</td><td>7.78</td></tr><tr><td>157</td><td>Oaxaca</td><td>2.25</td><td>2.73</td><td>1.05</td><td>6.03</td></tr><tr><td>161</td><td>Oaxaca</td><td>2.1</td><td>2.94</td><td>2.66</td><td>7.7</td></tr><tr><td>163</td><td>Sonora</td><td>0.45</td><td>2.87</td><td>2.8</td><td>6.12</td></tr><tr><td>166</td><td>Oaxaca</td><td>2.25</td><td>2.87</td><td>3.15</td><td>8.27</td></tr><tr><td>169</td><td>Oaxaca</td><td>2.7</td><td>0.35</td><td>1.75</td><td>4.8</td></tr><tr><td>170</td><td>Sonora</td><td>0.6</td><td>2.66</td><td>1.75</td><td>5.01</td></tr><tr><td>177</td><td>Morelos</td><td>2.25</td><td>2.59</td><td>2.45</td><td>7.29</td></tr><tr><td>178</td><td>Chihuahua</td><td>2.25</td><td>2.17</td><td>3.5</td><td>7.92</td></tr><tr><td>184</td><td>Morelos</td><td>1.5</td><td>1.68</td><td>2.1</td><td>5.28</td></tr><tr><td>193</td><td>Sonora</td><td>1.5</td><td>0.98</td><td>2.1</td><td>4.58</td></tr><tr><td>194</td><td>Oaxaca</td><td>0.9</td><td>2.45</td><td>2.45</td><td>5.8</td></tr><tr><td>195</td><td>Chihuahua</td><td>0.6</td><td>2.87</td><td>2.66</td><td>6.13</td></tr><tr><td>197</td><td>Chihuahua</td><td>0.9</td><td>2.24</td><td>1.75</td><td>4.89</td></tr><tr><td>199</td><td>Oaxaca</td><td>1.8</td><td>2.73</td><td>2.66</td><td>7.19</td></tr><tr><td>200</td><td>Nuevo León</td><td>0.9</td><td>2.8</td><td>2.87</td><td>6.57</td></tr><tr><td>201</td><td>Sonora</td><td>0.45</td><td>2.45</td><td>3.15</td><td>6.05</td></tr><tr><td>202</td><td>Oaxaca</td><td>1.8</td><td>2.31</td><td>1.05</td><td>5.16</td></tr><tr><td>203</td><td>Chihuahua</td><td>0.45</td><td>2.17</td><td>0.7</td><td>3.32</td></tr><tr><td>204</td><td>Nuevo León</td><td>2.1</td><td>1.96</td><td>0</td><td>4.06</td></tr><tr><td>206</td><td>Oaxaca</td><td>2.4</td><td>1.19</td><td>3.5</td><td>7.09</td></tr><tr><td>207</td><td>Nuevo León</td><td>0.75</td><td>1.54</td><td>2.8</td><td>5.09</td></tr><tr><td>210</td><td>Chihuahua</td><td>2.55</td><td>2.52</td><td>2.45</td><td>7.52</td></tr><tr><td>212</td><td>Morelos</td><td>2.4</td><td>3.08</td><td>3.5</td><td>8.98</td></tr><tr><td>213</td><td>Sonora</td><td>1.8</td><td>0.28</td><td>2.8</td><td>4.88</td></tr><tr><td>214</td><td>Chihuahua</td><td>2.55</td><td>1.82</td><td>3.15</td><td>7.52</td></tr><tr><td>215</td><td>Morelos</td><td>1.8</td><td>1.26</td><td>2.45</td><td>5.51</td></tr><tr><td>216</td><td>Chihuahua</td><td>1.8</td><td>1.61</td><td>2.8</td><td>6.21</td></tr><tr><td>217</td><td>Oaxaca</td><td>2.7</td><td>2.52</td><td>3.15</td><td>8.37</td></tr><tr><td>218</td><td>Sonora</td><td>2.03</td><td>2.66</td><td>3.5</td><td>8.19</td></tr><tr><td>220</td><td>Sonora</td><td>1.5</td><td>1.68</td><td>0</td><td>3.18</td></tr><tr><td>221</td><td>Sonora</td><td>2.78</td><td>3.36</td><td>3.5</td><td>9.64</td></tr><tr><td>222</td><td>Oaxaca</td><td>1.5</td><td>3.01</td><td>3.5</td><td>8.01</td></tr><tr><td>223</td><td>Chihuahua</td><td>2.1</td><td>2.87</td><td>3.15</td><td>8.12</td></tr><tr><td>224</td><td>Nuevo León</td><td>1.8</td><td>2.87</td><td>3.5</td><td>8.17</td></tr><tr><td>226</td><td>Chihuahua</td><td>1.95</td><td>1.26</td><td>2.45</td><td>5.66</td></tr><tr><td>228</td><td>Oaxaca</td><td>0</td><td>0</td><td>0</td><td>0</td></tr><tr><td>230</td><td>Oaxaca</td><td>1.8</td><td>2.24</td><td>3.5</td><td>7.54</td></tr><tr><td>235</td><td>Nuevo León</td><td>1.65</td><td>1.82</td><td>3.5</td><td>6.97</td></tr><tr><td>236</td><td>Oaxaca</td><td>2.4</td><td>2.38</td><td>2.1</td><td>6.88</td></tr><tr><td>237</td><td>Chihuahua</td><td>2.1</td><td>1.61</td><td>2.45</td><td>6.16</td></tr><tr><td>238</td><td>Nuevo León</td><td>1.8</td><td>1.4</td><td>1.4</td><td>4.6</td></tr><tr><td>239</td><td>Sonora</td><td>1.95</td><td>1.61</td><td>3.5</td><td>7.06</td></tr><tr><td>240</td><td>Nuevo León</td><td>2.25</td><td>2.59</td><td>2.45</td><td>7.29</td></tr><tr><td>241</td><td>Chihuahua</td><td>2.85</td><td>1.4</td><td>3.5</td><td>7.75</td></tr><tr><td>242</td><td>Chihuahua</td><td>2.4</td><td>3.22</td><td>3.5</td><td>9.12</td></tr><tr><td>245</td><td>Chihuahua</td><td>2.55</td><td>2.66</td><td>3.5</td><td>8.71</td></tr><tr><td>247</td><td>Nuevo León</td><td>2.63</td><td>2.38</td><td>3.15</td><td>8.16</td></tr><tr><td>248</td><td>Oaxaca</td><td>2.4</td><td>2.24</td><td>0.7</td><td>5.34</td></tr><tr><td>249</td><td>Oaxaca</td><td>2.4</td><td>0</td><td>3.5</td><td>5.9</td></tr><tr><td>250</td><td>Chihuahua</td><td>2.4</td><td>1.89</td><td>1.75</td><td>6.04</td></tr><tr><td>251</td><td>Morelos</td><td>1.65</td><td>3.15</td><td>0</td><td>4.8</td></tr><tr><td>253</td><td>Sonora</td><td>1.95</td><td>0</td><td>2.1</td><td>4.05</td></tr><tr><td>255</td><td>Oaxaca</td><td>2.55</td><td>2.8</td><td>2.8</td><td>8.15</td></tr></tbody>
</table>
		<p>Una vez obtenidas estas calificaciones, se seleccionó a los 6 aspirantes de cada entidad federativa que obtuvieron las mayores calificaciones para avanzar a la última fase del proceso de selección. Los folios y calificaciones los aspirantes seleccionados por entidad federativa fueron las siguientes:</p>
		<table id="tabla3" class="table">
  <thead>
    <tr>
      <th>Folio interno</th>
      <th>Estado</th>
      <th>Calificación</th>
    </tr>
  </thead>
  <tbody><tr><td>178</td><td>Chihuahua</td><td>7.92</td></tr><tr><td>223</td><td>Chihuahua</td><td>8.12</td></tr><tr><td>151</td><td>Chihuahua</td><td>8.2</td></tr><tr><td>114</td><td>Chihuahua</td><td>8.26</td></tr><tr><td>245</td><td>Chihuahua</td><td>8.71</td></tr><tr><td>242</td><td>Chihuahua</td><td>9.12</td></tr><tr><td>11</td><td>Morelos</td><td>6.82</td></tr><tr><td>1</td><td>Morelos</td><td>7.02</td></tr><tr><td>7</td><td>Morelos</td><td>7.02</td></tr><tr><td>177</td><td>Morelos</td><td>7.29</td></tr><tr><td>60</td><td>Morelos</td><td>7.57</td></tr><tr><td>212</td><td>Morelos</td><td>8.98</td></tr><tr><td>152</td><td>Nuevo León</td><td>6.03</td></tr><tr><td>200</td><td>Nuevo León</td><td>6.57</td></tr><tr><td>235</td><td>Nuevo León</td><td>6.97</td></tr><tr><td>240</td><td>Nuevo León</td><td>7.29</td></tr><tr><td>247</td><td>Nuevo León</td><td>8.16</td></tr><tr><td>224</td><td>Nuevo León</td><td>8.17</td></tr><tr><td>239</td><td>Sonora</td><td>7.06</td></tr><tr><td>2</td><td>Sonora</td><td>7.34</td></tr><tr><td>43</td><td>Sonora</td><td>7.94</td></tr><tr><td>218</td><td>Sonora</td><td>8.19</td></tr><tr><td>37</td><td>Sonora</td><td>8.49</td></tr><tr><td>221</td><td>Sonora</td><td>9.64</td></tr><tr><td>125</td><td>Oaxaca</td><td>8.07</td></tr><tr><td>255</td><td>Oaxaca</td><td>8.15</td></tr><tr><td>166</td><td>Oaxaca</td><td>8.27</td></tr><tr><td>217</td><td>Oaxaca</td><td>8.37</td></tr><tr><td>19</td><td>Oaxaca</td><td>8.85</td></tr><tr><td>46</td><td>Oaxaca</td><td>9.19</td></tr></tbody>
</table>
		<!--- fase 3-->
		<h2>Fase 3: Entrevistas</h2>
		<p>El Comité Dictaminador informó el 15 de mayo pasado a los 30 aspirantes preseleccionados sobre la fecha y la hora en la que se realizará la entrevista final para participar en el Programa de Formación de Agentes Locales. Cada entrevista tuvo una duración aproximada de 30 minutos, en donde se cuestionó a cada candidato sobre temas clave de la agenda de gobierno abierto y desarrollo sostenible en lo local en México. Todas las entrevistas se realizaron entre el 17 y el 18 de mayo de forma remota, ya fuera a través de la plataforma Skype o por vía telefónica. Las preguntas que se emplearon como guía para todas las entrevistas fueron las siguientes:</p>
		<h3>Preguntas sustantivas:</h3>
		<ol>
			<li>¿Cómo visualizas al gobierno abierto como una palanca para el desarrollo sustentable?</li>
			<li>¿Has desarrollado algún proyecto de manera colaborativa anteriormente? Si es así cuéntanos tu experiencia y qué actores han participado. Si no ¿cómo lo harías?</li>
			<li>¿Qué atributos consideras que te hacen un agente local de cambio? (liderazgo, incidencia, movilización, etc.)</li>
			<li>¿Cuáles son los principales retos de tu estado? ¿Cómo se vinculan a los ODS?</li>
	</ol>

		<h3>Preguntas Extra:</h3>
		<ol>
			<li>¿Cuál es tu disponibilidad de tiempo para realizar las actividades contempladas en el programa?</li>
		</ol>
		<p>Las entrevistas se distribuyeron por cada una de las organizaciones que forman parte del Grupo de Trabajo del proyecto. Así, <strong>INAI</strong> entrevistó a los candidatos de Nuevo León, <strong>PNUD</strong> a los de Sonora, <strong>Gesoc</strong> a los de Chihuahua, <strong>ProSociedad</strong> a los de Oaxaca y, finalmente, <strong>Gobierno Fácil</strong> a los de Morelos. Las calificaciones obtenidas por los aspirantes en esta fase de entrevistas fueron las siguientes:</p>

		<table class="table">
			<thead>
				<tr>
					<th>Folio interno			</th>
					<th>Estado					</th>
					<th>Calificación experiencia</th>
					<th>Calificación entrevistas</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>178		  </td>
					<td>Chihuahua </td>
					<td>7.92	  </td>
					<td>8.62	  </td>
				</tr>
				<tr>
					<td>223		  </td>
					<td>Chihuahua </td>
					<td>8.12	  </td>
					<td>7.62	  </td>
				</tr>
				<tr>
					<td>151		  </td>
					<td>Chihuahua </td>
					<td>8.2		  </td>
					<td>9.50	  </td>
				</tr>
				<tr>
					<td>114		  </td>
					<td>Chihuahua </td>
					<td>8.26	  </td>
					<td>9.12	  </td>
				</tr>
				<tr>
					<td>245		  </td>
					<td>Chihuahua </td>
					<td>8.71	  </td>
					<td>9.50	  </td>
				</tr>
				<tr>
					<td>242		  </td>
					<td>Chihuahua </td>
					<td>9.12	  </td>
					<td>8.50	  </td>
				</tr>
				<tr>
					<td>11		  </td>
					<td>Morelos	  </td>
					<td>6.82	  </td>
					<td>6.50	  </td>
				</tr>
				<tr>
					<td>1		  </td>
					<td>Morelos	  </td>
					<td>7.02	  </td>
					<td>7.87	  </td>
				</tr>
				<tr>
					<td>7		  </td>
					<td>Morelos	  </td>
					<td>7.02	  </td>
					<td>7.60	  </td>
				</tr>
				<tr>
					<td>177		  </td>
					<td>Morelos	  </td>
					<td>7.29	  </td>
					<td>6.00	  </td>
				</tr>
				<tr>
					<td>60		  </td>
					<td>Morelos	  </td>
					<td>7.57	  </td>
					<td>9.29	  </td>
				</tr>
				<tr>
					<td>212		  </td>
					<td>Morelos	  </td>
					<td>8.98	  </td>
					<td>8.25	  </td>
				</tr>
				<tr>
					<td>152		  </td>
					<td>Nuevo León</td>
					<td>6.03	  </td>
					<td>7.30	  </td>
				</tr>
				<tr>
					<td>200		  </td>
					<td>Nuevo León</td>
					<td>6.57	  </td>
					<td>8.30	  </td>
				</tr>
				<tr>
					<td>235		  </td>
					<td>Nuevo León</td>
					<td>6.97	  </td>
					<td>7.10	  </td>
				</tr>
				<tr>
					<td>240		  </td>
					<td>Nuevo León</td>
					<td>7.29	  </td>
					<td>9.20	  </td>
				</tr>
				<tr>
					<td>247		  </td>
					<td>Nuevo León</td>
					<td>8.16	  </td>
					<td>8.20	  </td>
				</tr>
				<tr>
					<td>224		  </td>
					<td>Nuevo León</td>
					<td>8.17	  </td>
					<td>9.20	  </td>
				</tr>
				<tr>
					<td>239		  </td>
					<td>Sonora	  </td>
					<td>7.06	  </td>
					<td>7.32	  </td>
				</tr>
				<tr>
					<td>2		  </td>
					<td>Sonora	  </td>
					<td>7.34	  </td>
					<td>8.50	  </td>
				</tr>
				<tr>
					<td>43		  </td>
					<td>Sonora	  </td>
					<td>7.94	  </td>
					<td>8.56	  </td>
				</tr>
				<tr>
					<td>218		  </td>
					<td>Sonora	  </td>
					<td>8.19	  </td>
					<td>7.74	  </td>
				</tr>
				<tr>
					<td>37		  </td>
					<td>Sonora	  </td>
					<td>8.49	  </td>
					<td>7.44	  </td>
				</tr>
				<tr>
					<td>221		  </td>
					<td>Sonora	  </td>
					<td>9.64	  </td>
					<td>8.53	  </td>
				</tr>
				<tr>
					<td>125		  </td>
					<td>Oaxaca	  </td>
					<td>8.07	  </td>
					<td>9.00	  </td>
				</tr>
				<tr>
					<td>255		  </td>
					<td>Oaxaca	  </td>
					<td>8.15	  </td>
					<td>8.20	  </td>
				</tr>
				<tr>
					<td>166		  </td>
					<td>Oaxaca	  </td>
					<td>8.27	  </td>
					<td>9.80	  </td>
				</tr>
				<tr>
					<td>217		  </td>
					<td>Oaxaca	  </td>
					<td>8.37	  </td>
					<td>9.50	  </td>
				</tr>
				<tr>
					<td>19		  </td>
					<td>Oaxaca	  </td>
					<td>8.85	  </td>
					<td>9.70	  </td>
				</tr>
				<tr>
					<td>46		  </td>
					<td>Oaxaca	  </td>
					<td>9.19	  </td>
					<td>9.70	  </td>
				</tr>
			</tbody>
		</table>


		<p>Los cuatro aspirantes que obtuvieron las mayores calificaciones en la fase de entrevista por entidad federativa fueron los que resultaron seleccionados al Programa de Formación. El listado de aspirantes seleccionados es el siguiente:</p>

		<table class="table">
			<thead>
				<tr>
					<th>Estado</th>
					<th>Nombre</th>
				</tr>
			</thead>
			<tbody>
        @foreach($notice->selected_aspirant_order_by_state()->get() as $aspirant)
          <tr>
            <td>{{$aspirant->state}}					   </td>
            <td>{{str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($aspirant->name)))).' '.str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($aspirant->surname)))).' '.str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($aspirant->lastname))))}}</td>
          </tr>
        @endforeach
			</tbody>
		</table>
	</div>
	<div class="col-sm-12">
		<div class="divider"></div>
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		<a id="nota"></a>
		<div class="notes">
			<p><sup>1</sup>  <strong>Nota</strong>: Dos candidatos declinaron su participación en el Programa por motivos personales, y a un candidato no se le formalizó su candidatura al no cumplir con los requisitos establecidos en la convocatoria y la documentación solicitada en el marco del proyecto. Por lo tanto, los tres candidatos que los sustituyeron fueron seleccionados de acuerdo al criterio establecido en la Base 4 de la Convocatoria “<em>…En caso de que un participante decida abandonar el programa, dicho espacio será ocupado por el aspirante rechazado con la calificación más alta en el proceso de selección</em>”.</p>
		</div>
	</div>
</div>
@endsection
