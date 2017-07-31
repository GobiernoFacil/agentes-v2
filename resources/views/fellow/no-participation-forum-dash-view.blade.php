<div class="row">
@foreach($noForum as $forum)
	<div class="col-sm-12">
		<div class="box session_list next_eval">
			<div class="row">
				<!-- footnote-->
				  <div class="header_note">
				    <div class="row">
				     <div class="col-sm-4">
					     <p class="right">Fecha:</p>
				     </div>
				      <div class="col-sm-8">
					      <p><strong><span>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($forum->created_at))->diffForHumans()}}</span></strong></p>
				          <p>{{ !empty($forum->created_at) ? date("j/m/Y", strtotime($forum->created_at)) : 'Sin fecha'}}</p>
				      </div>
				    </div>
				  </div>

				<div class="col-sm-12">
				  <h2><a href='{{url("tablero/foros/{$forum->session->slug}/{$forum->slug}")}}'>{{$forum->topic}}</a></h2>
				   <!-- footnote-->
				  <div class="footnote">
				    <div class="row">
				      <div class="col-sm-12">
				          <p><strong>Módulo</strong>: {{$forum->session->module->title}}</p>
				          <p><strong>Sesión</strong>: {{$forum->session->name}}</p>
									@if($forum->activity)
									<p><strong>Actividad</strong>: {{$forum->activity->name}}</p>
									@endif
				      </div>
				    </div>
				  </div>
				  <div class="divider b"></div>
				    <div class="row">
				      <div class="col-sm-12">
				        <p>{{$forum->description}}</p>
				      </div>
				    </div>
				  </div>
				  <!-- ver sesión-->
				  <div class="col-sm-12">
							<a class="btn view block sessions_l" href='{{ url("tablero/foros/{$forum->session->slug}/{$forum->slug}")}}'>Participar</a>
				  </div>

			</div>
		</div>
	</div>
@endforeach
</div>
