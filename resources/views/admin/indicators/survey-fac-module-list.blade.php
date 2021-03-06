@extends('layouts.admin.a_master')
@section('title', 'Encuestas en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Encuestas en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', '')
@section('breadcrumb_type', 'indicator facilitator list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_indicators')
@section('content')
@if($modules->count() > 0)
<div class="box">
	<div class="row">
    	<div class="col-sm-10 col-sm-offset-1">
			<h3 class="title center">Lista de encuestas de facilitadores por sesión</h3>
			<p class= "center">Selecciona un facilitador para ver sus resultados </p>
			<div class="divider b"></div>
		</div>
		<div class="col-sm-12">
			<table class="table">
				<thead>
			    	<tr>
						<th>Módulo</th>
						<th>
							<div class="row">
								<div class="col-sm-5">
								Sesión
								</div>
								<div class="col-sm-3">
								Facilitador
								</div>
								<div class="col-sm-2">
								Usuarios con Percepción positiva
								</div>
								<div class="col-sm-2">
								Acción
								</div>
							</div>
						</th>
						<!--
						<th>Facilitador</th>
						<th>Acción</th>-->
			    	</tr>
				</thead>
				<tbody>
				@foreach($modules as $module)
			    	<tr>
						<td><h4>
							<!--<a href='{{url("tablero/encuestas/facilitadores/$module->slug/sesiones")}}'>-->{{$module->title}}<!--</a>--></h4></td>
						<td>

							<div class="row">
							@foreach($module->sessions as $session)
								<div class="col-sm-5">
									<h4>{{$session->name}}  </h4>
								</div>
								<div class="col-sm-7">
									<ul class="list line">
							    	@foreach($session->facilitators as $facilitator)
										 @if($facilitator->user->email != 'contacto@prosociedad.org')
												<li class="row">
													<div class="col-sm-2">
																@if($facilitator->user->image)
																	<img src='{{url("img/users/{$facilitator->user->image->name}")}}' width="100%">
																@else
																	<img src='{{url("img/users/default.png")}}' width="100%">
																@endif
									    			</div>
													<div class="col-sm-3">
														<p>
															@if($facilitator->count_answers($session->id,$facilitator->user->id))
																<a href='{{ url("dashboard/indicadores/facilitadores-modulos/{$session->id}/{$facilitator->user->id}")}}'>{{$facilitator->user->name}}</a>
															@else
																{{$facilitator->user->name}}
															@endif
														</p>
									    			</div>
														<div class="col-sm-3">
																	@if($facilitator->count_answers($session->id,$facilitator->user->id))
																		{{$facilitator->get_perception($session->id,$facilitator->user->id)}}
																	@else
																		Sin respuestas
																	@endif
										    			</div>
													<div class="col-sm-4">
														@if($facilitator->count_answers($session->id,$facilitator->user->id))
															<a href='{{ url("dashboard/indicadores/facilitadores-modulos/{$session->id}/{$facilitator->user->id}")}}' class="btn xs view">Ver</a>
                              <a href='{{ url("dashboard/indicadores/facilitadores/descargar/{$session->id}/{$facilitator->user->id}") }}' class="btn xs view"> PDF</a>
															<a href='{{ url("dashboard/indicadores/facilitadores/descargar/xlsx/{$session->id}/{$facilitator->user->id}") }}' class="btn xs view"> XLSX</a>
														@else
															Sin encuestas
														@endif
													</div>
												</li>
									 @endif
									@endforeach
									</ul>
								</div>
							@endforeach
							</div>
            			</td>
            			<!--
						<td> {{$module->created_at->diffForHumans()}}</td>
						<td><a href='{{url("tablero/encuestas/facilitadores/$module->slug/sesiones")}}' class="btn xs view">Seleccionar</a></td>-->
            		</tr>
      @endforeach
			  </tbody>
			</table>
		</div>
	</div>
</div>
@else
<div class="box">
	<div class="row center">
		<div class="col-sm-10 col-sm-offset-1">
			<h3 class="title center">Lista de módulos</h3>
			<div class="divider b"></div>
		</div>
		<div class="col-sm-3 col-sm-offset-4 center">
			<p>Sin módulos</p>
		</div>
	</div>
</div>
@endif
@endsection
