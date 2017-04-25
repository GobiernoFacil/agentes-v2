<div class="row">
	@foreach ($session->facilitators as $facilitator)
	<div class="col-sm-6">
		<div class="row">
			<div class="col-sm-3">
				@if($facilitator->user->image)
				<img src='{{url("img/users/{$facilitator->user->image->name}")}}'>
				@else
				Sin imagen
				@endif
			</div>
			<div class="col-sm-9">
				<h4>{{$facilitator->user->name}}</h4>
				<p>{{$facilitator->user->institution}}<br>
					<a href='{{ url("dashboard/facilitadores/ver/" .$facilitator->user->id) }}' class="btn xs view">Ver</a>
					<a href='{{ url("dashboard/sesiones/facilitadores/asignar/$session->id") }}' class="btn xs danger">Remover</a>
					<!-- <a href ="{{ url('dashboard/requerimientos/eliminar' . $facilitator->id) }}"  id ="{{$facilitator->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a>-->
				</p>
			</div>
		</div>
	</div>
	@endforeach
</div>