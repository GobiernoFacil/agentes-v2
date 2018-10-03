@extends('layouts.frontend.master')
@section('title', 'Conoce a los fellows del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible 2018')
@section('description', 'Conoce a los fellows del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible 2018')
@section('body_class', 'programa 2018 generacion')
@section('canonical', url('programa-gobierno-abierto/'.$program->slug))
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_programa')

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
    <?php $date = new DateTime($program->start);?>
		<h1>Edición {{$date->format('Y')}} - PROGRAMA DE FORMACIÓN DE <strong>AGENTES LOCALES DE CAMBIO</strong> EN <strong>GOBIERNO ABIERTO</strong> Y DESARROLLO SOSTENIBLE<a href="#nota"><sup>1</sup></a></h1>
		<h2>Conoce a los fellows</h2>
    <div class="row">
			<div class="col-sm-9">
			@foreach($states as $state)
				<ul class="toggle-view">
					<!---fellows-->
				<li>
					<span></span>
					<h3>{{ strpos( $state->state,"xico")  ? "Estado de México" : $state->state }}</h3>
					<div class="panel">
					<ol>
						@foreach($program->get_fellows_by_state($state->state) as $fellow)
							<li>
								<?php $slug =str_slug($fellow->name);  ?>
								<a href = '{{url("programa-gobierno-abierto/$program->slug/ver-generacion/ver-fellow/{$slug}")}}'>
									<figure class="ap_figure xs">
									@if($fellow->image)
										<img src='{{url("img/users/{$fellow->image->name}")}}' height="100%">
									@else
										<img src='{{url("img/users/default.png")}}' height="100%">
									@endif
									</figure>
									<strong class="ap_generation_name">{{mb_convert_case($fellow->name,  MB_CASE_TITLE, 'UTF-8')}}</strong>
								</a>
						</li>
						@endforeach
						</ol>
					</div>
				</li>

				</ul>
			@endforeach
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
