<nav class="nav_week open" id="week-menu-shalala">
@if($user->type !='facilitator')
	  @if(isset($activity))
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
									<b class="{{$_activity->type === 'diagnostic' || $_activity->type === 'final'  ? 'evaluation' : $_activity->type}}"><span class="{{ $_activity->type == "video" ? 'arrow-right' : '' }}"></span></b>
									@if($user->type == "admin")
									<a href="{{ url('dashboard/sesiones/actividades/ver/'. $_activity->id) }}" class="{{$activity->id == $_activity->id ? 'current' : ''}}">{{$_activity->name}} </a>
									@else
									<a href="{{ url('tablero/'.$session->module->program->slug.'/aprendizaje/'. $session->module->slug .'/'. $session->slug .'/' . $_activity->slug) }}" class="{{$activity->slug == $_activity->slug ? 'current' : ''}}">{{$_activity->name}} </a>
									@endif
								</span>
								<span class="col-sm-3">
									<span class="notes">{{$_activity->duration}} {{$_activity->measure ? ' hrs.' : ' min.'}}</span>
								</span>
							</li>
							@endforeach
						</ul>
						@endif
					@endforeach
				</div>
				@endif
	 @else

	 <!-- lista de sesiones-->
		@if($session->module->sessions->count() > 0)
		<div class="ap_week">
				@foreach($session->module->sessions as $session)
				<h2>{{$session->name}}</h2>
				@if($session->activities->count() > 0)
				<ul class="ap_list">
					@foreach ($session->activities as $_activity)
					<li class="row">
						<span class="col-sm-9">
							<b class="{{$_activity->type === 'diagnostic' || $_activity->type === 'final' ? 'evaluation' : $_activity->type}}"><span class="{{ $_activity->type == "video" ? 'arrow-right' : '' }}"></span></b>
							@if($user->type == "admin")
							<a href="{{ url('dashboard/sesiones/actividades/ver/'. $_activity->id) }}" class="{{$activity->id == $_activity->id ? 'current' : ''}}">{{$_activity->name}} </a>
							@else
							<a href="{{ url('tablero/'.$session->module->program->slug.'/aprendizaje/'. $session->module->slug .'/'. $session->slug .'/' . $_activity->slug) }}" class=" ">{{$_activity->name}} </a>
							@endif
						</span>
						<span class="col-sm-3">
							<span class="notes">{{$_activity->duration}} {{$_activity->measure ? ' hrs.' : ' min.'}}</span>
						</span>
					</li>
					@endforeach
				</ul>
				@endif
			@endforeach
		</div>
		@endif
 @endif
@else
<div class="ap_week">
		<h2>{{$session->name}}</h2>
		@if($session->activities->count() > 0)
		<ul class="ap_list">
			@foreach ($session->activities()->orderBy('order','desc')->get() as $_activity)
			<li class="row">
				<span class="col-sm-9">
					<b class="{{$_activity->type}}"><span class="{{ $_activity->type == "video" ? 'arrow-right' : '' }}"></span></b>
					<a href="{{ url('tablero-facilitador/actividades/ver/'. $_activity->id) }}" class="{{$activity->id == $_activity->id ? 'current' : ''}}">{{$_activity->name}} </a>
				</span>
				<span class="col-sm-3">
					<span class="notes">{{$_activity->duration}} {{$_activity->measure ? ' hrs.' : ' min.'}}</span>
				</span>
			</li>
			@endforeach
		</ul>
		@endif
</div>
@endif
</nav>
