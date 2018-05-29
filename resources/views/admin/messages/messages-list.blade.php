@extends('layouts.admin.a_master')
@section('title', 'Mensajes')
@section('description', 'Lista de mensajes')
@section('body_class', 'admin mensajes')
@section('breadcrumb_type', 'messages list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_messages')

@section('content')
<div class="row">
	<div class="col-sm-6">
		<h1>Mensajes Privados</h1>
	</div>
  <div class="col-sm-3 center">
		<a href='{{ url("dashboard/mensajes/programa/$program->id/mensajes-archivados") }}' class="btn gde"> Mensajes Archivados ({{$user->get_storaged_conversations($program)->count()}})</a>
	</div>
	<div class="col-sm-3 center">
		<a href='{{ url("dashboard/mensajes/programa/$program->id/agregar-mensaje") }}' class="btn gde"><strong>+</strong> Crear Mensaje</a>
	</div>
</div>

@if($conversations->count()>0)
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
			  <thead>
			    <tr>
			      <th>Conversación con</th>
			      <th>Asunto</th>
			      <th></th>
			      <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			    @foreach ($conversations as $conversation)
			    <tr>
				    <td><strong>
					@if($conversation->to_id != $user->id)
						@if($conversation->user_to->image)
							<img src='{{url("img/users/{$conversation->user_to->image->name}")}}' height="25px">
						@else
							<img src='{{url("img/users/default.png")}}' height="25px">
						@endif
			        	{{$conversation->user_to->name}}
					@else
						@if($conversation->user->image)
							<img src='{{url("img/users/{$conversation->user->image->name}")}}' height="25px">
						@else
							<img src='{{url("img/users/default.png")}}' height="25px">
						@endif
						{{$conversation->user->name}}
					@endif
					</strong>
				    </td>
			        <td><a href='{{url("dashboard/mensajes/programa/$program->id/ver/-mensajes/$conversation->id")}}'>{{$conversation->title}}</a>
			        	<span class="count_m">{{$conversation->messages->count() == 1 ? $conversation->messages->count() . ' mensaje' : $conversation->messages->count() . ' mensajes' }}</span>
			        </td>
					<td>
				        {{$conversation->updated_at->diffForHumans()}}
				    </td>
					<td>
			          <a href='{{url("dashboard/mensajes/programa/$program->id/ver/-mensajes/$conversation->id")}}' class="btn xs view">Ver Conversación</a>
			          <a href ='{{ url("dashboard/mensajes/programa/$program->id/conversacion/storage/$conversation->id")}}'  id ="{{$conversation->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Archivar</a></td>

				    </td>
				</tr>
			    @endforeach
			  </tbody>
			</table>

			{{ $conversations->links() }}
		</div>
	</div>
</div>
@else
<div class="row">
  <div class="col-sm-12">
	  <div class="box center">
	  	<h2>Sin mensajes</h2>
	  	<a href='{{ url("dashboard/mensajes/programa/$program->id/agregar-mensaje") }}' class="btn ev"><strong>+</strong> Crear Mensaje</a>
	  </div>
  </div>
</div>
@endif
@endsection
