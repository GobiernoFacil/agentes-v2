@extends('layouts.admin.a_master')
@section('title', 'Resultados de encuestas de satisfacción')
@section('description', 'Resultados de encuesta de satisfacción')
@section('body_class', '')
@section('breadcrumb_type', 'indicator fellow view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_indicators')
@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Resultados de encuesta de <strong>satisfacción</strong></h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<div class="divider top"></div>
			<div class="row">
				<span class="col-sm-4 col-sm-offset-8" id ="general_div" style="display:none;">
					<strong>Promedio General: <span id ="general"></span></strong>
				</span>
			</div>
			<ol class="list line">
				<li class="row">
					<span class="col-sm-9">
						<h3>¿En qué grado consideras que la estructura de la plataforma (sesión de inicio, módulos, foros, etc.) es adecuada para su uso?</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
					</span>
					<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_1"></svg>
					<span class="col-sm-9">
						<strong>Promedio: <span id ="sur_1_av"></span></strong>
					</span>
					<span class="col-sm-9">
					<h2>Comentarios</h2>
						<small>Total: {{$all->count()}}</small>
						@foreach($all as $data)
							<p>{{$data->sur_j1}}</p>
						@endforeach
					</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>¿En qué grado consideras que el diseño de la plataforma (accesibilidad, navegación en secciones, etc.) es adecuado para su uso?</h3>
						<svg width="1000" height="500"style ="padding-left:40px; padding-top:20px"  id ="sur_2"></svg>
					</span>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_2_av"></span></strong>
						</span>
						<span class ="col-sm-9">
						<h2>Comentarios</h2>
						<small>Total: {{$all->count()}}</small>
						@foreach($all as $data)
							<p>{{$data->sur_j2}}</p>
						@endforeach
					</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>¿En qué grado consideras que la estructura organizativa de las siguientes secciones es adecuada?</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
					</span>
						<span class="col-sm-9">Login de la Plataforma</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_3_1"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_3_1_av"></span></strong>
						</span>
						<span class="col-sm-9">Módulos</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_3_2"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_3_2_av"></span></strong>
						</span>
						<span class="col-sm-9">Cursos</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_3_3"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_3_3_av"></span></strong>
						</span>
						<span class="col-sm-9">Sesiones</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_3_4"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_3_4_av"></span></strong>
						</span>
						<span class="col-sm-9">Evaluaciones</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_3_5"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_3_5_av"></span></strong>
						</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>¿Consideras que el lenguaje utilizado en la plataforma es claro?, ¿facilita el uso de la misma?</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px"  id ="sur_4"></svg>
					</span>
					<span class="col-sm-9">
						<strong>Promedio: <span id ="sur_4_av"></span></strong>
					</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>Con respecto a los contenidos multimedia (vídeos y webinars), ¿cómo calificas su calidad en cuanto a los siguientes aspectos? </h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>

					</span>
						<span class="col-sm-9">Imagen</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_5_1"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_5_1_av"></span></strong>
						</span>
						<span class="col-sm-9">Audio</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_5_2"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_5_2_av"></span></strong>
						</span>
						<span class="col-sm-9">Duración</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_5_3"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_5_3_av"></span></strong>
						</span>
						<span class="col-sm-9">Pertinencia del contenido</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_5_4"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_5_4_av"></span></strong>
						</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>Señala el orden en el que has usado con mayor o menor frecuencia los siguientes recursos</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
						</span>
						<span class="col-sm-9">Lecturas</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_6_1"></svg>
						<strong style =" visibility: hidden;">Promedio: <span id ="sur_6_1_av"></span></strong>
						<span class="col-sm-9">Videos</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_6_2"></svg>
						<strong style =" visibility: hidden;">Promedio: <span id ="sur_6_2_av"></span></strong>
						<span class="col-sm-9">Foros</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_6_3"></svg>
						<strong style =" visibility: hidden;">Promedio: <span id ="sur_6_3_av"></span></strong>
					</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>Señala el orden en el que has interactuado con mayor o menor frecuencia con los siguientes usuarios en la plataforma</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
						</span>
						<span class="col-sm-9">Imagen</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_7_1"></svg>
						<strong style =" visibility: hidden;">Promedio: <span id ="sur_7_1_av"></span></strong>
						<span class="col-sm-9">Audio</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_7_2"></svg>
						<strong style =" visibility: hidden;">Promedio: <span id ="sur_7_2_av"></span></strong>
						<span class="col-sm-9">Duración</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_7_3"></svg>
						<strong style =" visibility: hidden;">Promedio: <span id ="sur_7_3_av"></span></strong>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>¿Has experimentado dificultades técnicas para acceder a alguno de los recursos de la plataforma?</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
					</span>
					<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_8"></svg>
					<strong style =" visibility: hidden;">Promedio: <span id ="sur_8_av"></span></strong>
					<h2>Comentarios</h2>
						<small>Total: {{$all->count()}}</small>
						@foreach($all as $data)
							<p>{{$data->sur_j8}}</p>
						@endforeach
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>¿Consideras de utilidad poder visualizar en la plataforma que usuario(s) se encuentran conectados para interactuar?</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
					</span>
					<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_9"></svg>
					<span class="col-sm-9">
						<strong>Promedio: <span id ="sur_9_av"></span></strong>
					</span>
					<span class="col-sm-10">
					<h2>Comentarios</h2>
						<small>Total: {{$all->count()}}</small>
						@foreach($all as $data)
							<p>{{$data->sur_j9}}</p>
						@endforeach
					</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>¿Consideras que la plataforma, en términos generales, es amigable para el usuario?</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
					</span>
					<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_10"></svg>
					<span class="col-sm-9">
						<strong>Promedio: <span id ="sur_10_av"></span></strong>
					</span>
					<span class="col-sm-10">
					<h2>Comentarios</h2>
						<small>Total: {{$all->count()}}</small>
						@foreach($all as $data)
							<p>{{$data->sur_j10}}</p>
						@endforeach
					</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>¿Qué tan satisfecho te sientes con la experiencia de uso de la Plataforma?</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px"  id ="sur_11"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_11_av"></span></strong>
						</span>
					</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>¿Qué mejoras consideras que podrían realizarse a la plataforma?</h3>
						<small>Comentarios: {{$all->count()}}</small>
						@foreach($all as $data)
						<p>{{$data->sur_j12}}</p>
						@endforeach
					</span>
				</li>
			</ol>
			<div class="divider"></div>
			<h2 class="sa_title">Valoración de cada sesión del Curso 1 “Gobierno Abierto y los ODS”</h2>
			<p>En una escala de 0 a 10, donde 0 es nada  y 10 es mucho, señala en qué grado cada elemento ha contruibuido a tu aprendizaje para la siguientes sesiones</p>
			<div class="row">
				<span class="col-sm-4 col-sm-offset-8" id ="general_div_2" style="display:none;">
					<strong>Promedio General: <span id ="general_2"></span></strong>
				</span>
			</div>
			<ol>
				<li class="row">
					<span class="col-sm-9">
						<h3>Sesión “Los ejes del Gobierno Abierto, la gobernanza y la atención de la corrupción”</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>

					</span>
						<span class="col-sm-9">Lecturas</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_13_1"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_13_1_av"></span></strong>
						</span>
						<span class="col-sm-9">Cápsulas de expertos</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_13_2"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_13_2_av"></span></strong>
						</span>
						<span class="col-sm-9">Facilitador</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_13_3"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_13_3_av"></span></strong>
						</span>
						<span class="col-sm-9"> Contenido en general</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_13_4"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_13_4_av"></span></strong>
						</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>Sesión “Panorama internacional y el papel de los ODS en el Gobierno Abierto”</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>

					</span>
						<span class="col-sm-9">Lecturas</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_14_1"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_14_1_av"></span></strong>
						</span>
						<span class="col-sm-9">Cápsulas de expertos</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_14_2"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_14_2_av"></span></strong>
						</span>
						<span class="col-sm-9">Facilitador</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_14_3"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_14_3_av"></span></strong>
						</span>
						<span class="col-sm-9">Contenido en general</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_14_4"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_14_4_av"></span></strong>
						</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>Sesión “ODS en la Agenda Nacional de Gobierno Abierto”</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>

					</span>
						<span class="col-sm-9">Lecturas</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_15_1"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_15_1_av"></span></strong>
						</span>
						<span class="col-sm-9">Cápsulas de expertos</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_15_2"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_15_2_av"></span></strong>
						</span>
						<span class="col-sm-9">Facilitador</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_15_3"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_15_3_av"></span></strong>
						</span>
						<span class="col-sm-9">Contenido en general</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_15_4"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_15_4_av"></span></strong>
						</span>
				</li>
				<li class="row">
					<span class="col-sm-9">
						<h3>Sesión “Debates principales en Gobierno Abierto y Objetivo 16 "Paz Justicia e Instituciones Fuertes”</h3>
						<small><strong>Respuestas: {{$all->count()}}</strong></small>

					</span>
						<span class="col-sm-9">Lecturas</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_16_1"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_16_1_av"></span></strong>
						</span>
						<span class="col-sm-9">Cápsulas de expertos</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_16_2"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_16_2_av"></span></strong>
						</span>
						<span class="col-sm-9">Facilitador</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_16_3"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_16_3_av"></span></strong>
						</span>
						<span class="col-sm-9">Contenido en general</span>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="sur_16_4"></svg>
						<span class="col-sm-9">
							<strong>Promedio: <span id ="sur_16_4_av"></span></strong>
						</span>
				</li>
		    </ol>
		</div>
	</div>
