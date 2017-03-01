@extends('layouts.frontend.master')
@section('title', 'Aviso de Privacidad del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Aviso de Privacidad del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'privacidad')
@section('canonical', url('aviso-privacidad'))

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>Aviso de <strong>Privacidad</strong></h1>
		<h2>Del responsable de tratar sus datos personales</h2>
		<p>El Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales (INAI), con domicilio en Av. Insurgentes Sur, No. 3211, Col. Insurgentes Cuicuilco, Coyoacán, C.P. 04530, Ciudad de México, es el responsable del tratamiento de los datos personales que nos proporcione, los cuales serán protegidos conforme a lo dispuesto en la Ley General de Protección de Datos Personales en Posesión de Sujetos Obligados,<a href="#name1"><sup>1</sup></a> y demás normatividad que resulte aplicable. </p>

		<h2>De los datos a recabar</h2>
		<p>La información que se recabará consiste en: nombre completo del postulante, edad, empleo, domicilio, correo electrónico, teléfono fijo y/o celular, los datos personales contenidos en currículum y comprobante de domicilio. </p>

		<h2>Fundamento para el tratamiento de datos personales</h2>
		<p>El INAI tratará los datos personales con fundamento en los artículos 1, 2, fracciones II y V, 3 fracción XXVIII 4, y 25 de la Ley General de Protección de Datos Personales en Posesión de Sujetos Obligados. Para las finalidades ulteriores señaladas.</p>


		<h2>Finalidades</h2>
		<p>Los datos personales que recabaremos los utilizaremos para las siguientes finalidades:</p>
		<ul>
			<li>Cumplir con lo establecido en la Convocatoria y en los Procesos de Selección de Candidatos al Programa;</li>
			<li>Integrar el registro de postulantes a la Convocatoria;												   </li>
			<li>Identificar a los postulantes;																		   </li>
			<li>Comunicar a los postulantes los resultados de la Convocatoria;										   </li>
			<li>Entrar en contacto con los postulantes para asuntos relacionados con la Convocatoria;				   </li>
			<li>Publicar el nombre de los candidatos seleccionados, y												   </li>
			<li>Establecer comunicaciones futuras relacionadas con la temática de los Convocantes.					   </li>
		</ul>
		<p>De manera adicional, los datos recabados se utilizarán para generar estadísticas e informes sobre los resultados de la Convocatoria en mención. No obstante, es importante señalar que en estas estadísticas e informes, la información no estará asociada con el titular de los datos personales, por lo que no será posible identificarlo, con excepción del nombre de los aspirantes seleccionados.</p>
		<p>Para conocer mayor información sobre los términos y condiciones en que serán tratados sus datos personales, como los terceros con quienes compartimos su información personal y la forma en que podrá ejercer sus derechos ARCO, puede consultar el aviso de privacidad integral en <a href="{{url('archivos/ConsentimientoDatosPersonales.docx')}}" download>{{url('archivos/ConsentimientoDatosPersonales.docx')}}</a>.</p>
		<div class="notes">
		<a id="name1"></a>
		<p><sup>1</sup>  Publicada en el Diario Oficial de la Federación el veintiséis de enero de dos mil diecisiete.
</p>
		</div>
	</div>
</div>
@endsection