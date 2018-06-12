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
			case "final":
				$type = "Evaluación final";
				break;
			case "diagnostic":
			  $type = "Evalaución diagnóstico";
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
		<h1><strong>{{$type}}:</strong> {{$activity->name}}</h1>
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

@if($activity->type ==='diagnostic')
<div class="box">
	<div class="row">
		<div class="col-sm-9">
			<h2 class="title">Evaluación diagnóstico</h2>
		</div>
		<div class="col-sm-8 col-sm-offset-2">
			<a href='{{url("tablero-facilitador/actividad-diagnostico/$activity->id")}}' class="btn xs view">Ver evaluaciones</a>
		</div>
	</div>
</div>
@endif

@if($activity->type ==='evaluation' && !$activity->files)
<div class="box">
	<div class="row">
		<div class="col-sm-9">
			<h2 class="title">Evaluación</h2>
		</div>
			<?php /*
		<div class="col-sm-8 col-sm-offset-2">
			<a href='{{url("tablero-facilitador/actividad-evaluacion/$activity->id")}}' class="btn xs view">Ver evaluaciones</a>
		</div>
		*/
		?>
	</div>
</div>
@elseif($activity->type ==='evaluation' && $activity->files)
<div class="box">
	<div class="row">
		<div class="col-sm-9">
			<h2 class="title">Evaluación</h2>
			<h4>Carga de archivo</h4>
		</div>
		<?php /*
		<div class="col-sm-8 col-sm-offset-2">
			<a href='{{url("tablero-facilitador/actividad-evaluacion/$activity->id")}}' class="btn xs view">Ver archivos</a>
		</div>
		*/
		?>
	</div>
</div>
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
			<object data='{{url("tablero-facilitador/actividades/archivos/ver-pdf/$file->id")}}' type="application/pdf" width="100%" height="600px">
				<p<a href='{{url("tablero-facilitador/actividades/archivos/descargar/$file->id")}}'>{{$file->name}}</a></p>
			</object>
			@endforeach
			@include('admin.modules.activities.activities-files-list')
		</div>
	</div>
</div>
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
		<a {{$prev ? 'href='.url("tablero-facilitador/actividades/ver/$prev") : ''}}><strong>&lt;</strong> Anterior</a>
		<a {{$next ? 'href='.url("tablero-facilitador/actividades/ver/$next") : ''}}>Siguiente <strong>&gt;</strong></a>
	</div>
</div>

@endsection

@section('js-content')
<script>
	var module     = {!! json_encode($activity->session->module) !!},
	    sessions   = {!! json_encode($activity->session->module->sessions) !!},
	    activities = [];
	    activities.push({!! json_encode($session->activities) !!});
</script>

<script src="{{url('js/app-display-week-menu.js')}}"></script>
@endsection
