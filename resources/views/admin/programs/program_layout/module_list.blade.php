<div class="module">
	<div class="m_header">
		<div class="row">
			<div class="col-sm-6">
				<h4>Semana {{$module->order}} {!! $module->modality == "Presencial" ?  '<span>('.$module->modality.')</span>' : '' !!}</h4>
			</div>
			<div class="col-sm-6">
				<p class="right">Tiempo estimado: <strong>{{$module->duration_hours()}} h</strong></p>
			</div>
		</div>
	</div>
	<!--content-->
	<div class="m_content">
		<div class="row">
			<div class="col-sm-12">
				<!-- title-->
				<h3>
					@if($module->public)
					<a href='{{ url("dashboard/programas/$program->id/modulos/ver/$module->id") }}'>{{$module->title}}</a>
					@else
					{{$module->title}}
					@endif
					<span class="le_link"><a href='{{ url("dashboard/programas/$program->id/modulos/editar/$module->id") }}' class="btn xs ev">Actualizar módulo</a></span>
				</h3>
			</div>
			<div class="col-sm-3">
				<ul class="ap-acti">
					@if($module->count_activities('video'))
					<li><b class="sessionG"></b> {{$module->count_activities('video')}} {{$module->count_activities('video') > 1 ? 'videos' : 'video'}}: <strong>{{$module->duration_activities('video',1)}} horas</strong></li>
					@endif
					@if($module->count_activities('lecture'))
					<li><b class="sessionG"></b> {{$module->count_activities('lecture')}} {{$module->count_activities('lecture') > 1 ? 'lecturas' : 'lectura'}}: <strong>{{$module->duration_activities('lecture',1)}} horas</strong></li>
					@endif
				</ul>
			</div>
			<div class="col-sm-9">
				<div class="row">
					<div class="col-sm-6 border_l">
						<h4>Actividad obligatoria</h4>
						<h5>Evaluación</h5>
						<ul>
							@if($module->get_evaluation_activity())
							<li>module->get_evaluation_activity()->title</li>
							@else
							<li><strong>Sin actividad obligatoria</strong></li>
							@endif
						</ul>
					</div>
					<div class="col-sm-3">
						<h4>Fechas</h4>
						@if($module->get_evaluation_activity())
						<p>{{date("d-m-Y", strtotime($module->start))}} al <br>{{date('d-m-Y', strtotime($module->get_evaluation_activity()->end))}}</p>
						@else
						<li><strong>Sin fechas</strong></li>
						@endif
					</div>
					<div class="col-sm-3">
						<a class="btn view block sessions_l"  href='{{ url("dashboard/programas/$program->id/modulos/ver/$module->id") }}'>Ver módulo</a>
			<a href ='{{ url("dashboard/programas/$program->id/modulos/eliminar/$module->id") }}'  id ="{{$module->id}}" class="btn gde danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
