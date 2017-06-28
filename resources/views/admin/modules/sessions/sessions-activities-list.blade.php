<div class="row">
	<?php $today = date("Y-m-d");?>
	@foreach ($session->activities as $activity)
	<!--icono-->
	@if($user->type =='fellow')
		@if($activity->type==='evaluation')
			@if($today )
			<div class="col-sm-1 right">
				<b class="icon_h {{$activity->type ? $activity->type  : 'default'}} list_s width_s"></b>
			</div>
			@endif
	  @else
		<div class="col-sm-1 right">
			<b class="icon_h {{$activity->type ? $activity->type  : 'default'}} list_s width_s"></b>
		</div>
		@endif
	@else

		<div class="col-sm-1 right">
			<b class="icon_h {{$activity->type ? $activity->type  : 'default'}} list_s width_s"></b>
		</div>
	@endif

	@if($user->type =='fellow')
	 	@if($activity->type ==='evaluation')
			@if($today )
			<div class="col-sm-{{ $user->type == 'admin' ? '8' : '9'}}">
				<p>
					<a href="{{ url('tablero/aprendizaje/'. $session->module->slug .'/'. $session->slug .'/' . $activity->id) }}">{{$activity->name}}</a>
					<span class="notes">({{$activity->duration}})</span>
				</p>
			</div>
			<div class="col-sm-{{ $user->type == 'admin' ? '3' : '2'}}">
				<p class="links right">
					<a href="{{ url('tablero/aprendizaje/'. $session->module->slug .'/'. $session->slug .'/' . $activity->id) }}" class="btn xs ev">Ver</a>
				</p>
				</div>
				<div class="col-sm-12">
				<div class="line activities"></div>
				</div>
				@endif
			@else
			<div class="col-sm-{{ $user->type == 'admin' ? '8' : '9'}}">
				<p>
					<a href="{{ url('tablero/aprendizaje/'. $session->module->slug .'/'. $session->slug .'/' . $activity->id) }}">{{$activity->name}}</a>
					<span class="notes">({{$activity->duration}})</span>
				</p>
			</div>
			<div class="col-sm-{{ $user->type == 'admin' ? '3' : '2'}}">
				<p class="links right">
					<a href="{{ url('tablero/aprendizaje/'. $session->module->slug .'/'. $session->slug .'/' . $activity->id) }}" class="btn xs ev">Ver</a>
				</p>
				</div>
				<div class="col-sm-12">
				<div class="line activities"></div>
				</div>
			@endif
		@else
		<div class="col-sm-{{ $user->type == 'admin' ? '8' : '9'}}">
			<p>@if($user->type == "admin")
				<a href="{{ url('dashboard/sesiones/actividades/ver/' . $activity->id) }}">{{$activity->name}}</a>
				@endif
				@if($user->type == "facilitator")
				<a href="{{ url('tablero-facilitador/actividades/ver/' . $activity->id) }}">{{$activity->name}}</a>
				@endif
				<span class="notes">({{$activity->duration}})</span></p>
		</div>

		<div class="col-sm-{{ $user->type == 'admin' ? '3' : '2'}}">
			<p class="links right">
			@if($user->type == "admin")
			<a href="{{ url('dashboard/sesiones/actividades/ver/' . $activity->id) }}" class="btn xs ev">Ver</a>
			<a href="{{ url('dashboard/sesiones/actividades/editar/' . $activity->id) }}" class="btn xs view">Actualizar</a>
			 <a href ="{{ url('dashboard/sesiones/actividades/eliminar/' . $activity->id) }}"  id ="{{$activity->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a>
			 @endif
			 @if($user->type == "facilitator")
			 <a href="{{ url('tablero-facilitador/actividades/ver/' . $activity->id) }}" class="btn xs ev">Ver</a>
			 @endif
			 </p>
		</div>
		<div class="col-sm-12">
			<div class="line activities"></div>
		</div>
@endif
	@endforeach
</div>
