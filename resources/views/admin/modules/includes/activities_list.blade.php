<div class="row">
	<!---title-->
	<div class="col-sm-9">
		<h2>{{$session->name}}</h2>
	</div>
	<!---actions-->
	<div class="col-sm-3">
		<p class="right">

		<a class="btn ev xs"  href='{{url("dashboard/programas/$program->id/modulos/$module->id/sesiones/ver/$session->id")}}'>Ver sesión</a>
		<a href='{{url("dashboard/programas/$program->id/modulos/$module->id/sesiones/editar/$session->id")}}' class="btn xs view">Actualizar sesión</a>
		<a href ='{{url("dashboard/programas/$program->id/modulos/$module->id/sesiones/eliminar/$session->id")}}'  id ="{{$session->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a>
		</p>
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
		<span class="col-sm-7">
			<!--tipo de actividad-->
			<b class="{{$activity->type}}"><span class="{{ $activity->type == "video" ? 'arrow-right' : '' }}"></span></b>
			<!-- actividad-->
			<a href="{{ url('dashboard/sesiones/actividades/ver/'. $activity->id) }}">{{$activity->name}} <span class="notes">{{$activity->duration}} h.</span></a>
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
		<span class="col-sm-3">
			<p class="right">
			<a href="{{ url('dashboard/sesiones/actividades/ver/' . $activity->id) }}" class="btn xs ev">Ver</a>
			<a href="{{ url('dashboard/sesiones/actividades/editar/' . $activity->id) }}" class="btn xs view">Actualizar</a>
			 <a href ="{{ url('dashboard/sesiones/actividades/eliminar/' . $activity->id) }}"  id ="{{$activity->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a>
			</p>
		</span>
	</li>
	@endforeach
</ul>
<p class="center"><a href='{{url("dashboard/sesiones/actividades/agregar/$session->id")}}' class="btn xs view">[+] Agregar actividad a {{$session->name}}</a></p>
<div class="divider bottom"></div>
@else
<p class="center">No hay actividades en esta sesión. <br><a href='{{url("dashboard/sesiones/actividades/agregar/$session->id")}}' class="btn xs view">[+] Agregar actividad a {{$session->name}}</a></p>
<div class="divider bottom"></div>
@endif

<!--- facilitadores--->
<div class="row">
	@if($session->facilitators->count() > 0)
	<div class="col-sm-9">
		<h3>Facilitadores de la sesión</h3>
	</div>
	<div class="col-sm-3">
		<a href='{{ url("dashboard/programas/{$session->module->program->id}/modulos/{$session->module->id}/sesiones-facilitadores/asignar/{$session->id}") }}'  class="btn xs ev">Asignar más facilitadores</a>
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
		<p class="center">
		<a href='{{ url("dashboard/programas/{$session->module->program->id}/modulos/{$session->module->id}/sesiones-facilitadores/asignar/{$session->id}") }}' class="btn xs view">[+] Asignar facilitadores a {{$session->name}}</a>
		</p>
		<div class="divider bottom"></div>
	</div>
	@endif
</div>

	</div>
</div>
