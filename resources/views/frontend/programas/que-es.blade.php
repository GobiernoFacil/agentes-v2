@extends('layouts.frontend.master')
@section('title', 'Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'programa')
@section('canonical', url('programa-gobierno-abierto'))
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_programa')

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>PROGRAMA DE FORMACIÓN DE <strong>AGENTES LOCALES DE CAMBIO</strong> EN <strong>GOBIERNO ABIERTO</strong> Y DESARROLLO SOSTENIBLE <a href="#nota"><sup>1</sup></a></h1>
		<p>El programa tiene como propósitos el fortalecimiento de capacidades, la vinculación y empoderamiento de una <strong>red de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</strong> que promuevan la consolidación de acciones orientadas a fortalecer prácticas de transparencia y participación ciudadana a nivel local en México.  </p>

		<p>Este programa ofrecerá una plataforma única para el aprendizaje, la reflexión, el intercambio de ideas y experiencias, así como para la realización de proyectos que puedan ponerse en marcha en el corto plazo, y que utilicen las perspectivas de gobierno abierto y desarrollo sostenible para transformar alguna realidad de su localidad o región.</p>
		<p>Al concluir la etapa formativa, se esperaría que los egresados se integren y participen activamente en los trabajos que se realizan en su entidad federativa en el marco de los ejercicios locales de Gobierno Abierto promovidos por el INAI.</p>


		<div class="divider"></div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3 center">
				<a href="{{url('programa-gobierno-abierto/programa-2018')}}" class="btn blue">Programa 2018</a>
				<a href="{{url('programa-gobierno-abierto/2017')}}" class="btn blue">Programa 2017</a>
			</div>
		</div>
		<div class="row">
			<div class="divider"></div>


			<div class="col-sm-3">
				<a href="{{url('programa-gobierno-abierto/alcance')}}" class="icon i_alcance"><span>ALCANCE DEL PROGRAMA</span></a>
			</div>
			<div class="col-sm-3">
				<a href="{{url('programa-gobierno-abierto/aliados')}}" class="icon i_aliados">CONOCE A LOS ALIADOS</a>
			</div>
			<div class="col-sm-3">
				<a href="{{url('convocatoria')}}" class="icon i_convocatoria"><span>CONVOCATORIA</span></a>
			</div>
			<div class="col-sm-3">
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
