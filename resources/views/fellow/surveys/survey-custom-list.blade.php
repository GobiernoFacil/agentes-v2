@extends('layouts.admin.a_master')
@section('title', 'Encuestas en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Encuestas en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'fellow')
@section('breadcrumb_type', 'survey session list')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_survey')

@section('content')
@if($modules->count() > 0)
<div class="box">
	<div class="row">
    	<div class="col-sm-10 col-sm-offset-1">
			<h3 class="title center">Lista de encuestas de facilitadores por sesión</h3>
			<p class= "center">Selecciona un facilitador para responder una encuesta anónima </p>
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
								<div class="col-sm-5">
								Facilitador
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
													<div class="col-sm-6">
														<p>{{$facilitator->user->name}}</p>
									    			</div>
													<div class="col-sm-4">
													@if(!$questionnaire->facilitator_survey($session->id,$user->id,$facilitator->user->id))
														<a href='{{ url("tablero/encuestas/facilitadores-sesiones/{$session->slug}/c/{$facilitator->user->name}")}}' class="btn xs view">Ir a encuesta</a>
													@else
														Completada
													@endif
													</div>
												</li>
                     @else

                       <li class="row">
                         <div class="col-sm-2">
                         @if($facilitator->user->image)
                           <img src='{{url("img/users/{$facilitator->user->image->name}")}}' width="100%">
                         @else
                           <img src='{{url("img/users/default.png")}}' width="100%">
                         @endif
                           </div>
                         <div class="col-sm-6">
                           <p>{{$facilitator->user->name}}</p>
                           </div>
                         <div class="col-sm-4">
                         @if(!$questionnaire->facilitator_survey($session->id,$user->id,14))
                           <a href='{{ url("tablero/encuestas/facilitadores-sesiones/{$session->slug}/c/Carlos Bauche Madero")}}' class="btn xs view">Ir a encuesta</a>
                         @else
                           Completada
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
