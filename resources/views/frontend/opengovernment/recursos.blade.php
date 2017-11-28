@extends('layouts.frontend.master')
@section('title', 'Lecturas sobre Gobierno Abierto')
@section('description', 'Lecturas sobre Gobierno Abierto')
@section('body_class', 'abierto lecturas')
@section('canonical', url('gobierno-abierto/recursos/lecturas') )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_gobiernoabierto')


@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>Lecturas de Gobierno <strong>Abierto</strong></h1>
		<p>Algunos recursos para conocer más acerca de <a href="{{ url('gobierno-abierto')}}">Gobierno Abierto</a>.</p>
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		<ol>
			<li><h2><a href="{{url('gobierno-abierto/recursos/modelo-gobierno-abierto')}}">Documento Teórico del Modelo de Gobierno Abierto</a> </h2>	 
			<p>Sistema Nacional de Transparencia, Acceso a la Información Pública y Protección de Datos Personales, 18 de marzo de 2016. </p>
			</li>
			<li>
				<h2><a href="http://proyectos.inai.org.mx/enaid2016/">Encuesta Nacional de Acceso a la Información Pública y Protección de Datos Personales ENAID 2016</a> <span>[en línea]</span></h2>
				<p>Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales (INAI), e Instituto Nacional de Estadística y Geografía (INEGI), 3 de octubre de 2016.</p> 
				</p>
			</li>
			<li>
				<h2><a href="http://proyectos.inai.org.mx/cntaid2016/">Censo Nacional de Transparencia, Acceso a la Información Pública y Protección de Datos Personales 2016</a> <span>[en línea]</span></h2>
				<p>Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales (INAI), e Instituto Nacional de Estadística y Geografía (INEGI), diciembre de 2016.</p> 
				</p>
			</li>
			<li>
				<h2><a href="https://biblio.juridicas.unam.mx/bjv/detalle-libro/4016-gobierno-abierto-y-el-valor-de-la-informacion-publica">Gobierno abierto y el valor de la información pública</a> <span>[en línea]</span></h2>
				<p>Instituto Tabasqueño de Transparencia y Acceso a la Información Pública, e Instituto de Investigaciones Jurídicas, UNAM, 2015.</p> 
				</p>
			</li>
			
		</ol>
	</div>
</div>
@endsection