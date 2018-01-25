<table class="table">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Descripción</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($notice->files as $file)
			<tr>
				<td><h4><a href='{{url("dashboard/convocatorias/archivos/descargar/$file->id")}}'>{{$file->name}}</a></h4></td>
				<td>{{$file->comments}}</td>
				<td>
					<a href='{{url("dashboard/convocatorias/archivos/descargar/$file->id")}}' class="btn xs ev">Descargar</a>
					<a href="{{ url('dashboard/convocatorias/archivos/editar/' . $file->id) }}" class="btn xs view">Actualizar</a>
				  <a href ="{{ url('dashboard/convocatorias/archivos/eliminar/' . $file->id)}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a>
				 </td>
		</tr>
		@endforeach
	</tbody>
</table>
