<h4>Módulo 1</h4>
<h2 class="title">{{$module->title}}</h2>
<div class="divider b"></div>
<div class="col-sm-3 col-sm-offset-6">
	<h5><span class="sub_tab">Tipo de evaluación</span></h5>
</div>
<div class="col-sm-2 right">
	<h5><span class="sub_tab">Calificación</span></h5>
</div>

<ul class="list">
	@foreach($module->sessions as $session)
	<li class="row">
		<span class="col-sm-12">
			<span class="session">Sesión {{$session->order}}</span>
		</span>
		<span class="col-sm-6">
		@if($fellow->diagnosticEvaluation)
			<h4><a href='{{url("dashboard/evaluacion/diagnostico/ver/{$fellow->diagnosticEvaluation->id}")}}' class="link_a">{{$session->name}}</a></h4>
		@else
			<h4>{{$session->name}}</h4>
		@endif
		</span>
		@foreach($session->activities as $activity)
			<span class="col-sm-3">
			@if($activity->type === 'evaluation')
				@if($fellow->diagnosticEvaluation)
					<a href='{{url("dashboard/evaluacion/diagnostico/ver/{$fellow->diagnosticEvaluation->id}")}}' class="link_a">{{$activity->hasfiles === 'No' ? 'Examen en línea' : 'Revisión de Productos'}}</a>
				@else
					Examen en línea
				@endif
			@endif
			</span>
			<span class="col-sm-2 right">
			@if($activity->name ==="Examen diagnóstico")
				<span>{{$fellow->diagnosticEvaluation ? $fellow->diagnosticEvaluation->total_score/10 : "Sin calificación" }}</span>
			@endif
			</span>
		@endforeach
	</li>
	@endforeach
</ul>
<div class="divider"></div>