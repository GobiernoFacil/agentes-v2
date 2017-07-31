<div class="row">
	@foreach($retro as $r)
			<div class="col-sm-12">
				<div class="box session_list next_eval">
					<div class="row">
						<div class="col-sm-8">
						  <h5>Actividad {{$r->activity->order}}</h5>
						  <h2><a href='{{url("tablero/aprendizaje/{$r->activity->session->slug}/{$r->activity->session->slug}/$r->activity->id")}}'>{{$r->activity->name}}</a></h2>
						</div>
						<span class="col-sm-3 right">
							Calificación <br>
							<strong>{{$r->activity_score($r->activity->id,$user->id) ? number_format($r->activity_score($r->activity->id,$user->id)->score,2) : 'Sin calificación'}}</strong>
						</span>
						<div class="col-sm-12">
						   <!-- footnote-->
						  <div class="footnote">
						    <div class="row">
						      <div class="col-sm-12">
						          <p><strong>Módulo</strong>: {{$r->activity->session->module->title}}</p>
						          <p><strong>Sesión</strong>: {{$r->activity->session->name}}</p>
						      </div>
						    </div>
						  </div>
						  <div class="divider b"></div>
						    <div class="row">
						      <div class="col-sm-12">
										@if($r->activity_score($r->activity->id,$user->id))
						        <p>{{$r->activity_score($r->activity->id,$user->id)->comments}}</p>
										@endif
						      </div>
						    </div>
						  </div>
						  <!-- ver sesión-->
						  <div class="col-sm-12">
						    	<a class="btn view block sessions_l" href='{{url("tablero/calificaciones/archivos/ver/{$r->activity->slug}")}}'>Ver evaluación</a>
						  </div>

					</div>
				</div>
			</div>
	@endforeach
</div>
