<div class="box session_list last_activity">
	<div class="row">
		<!--icono-->
		<div class="col-sm-2">
			<h3>Semana:</h3>
		</div>
		<!--título-->
		<div class="col-sm-7">
			<h3>{{ $activity->session->module->title }}</h3>
			<h2>{{ $activity->session->name }}</h2>
			<?php switch ($activity->type) {
				case "lecture":
					$tipo_a = "Lectura";
					break;
				case "files":
					$tipo_a = "Lectura";
					break;
				case "video":
					$tipo_a = "Video";
					break;
				case "evaluation":
					$tipo_a = "Evaluación";
					break;
					case "diagnostic":
						$tipo_a = "Evaluación diagnóstico";
						break;
				default:
					$tipo_a = "";
			}?>

			<h4>{{$tipo_a}}: <a href='{{url("tablero/{$program->slug}/aprendizaje/{$activity->session->module->slug}/{$activity->session->slug}/$activity->slug")}}'>{{$activity->name}}</a></h4>
			<p>Duración: {{$activity->measure == 1 ? str_replace(".00", "", (string)number_format($activity->duration, 2, ".", "")).' h.' : str_replace(".00", "", (string)number_format($activity->duration, 2, ".", "")).' min'}}</p>
			<?php /*
			 <p>Duración: {{$module_last->duration_hours() < 1 ? str_replace(".00", "", (string)number_format($module_last->duration_minutes(), 2, ".", "")).' min.' : str_replace(".00", "", (string)number_format($module_last->duration_hours(), 2, ".", "")).' h'}}  </p>*/?>
		</div>
		<!--enlace-->
		<div class="col-sm-3">
			<a class="btn view block sessions_l" href='{{url("tablero/{$program->slug}/aprendizaje/{$activity->session->module->slug}/{$activity->session->slug}/$activity->slug")}}'>Continuar actividad</a>
		</div>
	</div>
</div>
