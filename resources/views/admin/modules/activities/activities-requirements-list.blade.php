<table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th>Nombre</th>
			<th>Descripción</th>
			<th>URL contenido</th>
			@if($user->type=="admin")
			<th>Acciones</th>
			@endif
		</tr>
	</thead>
	<tbody>
		@foreach ($activity->activityRequirements as $requirement)
		<tr>
			<td>{{$requirement->order}}</td>
			<td><h4>{{$requirement->name}}</h4></td>
			<td>{{$requirement->description}}</td>
			<td>@if($requirement->material_link)
				  <a class ="link" href="{{$requirement->material_link}}" target='_blank'>Ir a contenido</a>
					@else
					<span>Sin información</span>
					@endif

			</td>
			@if($user->type=="admin")
			<td>
				<!--<a href="{{ url('dashboard/sesiones/actividades/requerimientos/ver/' . $requirement->id) }}" class="btn xs ev">Ver</a>-->
				<a href="{{ url('dashboard/sesiones/actividades/requerimientos/editar/' . $requirement->id) }}" class="btn xs view">Actualizar</a>
				<!-- <a href ="{{ url('dashboard/modulos/eliminar' . $requirement->id) }}"  id ="{{$requirement->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a>-->
			 </td>
			 @endif
		</tr>
		@endforeach
	</tbody>
</table>
