@foreach ($session->topics as $topic)
<div class="row h_tag list">
	<!--- temática--->
	<div class="col-sm-3 right">
		<h4>Temática</h4>
	</div>
	<div class="col-sm-7">
		<p>{{ $topic->order}}. <strong>{{$topic->name}}</strong></p>
	</div>
	<div class="col-sm-2">
		@if($user->type == "admin")
		<p><span class="le_link right"><a href="{{ url('dashboard/sesiones/tematicas/editar/'. $topic->id ) }}" class="btn view">Editar objetivo particular</a></span></p>
		@endif
	</div>
	<div class="col-sm-12">
		<div class="line"></div>
	</div>
	<div class="col-sm-3 right">
		<h4>Conocimientos (Saber)</h4>
	</div>
	<div class="col-sm-9">
		<p>{{$topic->knowledge}}</p>
	</div>
	<div class="col-sm-12">
		<div class="line"></div>
	</div>
	<!-- saber ser-->
	<div class="col-sm-3 right">
		<h4>Valores (Saber ser)</h4>
	</div>
	<div class="col-sm-9">
		<p>{{$topic->values}}</p>
	</div>
	<div class="col-sm-12">
		<div class="line"></div>
	</div>
	<!-- saber hacer-->
	<div class="col-sm-3 right">
		<h4>Habilidades (Saber hacer)</h4>
	</div>
	<div class="col-sm-9">
		<p>{{$topic->abilities}}</p>
	</div>
	<div class="col-sm-12">
		<div class="line"></div>
	</div>
	<!-- productos-->
	<div class="col-sm-3 right">
		<h4>Productos</h4>
	</div>
	<div class="col-sm-9">
		<p>{{$topic->products}}</p>
	</div>
	<div class="col-sm-12">
		<div class="line"></div>
	</div>
</div>
@endforeach
<?php /*
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
*/?>
