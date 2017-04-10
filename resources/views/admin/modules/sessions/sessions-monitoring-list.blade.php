<div class="box">
	<div class="row">
		<table class="table">
			<thead>
				<tr>
					<th>Conocimiento</th>
					<th>Competencia</th>
					<th>Actitud</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($session->evaluations as $evaluation)
					<tr>
						<td><h4><a href="{{ url('dashboard/sesiones/mecanismos-monitoreo/ver/' . $evaluation->id) }}">{{$evaluation->knowledge}}</a></h4></td>
						<td>{{$evaluation->competitions}}</td>
						<td>{{$evaluation->attitude}}</td>
						<td>
							<a href="{{ url('dashboard/sesiones/mecanismos-monitoreo/ver/' . $evaluation->id) }}" class="btn xs view">Ver</a>
							<a href="{{ url('dashboard/sesiones/mecanismos-monitoreo/editar/' . $evaluation->id) }}" class="btn xs view">Actualizar</a>
						 <!-- <a href ="{{ url('dashboard/mecanismos-monitoreo/eliminar' . $evaluation->id) }}"  id ="{{$evaluation->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>-->
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
