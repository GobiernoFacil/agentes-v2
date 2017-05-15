<div class="row">
	@foreach ($session->activities as $activity)
	<!--icono-->
		<div class="col-sm-1 right">
			<b class="icon_h {{$activity->type ? $activity->type  : 'default'}} list_s width_s"></b>
		</div>
		<div class="col-sm-9">
			<p>@if($user->type == "admin")
				<a href="{{ url('dashboard/sesiones/actividades/ver/' . $activity->id) }}">{{$activity->name}}</a>
				 @else
				 <a href="{{ url('tablero/aprendizaje/'. $session->module->slug .'/'. $session->slug .'/' . $activity->id) }}">{{$activity->name}}</a>
				 @endif
				<span class="notes">({{$activity->duration}})</span></p>
		</div>
		<div class="col-sm-2">
			<p>
			@if($user->type == "admin")
			<a href="{{ url('dashboard/sesiones/actividades/ver/' . $activity->id) }}" class="btn xs ev">Ver</a>
			<a href="{{ url('dashboard/sesiones/actividades/editar/' . $activity->id) }}" class="btn xs view">Actualizar</a>
			 <a href ="{{ url('dashboard/sesiones/actividades/eliminar/' . $activity->id) }}"  id ="{{$activity->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a>
			 @else
			 <a href="{{ url('tablero/aprendizaje/'. $session->module->slug .'/'. $session->slug .'/' . $activity->id) }}" class="btn xs ev">Ver</a>
			 @endif
			 </p>
		</div>
		<div class="col-sm-12">
			<div class="line activities"></div>
		</div>
	@endforeach
</div>
