@extends('layouts.frontend.master')
@section('title', 'Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible 2018')
@section('description', 'Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible 2018')
@section('body_class', 'programa 2018')
@section('canonical', url("programa-gobierno-abierto/$program->slug/ver-generacion/ver-fellow/$slug"))
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_programa')

@section('content')

<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
    <?php $date = new DateTime($program->start);?>
		<h1>Edición {{$date->format('Y')}} - PROGRAMA DE FORMACIÓN DE <strong>AGENTES LOCALES DE CAMBIO</strong> EN <strong>GOBIERNO ABIERTO</strong> Y DESARROLLO SOSTENIBLE<a href="#nota"><sup>1</sup></a></h1>
		
	</div>	
	<div class="col-sm-10 col-sm-offset-1">
				<p class="center">
					<figure class="ap_figure">
						@if($fellow->image)
						<img src='{{url("img/users/{$fellow->image->name}")}}' height="100%">
						@else
						<img src='{{url("img/users/default.png")}}' height="100%">
						@endif
					</figure>
				</p>
				<h2 class="ap_title_profile">{{$fellow->name." ".$fellow->fellowData->surname." ".$fellow->fellowData->lastname}}</h2>
				<h3 class="ap_subtitle"><span>Procedencia:</span> <strong>{{$fellow->fellowData->origin ? $fellow->fellowData->origin : "Sin información"}}</strong></h3>
				<p class="center">{{$fellow->fellowData->city}}, {{$fellow->fellowData->state}}</p>
				<p class="center">
				@if($fellow->fellowData->twitter)
				<a href="{{$fellow->fellowData->twitter}}" class="facilitador_i tw"></a>
				@endif
				@if($fellow->fellowData->facebook)
				<a href="{{$fellow->fellowData->facebook}}" class="facilitador_i fb"></a>
				@endif
				@if($fellow->fellowData->linkedin)
				<a href="{{$fellow->fellowData->linkedin}}" class="facilitador_i lk"></a>
				@endif
				@if($fellow->fellowData->other)
				<a href="{{$fellow->fellowData->other}}">{{$fellow->fellowData->other}}</a>
				@endif
				</p>
				
				<div class="divider"></div>
				<div class="row ap_info_pro">
				  <div class="col-sm-4"><p><span class="ap_info_sub">Nivel de estudios</span> {{$fellow->fellowData->degree}}</p></div>
				  <div class="col-sm-4"><p><span class="ap_info_sub">Email</span> {{$fellow->email}}</p></div>
				  <div class="col-sm-4"><p><span class="ap_info_sub">Sitio web:</span> {{$fellow->fellowData->web ? $fellow->fellowData->web : 'Sin información'}}</p></div>
				</div>
				<div class="divider"></div>
				<p class="ap_description"><span class="ap_info_sub">Semblanza</span>
					{{$fellow->fellowData->semblance}}</p>
				
			<div class="divider"></div>
				
		</div>
		<div class="col-sm-10 col-sm-offset-1">
				<a name="nota"></a>
				<div class="notes">
				<p><sup>1</sup> El <strong>Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</strong> es promovido por el Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales (INAI), la Oficina para México del Programa de Naciones Unidas para el Desarrollo (PNUD-México), GESOC, Agencia para el Desarrollo, A.C., ProSociedad Hacer Bien el Bien, A.C., y Gobierno Fácil – con el apoyo de la Agencia de los Estados Unidos para el Desarrollo Internacional (USAID) en el marco del proyecto: “Local Capacities in Open Government (OG) for the Achievement of the Sustainable Development Goals (SGDs) in Mexico /Programa de fortalecimiento de capacidades en gobierno abierto para el cumplimiento de los objetivos de desarrollo sostenible en lo local.”</p>
		</div>
	</div>
</div>
@endsection