</div>
@endsection

@section('js-content')
<style>

.bar {
  fill: #187fad;;
}

.bar:hover {
  fill: #0a3345;
}

.d3-tip {
      line-height: 1;
      padding: 6px;
      background: rgba(0, 0, 0, 0.8);
      color: #fff;
      border-radius: 4px;
      font-size: 12px;
    }

    /* Creates a small triangle extender for the tooltip */
    .d3-tip:after {
      box-sizing: border-box;
      display: inline;
      font-size: 10px;
      width: 100%;
      line-height: 1;
      color: rgba(0, 0, 0, 0.8);
      content: "\25BC";
      position: absolute;
      text-align: center;
    }

    /* Style northward tooltips specifically */
    .d3-tip.n:after {
      margin: -2px 0 0 0;
      top: 100%;
      left: 0;
    }




</style>
<script src="https://d3js.org/d3.v4.js"></script>
<script src="{{url('js/survey/d3-tip.js')}}"></script>
<script>
var total = {{$all->count()}};
var average_total = 0;
var average_total_2 = 0;
<?php
 $index = [
                      'sur_1',
                      'sur_2',
                      'sur_3_1',
                      'sur_3_2',
                      'sur_3_3',
                      'sur_3_4',
                      'sur_3_5',
                      'sur_4',
                      'sur_5_1',
                      'sur_5_2',
                      'sur_5_3',
                      'sur_5_4',
                      'sur_6_1',
                      'sur_6_2',
                      'sur_6_3',
                      'sur_7_1',
                      'sur_7_2',
                      'sur_7_3',
                      'sur_8',
                      'sur_9',
                      'sur_10',
                      'sur_11',
                      'sur_13_1',
                      'sur_13_2',
                      'sur_13_3',
                      'sur_13_4',
                      'sur_14_1',
                      'sur_14_2',
                      'sur_14_3',
                      'sur_14_4',
                      'sur_15_1',
                      'sur_15_2',
                      'sur_15_3',
                      'sur_15_4',
                      'sur_16_1',
                      'sur_16_2',
                      'sur_16_3',
                      'sur_16_4'
                    ];
 foreach($index as $i){
 	?>
 	var url_{{$i}} = "<?php echo url('dashboard/encuestas/get_csv/fellow/su_'.$i.'.csv');?>";
 	var svg_{{$i}} = d3.select("#{{$i}}"),
    margin = {top: 50, right: 40, bottom: 30, left: 40},
    width = +svg_{{$i}}.attr("width") - margin.left - margin.right,
    height = +svg_{{$i}}.attr("height") - margin.top - margin.bottom,
		aspect = width / height;

var x = d3.scaleBand().rangeRound([0, width]).padding(0.1),
    y = d3.scaleLinear().rangeRound([height, 0]);

		var tool_tip = d3.tip()
	       .attr("class", "d3-tip")
	       .offset([-8, 0])
	       .html(function(d) { return "Total: " + d.values +"</br>"+ ((d.values*100)/total).toFixed(2) +"%" });
	     svg_{{$i}}.call(tool_tip);

var g = svg_{{$i}}.append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

		d3.select(window)
			  .on("resize", function() {
			    var targetWidth = svg.node().getBoundingClientRect().width;
			    svg.attr("width", targetWidth);
			    svg.attr("height", targetWidth / aspect);
			  });
		d3.csv(url_{{$i}}, function(error, data) {
		  if (error) throw error;

		  // format the data
		  data.forEach(function(d) {
		    d.values = +d.values;
		  });

			var average = 0;
			var total   = 0;
			data.forEach(function(all) {
		    average = (all.values*parseInt(all.options)) + average;
				total   = total + all.values;

		  });
			<?php if(strlen($i)<8 && $i!='sur_8'){?>
				if((average/total)){
					average_total = average_total +(average/total);
				}
			<?php }else{ ?>
				if((average/total)){
					average_total_2 = average_total_2 +(average/total);
				}
		<?php	} ?>

		  // Scale the range of the data in the domains
		  x.domain(data.map(function(d) { return d.options; }));
		  y.domain([0, d3.max(data, function(d) { return d.values; })]);

		  // append the rectangles for the bar chart
		  svg_{{$i}}.selectAll(".bar")
		      .data(data)
		    .enter().append("rect")
		      .attr("class", "bar")
		      .attr("x", function(d) { return x(d.options); })
		      .attr("width", x.bandwidth())
		      .attr("y", function(d) { return y(d.values); })
		      .attr("height", function(d) { return height - y(d.values); })
					.on('mouseover', tool_tip.show)
      	  .on('mouseout', tool_tip.hide);

		  // add the x Axis
		  svg_{{$i}}.append("g")
		      .attr("transform", "translate(0," + height + ")")
		      .call(d3.axisBottom(x));

		  // add the y Axis
		  svg_{{$i}}.append("g")
		      .call(d3.axisLeft(y));
					var name  = "<?php echo $i.'_av';?>";
					document.getElementById(name).textContent=(average/total).toFixed(2);
		});
<?php

 }
?>
var interval = setInterval(function() {
    if(document.readyState === 'complete') {
        clearInterval(interval);
				document.getElementById('general').textContent=(average_total/15).toFixed(2);
				document.getElementById('general_div').style.display = "block" ;
				document.getElementById('general_2').textContent=(average_total_2/15).toFixed(2);
				document.getElementById('general_div_2').style.display = "block" ;
    }
}, 14000);
</script>
<script src="{{url('js/survey/survey-fellow.js')}}"></script>
@endsection
