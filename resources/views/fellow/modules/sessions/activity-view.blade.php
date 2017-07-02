@extends('layouts.admin.a_master')
@section('title', $activity->name )
@section('description', $activity->name)
@section('body_class', 'fellow aprendizaje modulos')
@section('breadcrumb_type', 'activity view')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_modules')

@section('content')
<?php $today = date("Y-m-d");?>
<div class="row">
	<div class="col-sm-12">
		<?php switch($activity->type) {
			case "lecture":
				$type = "Lectura";
				break;
			case "video":
				$type = "Video";
				break;
			case "evaluation":
				$type = "Evaluación";
				break;
			default:
			 $type = "Lectura";
		}
		?>
		@if(Session::has('success'))
		<div class="message success">
	      {{ Session::get('success') }}
	  	</div>
	  	@endif

			@if(Session::has('error'))
			<div class="message error">
		      {{ Session::get('error') }}
		  	</div>
		  	@endif
		<h4>Actividad #{{$activity->order}} de la <a href="{{ url('tablero/aprendizaje/'.$session->module->slug.'/'. $session->slug) }}" class="link">sesión {{$session->order}}</a> del <a href="{{ url('tablero/aprendizaje/'.$session->module->slug) }}" class="link">módulo: {{$session->module->title}}</a></h4>
		<div class="divider b"></div>
		<h1><b class="icon_h {{$activity->type ? $activity->type  : 'default'}} list_s width_s"></b> {{$type}}: <strong>{{$activity->name}}</strong> <span class="notetime">(<b class="icon_h time"></b>{{$activity->duration}})</span></h1>
		<div class="divider"></div>
		<h2>Fecha límite: {{ date("j / m / Y", strtotime($activity->end))}}</h2>
	</div>
</div>

<div class="box">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<ul class="profile list row">
				<li class="col-sm-12"><span>Descripción:</span>{{$activity->description}}</li>
				<li class="col-sm-6"><span>Rol Facilitador:</span>{{$activity->facilitator_role}}</li>
				<li class="col-sm-6"><span>Rol Participantes:</span>{{$activity->competitor_role}}</li>
			</ul>
		</div>

	</div>
	@if($activity->slug ==='examen-diagnostico' && !$user->diagnostic)
	<div class="row">
		<div class="col-sm-3 col-sm-offset-1">
				<a href='{{ url("tablero/aprendizaje/examen-diagnostico/examen-diagnostico/examen/evaluar") }}' class="btn gde"><strong>+</strong> Ir a evaluación</a>
		</div>
	</div>
	@endif
	@if($activity->slug ==='examen-diagnostico' && $user->diagnostic)
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<div class="box blue center">
				<h2>Ya respondiste el examen</h2>
			</div>
		</div>
	</div>
	@endif
</div>

@if($activity->type ==='evaluation' && $activity->files==='No' && $activity->slug !='examen-diagnostico' && $activity->quizInfo)
	@if(!$score)
			@if($activity->end >= $today )
				<div class="box">
					<div class="row">
						<div class="col-sm-3 col-sm-offset-1">
								<a href='{{ url("tablero/evaluacion/$activity->slug") }}' class="btn gde"><strong>+</strong> Ir a evaluación</a>
						</div>
					</div>
				</div>
			@else
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="box blue center">
						<h2>El tiempo para responder el examen ha terminado</h2>
					</div>
				</div>
			</div>
			@endif
		@else
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="box blue center">
					<h2>Ya respondiste el examen</h2>
				</div>
			</div>
		</div>
		@endif
@elseif($activity->type ==='evaluation' && $activity->files==='Sí' && $activity->slug !='examen-diagnostico')
<div class="box">
	<div class="row">
		@if(!$files)
			@if($activity->end >= $today )
					<div class="col-sm-3 col-sm-offset-1">
							<a href='{{ url("tablero/archivos/$activity->slug/agregar") }}' class="btn gde"><strong>+</strong> Subir archivo</a>
					</div>
					@else
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
							<div class="box blue center">
								<h2>El tiempo para subir el archivo ha terminado</h2>
							</div>
						</div>
					</div>
					@endif
		@else
		<div class="col-sm-10 col-sm-offset-1">
			<div class="box blue center">
				<h2>Ya cuentas con un archivo</h2>
			</div>
		</div>
		@endif
	</div>
</div>
@endif

@if($activity->activityRequirements->count() > 0)
<!-- recursos-->
<div class="box">
	<div class="row">
		<div class="col-sm-9">
			<h2 class="title">Recursos</h2>
  		</div>
  		<div class="col-sm-12">
  			@include('admin.modules.activities.activities-requirements-list')
  		</div>
  	</div>
</div>
@endif

@if($activity->activityFiles->count() > 0)
<!--archivos-->
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="title">Archivos</h2>
			@include('admin.modules.activities.activities-files-list')
		</div>
	</div>
</div>
@endif

@if($activity->forum)
@include('layouts.forums.list-at-activity')
@endif



@endsection
