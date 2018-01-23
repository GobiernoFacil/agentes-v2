@extends('layouts.frontend.master')
@section('title', 'Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible 2018')
@section('description', 'Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible 2018')
@section('body_class', 'programa 2018')
@section('canonical', url('programa-gobierno-abierto/2018'))
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_programa')

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>Edición 2018 - PROGRAMA DE FORMACIÓN DE <strong>AGENTES LOCALES DE CAMBIO</strong> EN <strong>GOBIERNO ABIERTO</strong> Y DESARROLLO SOSTENIBLE<a href="#nota"><sup>1</sup></a></h1>
		
		<div class="row">
			<div class="col-sm-9">
				<p>Estamos preparando el contenido de la edición 2018, pronto actualizaremos la información, mientras puedes consultar la <a href="{{url('programa-gobierno-abierto/2017')}}">edición 2017</a>.</p>
			</div>
			<div class="col-sm-3">
				<h2></h2>
				<a href="{{url('programa-gobierno-abierto/alcance')}}" class="icon i_alcance"><span>ALCANCE DEL PROGRAMA</span></a>
				<a href="{{url('programa-gobierno-abierto/aliados')}}" class="icon i_aliados">CONOCE A LOS ALIADOS</a>
				<a href="{{url('convocatoria')}}" class="icon i_convocatoria"><span>CONVOCATORIA</span></a>
				<a href="{{url('programa-gobierno-abierto/antecedentes')}}" class="icon i_antecedentes">ANTECEDENTES</a>
			</div>

		</div>

		<a name="nota"></a>
		<div class="notes">
		<p><sup>1</sup> El <strong>Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</strong> es promovido por el Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales (INAI), la Oficina para México del Programa de Naciones Unidas para el Desarrollo (PNUD-México), GESOC, Agencia para el Desarrollo, A.C., ProSociedad Hacer Bien el Bien, A.C., y Gobierno Fácil – con el apoyo de la Agencia de los Estados Unidos para el Desarrollo Internacional (USAID) en el marco del proyecto: “Local Capacities in Open Government (OG) for the Achievement of the Sustainable Development Goals (SGDs) in Mexico /Programa de fortalecimiento de capacidades en gobierno abierto para el cumplimiento de los objetivos de desarrollo sostenible en lo local.”</p>
		</div>
	</div>
</div>
@endsection
