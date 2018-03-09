<nav class="nav_week" id="week-menu-shalala" style="display: none">
	<!-- lista de sesiones-->
	@if($activity->session->module->sessions->count() > 0)
	<div class="ap_week">
    	@foreach($activity->session->module->sessions as $session)
			<h2>{{$session->name}}</h2>
			@if($session->activities->count() > 0)
			<ul class="ap_list">
				@foreach ($session->activities as $_activity)
				<li class="row">
					<span class="col-sm-9">
						<b class="{{$_activity->type}}"><span class="{{ $_activity->type == "video" ? 'arrow-right' : '' }}"></span></b>
						<a href="{{ url('tablero/aprendizaje/'. $session->module->slug .'/'. $session->slug .'/' . $_activity->id) }}" class="{{$activity->id == $_activity->id ? 'current' : ''}}">{{$_activity->name}} </a> 
					</span>
					<span class="col-sm-3">
						<span class="notes">{{$_activity->duration}} min.</span>
					</span>
				</li>
				@endforeach
			</ul>
			@endif
		@endforeach
	</div>
	@endif
</nav>