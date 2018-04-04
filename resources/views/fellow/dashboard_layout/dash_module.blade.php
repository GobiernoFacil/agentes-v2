<div class="module {{ $module->public && $today >= $module->start ? '' : 'disabled'}}">
	<div class="m_header">
		<div class="row">
			<div class="col-sm-6">
				<h4>Semana {{$counter}} {!! $module->modality == "Presencial" ?  '<span>('.$module->modality.')</span>' : '' !!}</h4>
			</div>
			<div class="col-sm-6">
				<p class="right">Tiempo estimado: <strong>{{$module->duration_hours() < 1 ? str_replace(".00", "", (string)number_format($module->duration_minutes(), 2, ".", "")).' min.' : str_replace(".00", "", (string)number_format($module->duration_hours(), 2, ".", "")).' h'}} </strong>
				<button class="ap-show" type="button" data-div="content-{{$module->id}}">
				<svg class="ap-timelineicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 551 1024"><path d="M105.56 985.817L553.53 512 105.56 38.183l-85.857 81.173 409.6 433.23v-81.172l-409.6 433.23 85.856 81.174z"/></svg>
				</button>
				 </p>
			</div>
		</div>
	</div>
	<!--content-->
	<div class="m_content" id="content-{{$module->id}}" style="display: none;">
		<div class="row">
			<div class="col-sm-12">
				<!-- title-->
				<h3>
					@if($module->public)
					<a href='{{ url("tablero/{$module->program->slug}/aprendizaje/{$module->slug}") }}'>{{$module->title}}</a>
					@else
					{{$module->title}}
					@endif
				</h3>
			</div>
			<div class="col-sm-3">
				<ul class="ap-acti">
					@if($module->count_activities('video'))
					<li><b class="sessionG"></b> {{$module->count_activities('video')}} {{$module->count_activities('video') > 1 ? 'videos' : 'video'}}: <strong>
						{{$module->duration_activities('video',1)  > 1 ? str_replace(".00", "", (string)number_format($module->duration_activities('video',1), 2, ".", "")).' horas' : $module->duration_activities('video',0).' min' }}</strong></li>
					@endif
					@if($module->count_activities('lecture'))
					<li><b class="sessionG"></b>
						{{$module->count_activities('lecture')}} {{$module->count_activities('lecture') > 1 ? 'lecturas' : 'lectura'}}:
						<strong>{{$module->duration_activities('lecture',1)  > 1 ? str_replace(".00", "", (string)number_format($module->duration_activities('lecture',1), 2, ".", "")).' horas' :$module->duration_activities('lecture',0).' min' }} </strong></li>
					@endif
				</ul>
			</div>
			<div class="col-sm-9">
				<div class="row">
					@if($module->get_all_evaluation_activity()->count()>0)
						@foreach($module->get_all_evaluation_activity() as $evAct)
							<div class="col-sm-6 border_l">
								<h4>Actividad obligatoria</h4>
								<h5>Evaluación</h5>
								<ul>
									<li>{{$evAct->name}}</li>
								</ul>
							</div>
							<div class="col-sm-3">
								<h4>Fechas</h4>
								<p>{{date("d-m-Y", strtotime($module->start))}} al <br>{{date('d-m-Y', strtotime($evAct->end))}}</p>
							</div>
						@endforeach
					@else
					<div class="col-sm-6 border_l">
						<h4>Actividad obligatoria</h4>
						<h5>Evaluación</h5>
						<ul>
							<li><strong>Sin actividades obligatorias</strong></li>
						</ul>
					</div>
					<div class="col-sm-3">
						<h4>Fechas</h4>
						<p>Sin fecha</p>
					</div>

					@endif
				</div>
			</div>

		</div>
	</div>
</div>
