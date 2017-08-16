@extends('layouts.admin.a_master')
@section('title', 'Resultados de encuesta por sesión de ' . $facilitatorData->facilitator->name)
@section('description', 'Resultados de encuesta por sesión de ' . $facilitatorData->facilitator->name.' sesión '.$facilitatorData->session->name)
@section('body_class', '')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Resultados de encuesta de <strong>{{$facilitatorData->facilitator->name}}</strong></h1>
    <h2>Sesión <strong>{{$facilitatorData->session->name}}</strong></h2>
		<div class="divider top"></div>
	</div>
	<!--info fellow-->
	<div class="col-sm-1 center">
		@if($facilitatorData->facilitator->image)
		<img src='{{url("img/users/{$facilitatorData->facilitator->image->name}")}}' width="100%">
		@else
		<img src='{{url("img/users/default.png")}}' height="40px">
		@endif
	</div>
	<div class="col-sm-3">
		<p>{{$facilitatorData->facilitator->facilitatorData->institution}}</p>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<div class="divider top"></div>
				<ol class="list line">
					<li class="row">
						<span class="col-sm-9">
						<h3>La claridad de exposición del facilitador fue</h3>
						</span>
            <svg width="960" height="500"></svg>
					</li>
          <li class="row">
						<span class="col-sm-9">
						<h3>El facilitador motiva y despierta interés en los agentes de cambio a través de su exposición</h3>
						</span>
					</li>
          <li class="row">
						<span class="col-sm-9">
						<h3>El facilitador da retroalimentación a los estudiantes</h3>
						</span>
					</li>
          <li class="row">
            <span class="col-sm-9">
            <h3>El facilitador responde con claridad a las preguntas de los estudiantes</h3>
            </span>
          </li>
          <li class="row">
            <span class="col-sm-9">
            <h3>En el desarrollo de su exposición el facilitador presenta ejemplos relevantes sobre los temas tratados</h3>
            </span>
          </li>
          <li class="row">
            <span class="col-sm-9">
            <h3>El facilitador presentó de forma organizada los contenidos abordados</h3>
            </span>
          </li>
          <li class="row">
            <span class="col-sm-9">
            <h3>¿Qué fortalezas identificas en el facilitador?</h3>
            </span>
          </li>
          <li class="row">
            <span class="col-sm-9">
            <h3>¿Qué áreas de mejora identificas en el facilitador?</h3>
            </span>
          </li>
          <li class="row">
            <span class="col-sm-9">
            <h3>¿Propondría a este facilitador para que dirigiera otro curso de este programa de formación?</h3>
            </span>
          </li>
				</ol>
				<div class="divider"></div>
		</div>
	</div>
</div>
@endsection
@section('js-content')
<script src="https://d3js.org/d3.v4.js"></script>
<script>
var svg = d3.select("svg"),
    margin = {top: 20, right: 20, bottom: 30, left: 40},
    width = +svg.attr("width") - margin.left - margin.right,
    height = +svg.attr("height") - margin.top - margin.bottom;

var x = d3.scaleBand().rangeRound([0, width]).padding(0.1),
    y = d3.scaleLinear().rangeRound([height, 0]);

var g = svg.append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
</script>
@endsection
