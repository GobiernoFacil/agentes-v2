<div class="module {{ $module->public && $today >= $module->start ? '' : 'disabled'}}">
	<div class="m_header">
		<div class="row">
			<div class="col-sm-6">
				<h4>Semana {{$counter}} {!! $module->modality == "Presencial" ?  '<span>('.$module->modality.')</span>' : '' !!}</h4>
			</div>
			<div class="col-sm-6">
				<p class="right">Tiempo estimado: <strong>{{$module->number_hours}} h</strong>
				<button class="ap-show" type="button">
				<svg class="ap-timelineicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 551 1024"><path d="M105.56 985.817L553.53 512 105.56 38.183l-85.857 81.173 409.6 433.23v-81.172l-409.6 433.23 85.856 81.174z"/></svg>
				</button>
				 </p>
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
					<a href='{{ url("tablero/aprendizaje/{$module->slug}") }}'>{{$module->title}}</a>
					@else
					{{$module->title}}
					@endif
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
						<h4>Calificación</h4>
						
					</div>
					<div class="col-sm-3">
						<h4>Fecha límite</h4>
						<p>{{date('d-m-Y', strtotime($module->end))}}
							<span>({{ \Carbon\Carbon::createFromTimeStamp(strtotime($module->end))->diffForHumans()}})</span>
						</p>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>