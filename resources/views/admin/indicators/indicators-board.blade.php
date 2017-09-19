@extends('layouts.admin.a_master')
@section('title', 'Lista de indicadores')
@section('description', 'Lista de indicadores de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', '')
@section('breadcrumb_type', 'indicator list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_indicators')
@section('content')


<div class="row">
	<div class="col-sm-9">
		<h1>Tablero de indicadores</h1>
	</div>
	<div class="col-sm-5">
		<p class="guia">
			<b class="cuadro completado"></b> <span>Completado</span>
			<b class="cuadro proceso"></b> <span>En Proceso</span>
			<b class="cuadro sin_avance"></b><span>Sin completar</span>
		</p>
	</div>
</div>

<div class ="box">
<!-- list-title-->
	<div class="row list-title">
		<div class="col-sm-1">
		</div>
		<div class="col-sm-3">
			<h3>Indicador</h3>
		</div>
		@foreach($modules as $module)
		<div class="col-sm-2">
			<h3>{{$module->title}} <small>{{date('d-m-Y', strtotime($module->start))}}</small></h3>
		</div>
		@endforeach
		<div class="col-sm-2">
			<h3>RESULTADO </h3>
		</div>
	</div>
<!-- ends list-title-->

<!--Indicador 1-->
<div class="row list-key">
	<div class="col-xs-3 col-sm-1 id">
		<h4>1</h4>
		<div class="plus">
			<a class="show" title="responsable-1"></a>
		</div>
	</div>
	<div class="col-xs-9 col-sm-3 ct">
		<p>Percepción de facilitadores</p>
	</div>
	<section class="mobile responsable-1">
		@foreach($modules as $module)
			<div class="col-xs-12  col-sm-2 ct">
			<?php //contamos objetivos por avance
				$total_ob 	= $module->sessions->count();
				$ob 		= 0;
			?>
			@foreach($module->sessions as $session)
			<?php
				$status = "Sin completar";	?>
				@if ($module->sessions->count() != 4)
				@foreach($session->facilitators as $facilitator)
				 @if($facilitator->user->email != 'contacto@prosociedad.org')
				 <?php
					 $status = "completado";	?>
				 @endif
				@endforeach
					<?php
						$ob++;	?>
					 <!-- con más tiempo corrijo el cálcuo X___x porque presiento que no va a funcionar visualmente ajustar al ancho -->
					 @if ($ob == 1)
					 <ul class="cumplimiento clearfix">
						 @endif
							<?php
								// rústico el asunto mientras aprueban
								switch ($total_ob) {
									case $total_ob == 1: $class_link = ""; break;
									case $total_ob == 2: $class_link = "two"; break;
									case $total_ob == 3: $class_link = "three"; break;
									case $total_ob == 4: $class_link = "four"; break;
							//   	case $total_ob == 13 && $ob == 11 : $class_link ="three"; break;
								// 	case $total_ob == 13 && $ob == 12 : $class_link ="three"; break;
								 //	case $total_ob == 13 && $ob == 13 : $class_link ="three"; break;
									case $total_ob >= 5: $class_link = "five"; break;
									default:
										$class_link = "";
									break;
								}
							?>


							<li class="resultado_link {{$class_link}}">
							<a href="#" class="objetivo {{$status}}"></a>
							@if ($session->name)
							<ul>
									<li><div class="detalle">
										<p>{{$session->name}}</p>
										<h4></h4>
										<p class="row"><span class="col-md-6">{{$session->description}}</span>
											@foreach($session->facilitators as $facilitator)
											 @if($facilitator->user->email != 'contacto@prosociedad.org')
															@if($facilitator->count_answers($session->id,$facilitator->user->id))
																<span class="col-md-6"> <a href='{{url("dashboard/indicadores/facilitadores-modulos/{$session->id}/{$facilitator->user->id}")}}' class="medios">Ver</a></span>
															@endif
											 @endif
											@endforeach
									</p>
									@foreach($session->facilitators as $facilitator)
									@if($facilitator->user->email != 'contacto@prosociedad.org')
										<p>Facilitadores: {{$facilitator->user->name}} </p>
									@endif
									@endforeach
										</div>
									</li>
							</ul>
							@endif
						</li>

						 @if ($ob == $total_ob)
					 </ul>
						 @endif
				@endif
			@endforeach
			</div>
		@endforeach

	</section>
</div>
<!-- ends list-->
<!-- info responsable-->
<div id="responsable-1" class="row list-responsable">
	<div class="col-sm-4 col-sm-offset-1 ct">
		<p>
			<span class="commitment_description more">
					Proporción de facilitadores evaluados favorablemete por parte de los agentes de cambio
			</span>
		</p>

	</div>
</div>



</div>




<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
			  <thead>
			    <tr>
			      <th>Indicador</th>
			      <th>Descripción</th>
			      <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			      <tr>
			        <td><h4><a>Percepción de facilitadores</a></h4></td>
			        <td>Proporción de facilitadores evaluados favorablemete por parte de los agentes de cambio</td>
			        <td>
								<a href="{{ url('dashboard/indicadores/facilitadores-modulos') }}" class="btn xs view">Ver</a>
			         <!-- <a href="{{ url('dashboard/indicadores/facilitadores/descargar') }}" class="btn xs view">Descargar</a>-->
              </td>
			    </tr>
          <tr>
            <td><h4>Percepción de fellows</h4></td>
            <td>Porcentaje de agentes de cambio que tienen una percepción positiva de la plataforma web</td>
            <td>
              <a href="{{ url('dashboard/indicadores/satisfaccion') }}" class="btn xs view">Ver</a>
              <a href="{{ url('dashboard/indicadores/fellows/descargar') }}" class="btn xs view">Descargar PDF</a>
							 <a href="{{ url('dashboard/indicadores/fellows/descargar/xlsx') }}" class="btn xs view">Descargar XLSX</a>
            </td>
        </tr>
			  </tbody>
			</table>
		</div>
	</div>
</div>
@endsection
