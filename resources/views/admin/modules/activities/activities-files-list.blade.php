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
				<td>
				@if($user->type=="admin")
					<h4><a href='{{url("dashboard/sesiones/actividades/archivos/descargar/$file->id")}}'>{{$file->name}}</a></h4>
				@endif
				@if($user->type == "fellow")
					<h4><a href='{{url("tablero/aprendizaje/actividades/archivos/descargar/$file->id")}}'>{{$file->name}}</a></h4>
				@endif
				@if($user->type == "facilitator")
					<h4><a href='{{url("tablero-facilitador/actividades/archivos/descargar/$file->id")}}'>{{$file->name}}</a></h4>
				@endif
				</td>
				<td>{{$file->description}}</td>
				<td class="right">
					@if($user->type=="admin")
					<a href='{{url("dashboard/sesiones/actividades/archivos/descargar/$file->id")}}' class="btn xs ev">Descargar</a>
					<a href="{{ url('dashboard/sesiones/actividades/archivos/editar/' . $file->id) }}" class="btn xs view">Actualizar</a>
				  <a href ="{{ url('dashboard/sesiones/actividades/archivos/eliminar/' . $file->id)}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a>
				 	@endif
				 	@if($user->type == "fellow")
				 	<a href='{{url("tablero/aprendizaje/actividades/archivos/descargar/$file->id")}}' class="btn xs ev">Descargar</a>
				 	@endif
				 	@if($user->type == "facilitator")
				 	<a href='{{url("tablero-facilitador/actividades/archivos/descargar/$file->id")}}' class="btn xs ev">Descargar</a>
				 	@endif
				 </td>
		</tr>
		@endforeach
	</tbody>
</table>
