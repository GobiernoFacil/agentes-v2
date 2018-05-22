@extends('layouts.admin.a_master')
@section('title', 'Ver actividad: ' . $activity->name)
@section('description', 'Ver actividad')
@section('body_class', 'actividades')
@section('breadcrumb_type', 'activity view')
@section('breadcrumb', 'layouts.facilitator.breadcrumb.b_activity')

@section('subnav', 1)
@section('subnav_week', 1)

@section('content')

<?php $today = date("Y-m-d");?>
<!--- type-->
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
		<h1><strong>{{$type}}:</strong> {{$activity->name}} <span class="le_link"><a href="{{url('dashboard/sesiones/actividades/editar/' . $activity->id)}}" class="btn view">Editar Actividad</a></span </h1>
		<p><span class="notetime"><strong>Duración</strong>: {{$activity->duration}} {{$activity->measure ? ' hrs.' : ' min.'}}</span></p>
		<div class="divider"></div>
	</div>
</div>



@if($activity->type == 'video')
<!---------------------------------------------------------------------------------- videos--------------------------------------------->
	@if($activity->videos)
	<div class="row">
		<div class="col-sm-12">
			<div id="ytVideo"></div>
		</div>
	</div>
	@endif
@endif


<!--- description-->
<div class="row">
	<div class="col-sm-12">
		<p class="ap_textareacontent">{{$activity->description}}</p>
	</div>
</div>

@if($activity->slug ==='examen-diagnostico')
<!---------------------------------------------------------------------------------- examen de diagnostico ------------------------------------>
	@include('admin.modules.activities.diagnostic-view')
@endif

@if($activity->type ==='evaluation' && !$activity->files && $activity->slug !='examen-diagnostico')
<!---------------------------------------------------------------------------------- evaluación ------------------------------------>
	@include('admin.modules.activities.evaluation-view')
@elseif($activity->type ==='evaluation' && $activity->files=== 1 && $activity->slug !='examen-diagnostico')
<div class="box">
	<div class="row">
		<div class="col-sm-9">
			<h2 class="title">Evaluación</h2>
		</div>
		<div class="col-sm-8 col-sm-offset-2">
			<p>Carga de archivo</p>
		</div>
	</div>
</div>
@endif

@if($activity->type === 'diagnostic')
	@include('admin.modules.activities.diagnostic-test-view')
@endif


@if(!empty($activity->forum))
<!---------------------------------------------------------------------------------- foro ------------------------------------>
@include('layouts.forums.list-at-activity')
@endif


@if($activity->activityFiles->count() > 0)
<!---------------------------------------------------------------------------------- lecturas con archivos ------------------------------------>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			@foreach ($activity->activityFiles as $file)
			<object data='{{url("dashboard/sesiones/actividades/archivos/ver-pdf/$file->id")}}' type="application/pdf" width="100%" height="600px">


				<p<a href='{{url("dashboard/sesiones/actividades/archivos/descargar/$file->id")}}'>{{$file->name}}</a></p>
			</object>
			@endforeach

			@include('admin.modules.activities.activities-files-list')
		</div>
	</div>
</div>
@else
	@if($activity->type == 'lecture')

	<div class="box last_activity">
		<p>Sin archivo</p>
		<a href='{{url("dashboard/sesiones/actividades/archivos/agregar/nuevo/$activity->id")}}' class="btn xs view">Agregar archivo</a>
	</div>
	@endif
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


<div class="subnav bottom">
	<div class="center">
		<a {{$prev ? 'href='.url("dashboard/sesiones/actividades/ver/$prev") : ''}}><strong>&lt;</strong> Anterior</a>
		<a {{$next ? 'href='.url("dashboard/sesiones/actividades/ver/$next") : ''}}>Siguiente <strong>&gt;</strong></a>
	</div>
</div>

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
