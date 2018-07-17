<!--título del módulo-->
<div class="col-sm-9">
  <h3>Proyecto Final</h3>
	<h4>Módulo</h4>
	<h2 class ="title">{{$final->session->module->title}}</h2>
</div>
<!--calificación del módulo-->
<div class="col-sm-3 right">
	<p>Calificación del Proyecto Final:
		@if($final->end <= date('Y-m-d'))
		<span class="score_a block">
			{{$user->fileFellowScore($final->id) ? number_format($user->fileFellowScore($final->id)->score,2)*10 : 'Sin calificación'}}
		</span>
		@else
		<span class="score_a block">
			<strong>Aún no aplica</strong>
		</span>
		@endif

	</p>
</div>
