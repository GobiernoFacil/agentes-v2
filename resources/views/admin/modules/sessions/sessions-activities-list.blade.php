<div class="box">
	<div class="row">
		<table class="table">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Número de actividad</th>
					<th>Duración</th>
					<th>Descripción</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($session->activities as $activity)
					<tr>
						<td><h4><a href="{{ url('dashboard/sesiones/actividades/ver/' . $activity->id) }}">{{$activity->name}}</a></h4></td>
						<td>{{$activity->order}}</td>
						<td>{{$activity->duration}} hrs.</td>
						<td>{{$activity->description}}</td>
						<td>
							<a href="{{ url('dashboard/sesiones/actividades/ver/' . $activity->id) }}" class="btn xs view">Ver</a>
							<a href="{{ url('dashboard/sesiones/actividades/editar/' . $activity->id) }}" class="btn xs view">Actualizar</a>
						 <!-- <a href ="{{ url('dashboard/modulos/eliminar' . $activity->id) }}"  id ="{{$activity->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>-->
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
