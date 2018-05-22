<div class="row">
	<!---title-->
	<div class="col-sm-9">
		<h2>{{$session->name}}</h2>
	</div>
	<div class="col-sm-12">
		<div class="divider"></div>
	</div>
</div>
<!--lista de actividades-->
<div class="row">
	<div class="col-sm-11 col-sm-offset-1">
@if($session->activities->count() > 0)
<h3>Actividades</h3>
<ul class="ap_list">
	@foreach ($session->activities as $activity)
	<li class="row">
		<span class="{{ $activity->type == 'evaluation' ? 'col-sm-7' : 'col-sm-9' }}">
			<!--tipo de actividad-->
			<b class="{{$activity->type}}"><span class="{{ $activity->type == "video" ? 'arrow-right' : '' }}"></span></b>
			<!-- actividad-->
			<a href="{{ url('tablero-facilitador/actividades/ver/'. $activity->id) }}">{{$activity->name}} <span class="notes">{{$activity->duration}} {{$activity->measure ? ' horas':' minutos'}}.</span></a>
		</span>
		@if($activity->type == "evaluation")
		<!-- si es evaluación-->
		<span class="col-sm-2">
			<p> Fecha límite:<br>
			 <strong>{{date("d-m-Y", strtotime($activity->end))}}</strong><br>
			 <span class="notes">({{ \Carbon\Carbon::createFromTimeStamp(strtotime($activity->end))->diffForHumans()}})</span>
			</p>
		</span>
		@endif
	</li>
	@endforeach
</ul>

<div class="divider bottom"></div>
@endif

<!--- facilitadores--->
<div class="row">
	@if($session->facilitators->count() > 0)
	<div class="col-sm-9">
		<h3>Facilitadores de la sesión</h3>
	</div>
	<div class="col-sm-12">
		<div class="divider"></div>
	</div>
	<div class="col-sm-12">
			@include('admin.modules.sessions.sessions-facilitators-list')
	</div>
	@else
	<div class="col-sm-12">
		<h3>Facilitadores de la sesión</h3>
		<p>Sin facilitadores asignados</p>
		<div class="divider bottom"></div>
	</div>
	@endif
</div>

	</div>
</div>
