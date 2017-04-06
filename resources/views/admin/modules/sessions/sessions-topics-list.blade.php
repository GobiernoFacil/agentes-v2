<div class="box">
	<div class="row">
		<table class="table">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Número de temática</th>
					<th>Conocimientos</th>
					<th>Valores</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($session->topics as $topic)
					<tr>
						<td><h4><a href="{{ url('dashboard/sesiones/tematicas/ver/' . $topic->id) }}">{{$topic->name}}</a></h4></td>
						<td>{{$topic->order}}</td>
						<td>{{$topic->knowledge}} hrs.</td>
						<td>{{$topic->values}}</td>
						<td>
							<a href="{{ url('dashboard/sesiones/tematicas/ver/' . $topic->id) }}" class="btn xs view">Ver</a>
							<a href="{{ url('dashboard/sesiones/tematicas/editar/' . $topic->id) }}" class="btn xs view">Actualizar</a>
						 <!-- <a href ="{{ url('dashboard/modulos/eliminar' . $topic->id) }}"  id ="{{$topic->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>-->
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
