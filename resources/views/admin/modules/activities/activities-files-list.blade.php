<div class="box">
	<div class="row">
		<table class="table">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($activity->activityFiles as $file)
					<tr>
						<td><h4><a href="{{ url('dashboard/sesiones/actividades/archivos/ver/' . $file->id) }}">{{$file->name}}</a></h4></td>
						<td>{{$file->description}}</td>
						<td>
							<a href="{{ url('dashboard/sesiones/actividades/archivos/ver/' . $file->id) }}" class="btn xs view">Ver</a>
							<a href="{{ url('dashboard/sesiones/actividades/archivos/editar/' . $file->id) }}" class="btn xs view">Actualizar</a>
						 <!-- <a href ="{{ url('dashboard/modulos/eliminar' . $file->id) }}"  id ="{{$file->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>-->
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
