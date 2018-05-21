<div class="module">
	<div class="m_header">
		<div class="row">
			<div class="col-sm-6">
				<h4>Semana {{$module->order}} {!! $module->modality == "Presencial" ?  '<span>('.$module->modality.')</span>' : '' !!}</h4>
			</div>
			<div class="col-sm-6">
				
			</div>
		</div>
	</div>
	<!--content-->
	<div class="m_content">
		<div class="row">
			<div class="col-sm-12">
				<!-- title-->
				<h3>
					
					{{$module->title}}
				
				</h3>
			</div>
			<div class="col-sm-6">
				<ul class="ap-acti">
					<li><b class="sessionG"></b>
					{{$module->count_activities('video')}} {{$module->count_activities('video') == 1 ? 'video' : 'videos'}}, 
					{{$module->count_activities('lecture')}} {{$module->count_activities('lecture') == 1 ? 'lectura' : 'lecturas'}},
					{{$module->get_all_evaluation_activity()->count()}}
					{{$module->get_all_evaluation_activity()->count() == 1 ? 'evaluación' : 'evaluaciones'}}
					</li>
				</ul>
			</div>
			<div class="col-sm-6">
					<p class="ap_time right">Tiempo estimado: <strong>{{$module->duration_hours() > 1 ? number_format($module->duration_hours(),2).' horas':$module->duration_minutes().' min' }} </strong></p>

			</div>
		</div>
	</div>
</div>