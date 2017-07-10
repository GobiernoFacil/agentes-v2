<div class="row">
	<?php $count_a = $next_activities->count();?>
@foreach($next_activities as $activity)
	@if($count_a == 3)
	<div class="col-sm-4">
	@endif
	@if($count_a == 2)
	<div class="col-sm-6">
	@endif
	@if($count_a == 1)
	<div class="col-sm-12">
	@endif
	
		<div class="box session_list next_eval">
			<div class="row">
				<!-- footnote-->
				  <div class="header_note">
				    <div class="row">
				     <div class="col-sm-4">
					     <p class="right">Fecha límite:</p>
				     </div>
				      <div class="col-sm-8">
					      <p><strong><span>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($activity->end))->diffForHumans()}}</span></strong></p>
				          <p>{{ !empty($activity->end) ? date("j/m/Y", strtotime($activity->end)) : 'Sin fecha'}}</p>
				      </div>
				    </div>
				  </div>
				
				<div class="col-sm-12">
				  <h5>Actividad {{$activity->order}}</h5>
				  <h2><a href='{{url("tablero/aprendizaje/{$activity->session->slug}/{$activity->session->slug}/$activity->id")}}'>{{$activity->name}}</a></h2>
				   <!-- footnote-->
				  <div class="footnote">
				    <div class="row">
				      <div class="col-sm-12">
				          <p><strong>Módulo</strong>: {{$activity->session->module->title}}</p>
				          <p><strong>Sesión</strong>: {{$activity->session->name}}</p>
				      </div>
				    </div>
				  </div>
				  <div class="divider b"></div>
				    <div class="row">
				      <div class="col-sm-12">
				        <p>{{$activity->description}}</p>
				      </div>
				    </div>
				  </div>
				  <!-- ver sesión-->
				  <div class="col-sm-12">
				    <a class="btn view block sessions_l" href='{{url("tablero/evaluacion/{$activity->slug}")}}'>Comenzar evaluación</a>
				  </div>
		         
			</div>
		</div>
	</div>
@endforeach
</div>