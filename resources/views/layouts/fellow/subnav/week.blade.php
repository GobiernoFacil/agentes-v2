<nav class="nav_week open">
	<!-- lista de sesiones-->
	@if($activity->session->module->sessions->count() > 0)
	<div class="ap_week">
    	@foreach($activity->session->module->sessions as $session)
			<h2>{{$session->name}}</h2>
			@if($session->activities->count() > 0)
			<ul class="ap_list">
				@foreach ($session->activities as $activity)
				<li class="row">
					<span class="col-sm-9">
						<b class="{{$activity->type}}"><span class="{{ $activity->type == "video" ? 'arrow-right' : '' }}"></span></b>
						<a href="{{ url('tablero/aprendizaje/'. $session->module->slug .'/'. $session->slug .'/' . $activity->id) }}">{{$activity->name}} </a> 
					</span>
					<span class="col-sm-3">
						<span class="notes">{{$activity->duration}} min.</span>
					</span>
				</li>
				@endforeach
			</ul>
			@endif
		@endforeach
	</div>
	@endif
</nav>