<h2 class ="title">Módulo 1</h2>
<p><strong>{{$module->title}}</strong></p>
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
				<span class="score_a">{{$fellow->diagnosticEvaluation ? $fellow->diagnosticEvaluation->total_score/10 : "Sin calificación" }}</span>
			@endif
			</span>
		@endforeach
	</li>
	@endforeach
</ul>
<div class="divider b"></div>