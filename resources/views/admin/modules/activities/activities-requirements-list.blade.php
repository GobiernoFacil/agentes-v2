<table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th>Nombre</th>
			<th>Descripción</th>
  <th>URL contenido</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($activity->activityRequirements as $requirement)
			<tr>
				<td>{{$requirement->order}}</td>
				<td><h4><a href="{{ url('dashboard/sesiones/actividades/requermientos/ver/' . $requirement->id) }}">{{$requirement->name}}</a></h4></td>
				<td>{{$requirement->description}}</td>
    <td>{{$requirement->material_link ? $requirement->material_link : 'Sin información'}}</td>
				<td>
					<a href="{{ url('dashboard/sesiones/actividades/requermientos/ver/' . $requirement->id) }}" class="btn xs ev">Ver</a>
					<a href="{{ url('dashboard/sesiones/actividades/requermientos/editar/' . $requirement->id) }}" class="btn xs view">Actualizar</a>
				 <!-- <a href ="{{ url('dashboard/modulos/eliminar' . $requirement->id) }}"  id ="{{$requirement->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>-->
		</tr>
		@endforeach
	</tbody>
</table>