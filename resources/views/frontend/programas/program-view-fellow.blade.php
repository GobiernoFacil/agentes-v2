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
		<h2>Ver fellow</h2>
    <div class="row">
			<div class="col-sm-10">
        <p class="">
          @if($fellow->image)
          <img src='{{url("img/users/{$fellow->image->name}")}}' height="150px">
          @else
          <img src='{{url("img/users/default.png")}}' height="150px">
          @endif
        </p>
        <h2>{{$fellow->name." ".$fellow->fellowData->surname." ".$fellow->fellowData->lastname}}</h2>
        <h3>Procedencia: <strong>{{$fellow->fellowData->origin ? $fellow->fellowData->origin : "Sin información"}}</strong></h3>
        <div class="divider"></div>
        <ul>
          <li class="col-sm-4"><span>Nivel de estudios</span> {{$fellow->fellowData->degree}}</li>
          <li class="col-sm-4"><span>Email</span> {{$fellow->email}}</li>
          <li class="col-sm-4"><span>Ciudad, Estado</span> {{$fellow->fellowData->city}}, {{$fellow->fellowData->state}}</li>

        </ul>
        <p>{{$fellow->fellowData->semblance}}</p>
        <p>{{$fellow->fellowData}}</p>
			</div>

			<div class="col-sm-2">
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
