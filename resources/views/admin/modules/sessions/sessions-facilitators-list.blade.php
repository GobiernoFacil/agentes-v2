<div class="box">
	<div class="row">
		<table class="table">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>email</th>
					<th>Institution</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($session->facilitators as $facilitator)
					<tr>
						<td><h4>{{$facilitator->user->name}}</h4></td>
						<td>{{$facilitator->user->email}}</td>
						<td>{{$facilitator->user->institution}}</td>
						<td>
							<a href='{{ url("dashboard/facilitadores/ver/" .$facilitator->user->id) }}' class="btn xs view">Ver</a>
							<a href='{{ url("dashboard/sesiones/facilitadores/asignar/$session->id") }}' class="btn xs view">Remover</a>
						 <!-- <a href ="{{ url('dashboard/requerimientos/eliminar' . $facilitator->id) }}"  id ="{{$facilitator->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a>-->
						 </td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
