<?php $date = new DateTime($program->start);?>
@extends('layouts.frontend.master')
@section('title', 'Conoce el contenido del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible '.$date->format('Y'))
@section('description', 'Conoce el contenido del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible '.$date->format('Y'))
@section('body_class', 'program_content')
@section('canonical', url('programa-gobierno-abierto/'.$program->slug.'/ver-contenido'))
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_programa')

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>Edición {{$date->format('Y')}} - PROGRAMA DE FORMACIÓN DE <strong>AGENTES LOCALES DE CAMBIO</strong> EN <strong>GOBIERNO ABIERTO</strong> Y DESARROLLO SOSTENIBLE<a href="#nota"><sup>1</sup></a></h1>
		<h2>Conoce el contenido</h2>
    <div class="row">
			<div class="col-sm-9">
			@foreach($program->modules as $module)
       @if($module->get_all_activities_with_content()->count() > 0)
				<ul class="toggle-view">
					<!---fellows-->
				<li>
					<span></span>
					<h3>{{$module->title}}</h3>
					<div class="panel">
					<ol>
              @foreach($module->sessions as $session)
							   @foreach($session->activities as $activity)
									 @if($activity->type==='lecture' || $activity->type==='video' )
			                        @if($activity->type==='lecture' && $activity->activityFiles->count() > 0 )
															<li>{{$activity->name}}
																<ul>
			                          @foreach($activity->activityFiles as $file)
			                            <li>
			                              <a target="_blank" href ='{{url("programa-gobierno-abierto/{$program->slug}/ver-archivo/{$file->identifier}")}}'>{{$file->name}}</a>
			                            </li>
			                          @endforeach
						                    </ul>
						                  </li>
			                        @elseif($activity->type==='video' && $activity->videos->link)
																<li>{{$activity->name}}
																	<ul>
				                          <li>
				                           <a target="_blank" href ={{$activity->videos->link}}>Video</a>
				                          </li>
																</ul>
															</li>
			                        @endif
											@endif
									@endforeach
              @endforeach
					</ol>
					</div>
				</li>
				</ul>
        @endif
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
		<div class="notes">
			<p> Derechos Reservados © 2019 Programa de las Naciones Unidas para el Desarrollo (PNUD)</p>
			<p> Este programa de formación fue posible gracias al apoyo del pueblo de los Estados Unidos, a través de la Agencia de los Estados Unidos para el Desarrollo Internacional (USAID). El contenido de este programa de formación es responsabilidad del proyecto “Apoyando el cumplimiento de los Objetivos de Desarrollo Sostenible en México por medio de prácticas de gobierno abierto, participación ciudadana y el fortalecimiento de la transparencia” y no necesariamente refleja el punto de vista de USAID o del gobierno de los Estados Unidos; ni del Programa de las Naciones Unidas para el Desarrollo, de su Junta Directiva, ni de sus Estados Miembros.</p>
			<p>El contenido de este material se produjo en coordinación con el Grupo de Trabajo (GT) del Proyecto, sin embargo, no refleja necesariamente las opiniones institucionales de los integrantes del GT (PNUD, INAI, GESOC A.C., Gobierno Fácil, ProSociedad).</p>
		</div>
	</div>
</div>
@endsection
