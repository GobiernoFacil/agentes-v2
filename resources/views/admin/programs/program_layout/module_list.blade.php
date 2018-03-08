<div class="module">
	<div class="m_header">
		<div class="row">
			<div class="col-sm-6">
				<h4>Semana {{$module->order}} {!! $module->modality == "Presencial" ?  '<span>('.$module->modality.')</span>' : '' !!}</h4>
			</div>
			<div class="col-sm-6">
				<p class="right">Tiempo estimado: <strong>{{$module->number_hours}} h</strong></p>
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
					<li><b class="sessionG"></b> 3 vídeos: <strong>15 minutos</strong></li>
					<li><b class="sessionG"></b> {{$module->number_sessions}} lecturas: <strong>5.5 horas</strong></li>
				</ul>
			</div>
			<div class="col-sm-9">
				<div class="row">
					<div class="col-sm-6 border_l">
						<h4>Actividad obligatoria</h4>
						<h5>Evaluación</h5>
						<ul>
							<li>Reflexión Final y ensayo</li>
						</ul>
					</div>
					<div class="col-sm-3">
						<h4>Fechas</h4>
						<p>{{date("d-m-Y", strtotime($module->start))}} al <br>{{date('d-m-Y', strtotime($module->end))}}</p>
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