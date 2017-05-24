@extends('layouts.admin.a_master')
@section('title', 'Tablero de Control')
@section('description', 'Tablero de control de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'dashboard fellow')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Tablero de control</h1>
	</div>
	<div class="col-sm-12">
		<div class="box">
			<p>Bienvenido {{$user->name}} a la plataforma del <strong>Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</strong>.</p>
		</div>
	</div>
</div>

<!--actividad-->
<div class="row">
	<div class="col-sm-12">
		<h2>Tu última actividad</h2>
		<div class="box session_list">
	  	<div class="row">
			<!--icono-->
			<div class="col-sm-1 right">
				<b class="icon_h session list_s"></b>
			</div>
			<div class="col-sm-9">
				<h3>Sesión 1</h3>
				<h2><a href="http://pnud:8888/tablero/aprendizaje/propedeutico/la-sesion">La sesión</a></h2>
				<div class="divider"></div>
					<div class="row">
						<div class="col-sm-9">
							<p>Perder el tiempo</p>
						</div>
						<div class="col-sm-3 notes">
							<p class="right">Fechas:<br>21-04-2017 al 27-04-2017</p>
						</div>
					</div>
				</div>
				<!-- ver sesión-->
								<div class="col-sm-2">
					<a class="btn view block sessions_l" href="http://pnud:8888/tablero/aprendizaje/propedeutico/la-sesion">Ver sesión</a>
				</div>
								<!-- footnote-->
				<div class="footnote">
					<div class="row">
						<div class="col-sm-2">
							<p><b class="icon_h time"></b>3 h </p>
						</div>
						<div class="col-sm-2">
							<p><b class="icon_h modalidad"></b>Presencial</p>
						</div>
						<div class="col-sm-6">
														<p><strong>Facilitador:</strong>
																							<img src="http://pnud:8888/img/users/590b63a7f2ff6.png" height="30px">
																 Andre Gomes -  FC Barcelona <br>
														</p>
													</div>
						<div class="col-sm-2">
							<p class="right">6 actividades  </p>
						</div>
					</div>
				</div>
			</div>
	</div>
	
<!-- avance-->
<div class="row">
	<div class="col-sm-12">
		<h2>Tu avance</h2>
		<div class="box">
		<ul class="timeline">
					<li class="active">Propedeutico</li>
					<li class="disabled">Batman vs Superman</li>
				</ul>
		</div>
  	</div>
</div>
	
	
	<div class="row">
		<div class="col-sm-4 center">
				<div class="box ">
					<h3 class="sa_title">Tus Mensajes</h3>
					<a href="{{ url('tablero/mensajes') }}" class="count_link">{{$modules_count}}</a>
					<a href="{{ url('tablero/mensajes') }}" class="btn gde">Ver todos los mensajes</a>
				</div>
			</div>	
		<div class="col-sm-8">
				<div class="box ">
					<h3 class="sa_title">Tu participación en los foros</h3>
					<ul>
						<li class="row">
							<span class="col-sm-2">
							1 respuesta
							</span>
							<span class="col-sm-10">
							<h3>¿qué comen los pandas?</h3>
							<p class="right">Preguntado hace 2 días</p>
							</span>
						</li>
						<li class="row">
							<span class="col-sm-2">
							89 respuesta
							</span>
							<span class="col-sm-10">
							<h3>¿Qué es el gobierno abierto?</h3>
							<p class="right">Contestado hace 3 días</p>
							</span>
						</li>
						<li class="row">
							<span class="col-sm-2">
							109 respuesta
							</span>
							<span class="col-sm-10">
							<h3>¿Qué leyes obligan al gobierno a garantizar el acceso a la información?</h3>
							<p class="right">Preguntado hace 3 días</p>
							</span>
						</li>
					</ul>
					<a href="{{ url('tablero/mensajes') }}" class="btn gde center">Ver los foros</a>
				</div>
			</div>
		</div>
		
		<!--noticias-->
		<div class="col-sm-12">
			<h2>Noticias y avisos</h2>
			<ul>
				<li><h3>La noticia</h3>
				<p>descripción de la noticia</p>
				<p>Fecha</p>
				</li>
				<li><h3>La noticia</h3>
				<p>descripción de la noticia</p>
				<p>Fecha</p>
				</li>
			</ul>
		</div>
		
	</div>
	
</div>
@endsection
