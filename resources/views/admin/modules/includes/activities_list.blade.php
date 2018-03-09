<div class="row">
	<!---title-->
	<div class="col-sm-9">
		<h2>{{$session->name}}  <span class="le_link"><a href='{{url("dashboard/programas/$program->id/modulos/$module->id/sesiones/editar/$session->id")}}' class="btn xs ev">Actualizar sesión</a></span></h2>
	</div>
	<!---actions-->
	<div class="col-sm-3">
		<p class="right">
		<a class="btn view xs"  href='{{url("dashboard/programas/$program->id/modulos/$module->id/sesiones/ver/$session->id")}}'>Ver sesión</a>
		<a href ='{{url("dashboard/programas/$program->id/modulos/$module->id/sesiones/eliminar/$session->id")}}'  id ="{{$session->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a>
		</p>
	</div>
	<div class="col-sm-12">
		<div class="divider"></div>
	</div>
</div>
<!--lista de actividades-->
@if($session->activities->count() > 0)
<ul class="ap_list">
	@foreach ($session->activities as $activity)
	<li class="row">
		<span class="col-sm-9">
			<!--tipo de actividad-->
			<b class="{{$activity->type}}"><span class="{{ $activity->type == "video" ? 'arrow-right' : '' }}"></span></b>
			<!-- actividad-->
			<a href="{{ url('dashboard/sesiones/actividades/ver/'. $activity->id) }}">{{$activity->name}} <span class="notes">{{$activity->duration}} min.</span></a>
		</span>
		@if($activity->type == "evaluation")
		<!-- si es evaluación-->
		<span class="col-sm-3">
			<p class="right"> Fecha límite:
			 <strong>{{date("d-m-Y", strtotime($activity->end))}}</strong><br>
			 <span class="notes">({{ \Carbon\Carbon::createFromTimeStamp(strtotime($activity->end))->diffForHumans()}})</span>
			</p>
		</span>
		@endif
	</li>
	@endforeach
</ul>
@endif