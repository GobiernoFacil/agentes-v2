@extends('layouts.admin.a_master')
@section('title', $activity->name )
@section('description', $activity->name)
@section('body_class', 'fellow aprendizaje modulos')
@section('breadcrumb_type', 'activity view')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_modules')
@section('subnav', 1)
@section('subnav_week', 1)

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
		<!--- session name-->
		<h4>{{$session->name}}</h4>
		<!--- activity title-->
		<div class="divider b"></div>
		<h1><strong>{{$type}}:</strong> {{$activity->name}} </h1>
		<p><span class="notetime"><strong>Duración</strong>: {{$activity->duration}} min.</span></p>
		<div class="divider"></div>

	</div>
</div>

@if($activity->type == 'video')
	@if($activity->videos)
	<div class="row">
		<div class="col-sm-12">
			<div id="ytVideo"></div>
		</div>
	</div>
	@endif
@endif





<div class="row">
	<div class="col-sm-12">
		<p>{{$activity->description}}</p>
	</div>

	</div>
	@if($activity->slug ==='examen-diagnostico' && !$user->diagnostic)
	<div class="row">
		<div class="col-sm-3 col-sm-offset-1">
				<a href='{{ url("tablero/aprendizaje/examen-diagnostico/examen-diagnostico/examen/evaluar") }}' class="btn gde">Comenzar evaluación <strong>&gt;&gt;</strong></a>
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
		<div class="col-sm-12">
				<div class="divider b"></div>
			</div>
	</div>
	@endif

@if($activity->type ==='evaluation' && $activity->files==='No' && $activity->slug !='examen-diagnostico' && $activity->quizInfo)
	@if(!$score)
			@if($activity->end >= $today )
				<div class="box">
					<div class="row">
						<div class="col-sm-3 col-sm-offset-1">
								<a href='{{ url("tablero/evaluacion/$activity->slug") }}' class="btn gde">Comenzar evaluación <strong>&gt;&gt;</strong></a>
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
				<div class="col-sm-12">
					<div class="divider b"></div>
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
			<div class="col-sm-12">
				<div class="divider b"></div>
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
						<div class="col-sm-12">
							<div class="divider b"></div>
						</div>
					</div>
					@endif
		@else
		<div class="col-sm-10 col-sm-offset-1">
			<div class="box blue center">
				<h2>Ya cuentas con un archivo</h2>
			</div>
		</div>
		<div class="col-sm-12">
				<div class="divider b"></div>
			</div>
		@endif
	</div>
</div>
@endif

@if($activity->activityRequirements->count() > 0)
	@if($activity->type == 'video')
	@else
	<!-- recursos-->
	<div class="row">
	  	<div class="col-sm-12">
		  	<div class="divider"></div>
	  		@include('admin.modules.activities.activities-requirements-list')
	  	</div>
	 </div>
	 @endif
@endif

@if($activity->activityFiles->count() > 0)
<!--archivos-->
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			@foreach ($activity->activityFiles as $file)
			<object data='{{url("tablero/aprendizaje/actividades/archivos/ver-pdf/$file->id")}}' type="application/pdf" width="100%" height="600px">
				<p<a href='{{url("tablero/aprendizaje/actividades/archivos/descargar/$file->id")}}'>{{$file->name}}</a></p>
			</object>
			<h4><a href='{{url("tablero/aprendizaje/actividades/archivos/descargar/$file->id")}}'>{{$file->name}}</a></h4>
			<p></p>
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<p><a href='{{url("tablero/aprendizaje/actividades/archivos/descargar/$file->id")}}' class="btn view block sessions_l">Descargar</a></p>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endif

@if($activity->forum)
@include('layouts.forums.list-at-activity')
@endif



@if($activity->type == 'video')
	@if($activity->videos)
		<script>
			function getId(url) {
				var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
				var match = url.match(regExp);
				if (match && match[2].length == 11) {
					return match[2];
				}
				else {
					return 'error';
    			}
			}

			var ytId = getId('{{$activity->videos->link}}');

			document.getElementById("ytVideo").innerHTML = '<iframe width="100%" height="555" src="//www.youtube.com/embed/' + ytId + '" frameborder="0" allowfullscreen></iframe>';
		</script>
	@endif
@endif


@endsection


@section('js-content')
<script>
	var module     = {!! json_encode($activity->session->module) !!},
	    sessions   = {!! json_encode($activity->session->module->sessions) !!},
	    activities = [];

	    @foreach($activity->session->module->sessions as $session)
	    activities.push({!! json_encode($session->activities) !!});
	    @endforeach
</script>

<script src="{{url('js/app-display-week-menu.js')}}"></script> 
@endsection
