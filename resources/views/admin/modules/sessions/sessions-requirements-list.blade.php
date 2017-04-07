<div class="box">
	<div class="row">
		<table class="table">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Número de actividad</th>
					<th>Número de Sesión</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($session->requirements as $requirement)
					<tr>
						<td><h4><a href="{{ url('dashboard/sesiones/requerimientos/ver/' . $requirement->id) }}">{{$requirement->activity->name}}</a></h4></td>
						<td>{{$requirement->activity->order}}</td>
						<td>{{$requirement->activity->session->order}}</td>
						<td>
							<a href="{{ url('dashboard/sesiones/requerimientos/ver/' . $requirement->id) }}" class="btn xs view">Ver</a>
							<a href="{{ url('dashboard/sesiones/requerimientos/editar/' . $requirement->id) }}" class="btn xs view">Actualizar</a>
						 <!-- <a href ="{{ url('dashboard/requerimientos/eliminar' . $requirement->id) }}"  id ="{{$requirement->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>-->
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
