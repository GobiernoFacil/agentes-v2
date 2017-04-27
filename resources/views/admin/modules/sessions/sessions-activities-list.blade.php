<div class="row">
	@foreach ($session->activities as $activity)
	<!--icono-->	
		<div class="col-sm-1 right">
			<b class="icon_h i_lecturas list_s"></b>
		</div>
		<div class="col-sm-9">
			<p><a href="{{ url('dashboard/sesiones/actividades/ver/' . $activity->id) }}">{{$activity->name}}</a> <span class="notes">({{$activity->duration}})</span></p>		
		</div>
		<div class="col-sm-2">
			<p><a href="{{ url('dashboard/sesiones/actividades/ver/' . $activity->id) }}" class="btn xs ev">Ver</a>
			<a href="{{ url('dashboard/sesiones/actividades/editar/' . $activity->id) }}" class="btn xs view">Actualizar</a>
			 <!-- <a href ="{{ url('dashboard/modulos/eliminar' . $activity->id) }}"  id ="{{$activity->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a>--></p>
		</div>
		<div class="col-sm-12">
			<div class="line"></div>
		</div>
	@endforeach
</div>