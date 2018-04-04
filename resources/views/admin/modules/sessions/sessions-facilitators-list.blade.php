<div class="row">
	@foreach ($session->facilitators as $facilitator)
	<div class="col-sm-6 box-facilitator">
		<div class="row">
			<div class="col-sm-3">
				@if($facilitator->user->image)
				<img src='{{url("img/users/{$facilitator->user->image->name}")}}' height="112px">
				@else
				<img src='{{url("img/users/default.png")}}' width="100%">
				@endif
			</div>
			<div class="col-sm-9">
				<h4>{{$facilitator->user->name}}</h4>
				<p>{{$facilitator->user->institution}}<br>
					@if($user->type == "admin")
					<a href='{{ url("dashboard/facilitadores/ver/" .$facilitator->user->id) }}' class="btn xs view">Ver</a>
					<a href='{{ url("dashboard/programas/{$session->module->program->id}/modulos/{$session->module->id}/sesiones-facilitadores/remover/$session->id/{$facilitator->user->id}") }}' class="btn xs danger">Remover</a>
					<!-- <a href ="{{ url('dashboard/requerimientos/eliminar' . $facilitator->id) }}"  id ="{{$facilitator->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a>-->
					@endif
					@if($user->type == "fellow")
					<a href='{{ url("tablero/{$session->module->program->slug}/aprendizaje/{$session->module->slug}/{$session->slug}/ver/facilitador/{$facilitator->user->id}") }}' class="btn xs view">Ver</a>
					@endif
					@if($user->type == "facilitator")
						@if($user->id !== $facilitator->user->id)
						<a href="{{ url('tablero-facilitador/facilitadores/ver/' . $facilitator->user->id) }}" class="btn xs ev">Ver</a>
						@else
						<a href="{{ url('tablero-facilitador/perfil')}}" class="btn xs ev">Ver tu perfil</a>
						@endif
			 		@endif
				</p>
			</div>
		</div>
	</div>
	@endforeach
</div>
