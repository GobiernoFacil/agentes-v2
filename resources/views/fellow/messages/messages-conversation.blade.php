@extends('layouts.admin.a_master')
@section('title', 'Mensaje privado con ' . $conversation->user_to->name)
@section('description', 'Mensaje privado con ' . $conversation->user_to->name)
@section('body_class', 'fellow mensajes')
@section('breadcrumb_type', 'message view')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_messages')

@section('content')
<div class="row">
	<!-- conversación con--->
	<div class="col-sm-9">
	    <h1>Conversación con
		@if($conversation->to_id != $user->id)
		   {{$conversation->user_to->name}}
		@else
		   {{$conversation->user->name}}
		@endif
		</h1>
	</div>
	<!-- btn escribir mensaje--->
	<div class="col-sm-3 center">
    	<a href='{{ url("tablero/$program->slug/mensajes/conversacion/agregar/".encrypt($conversation->id)) }}' class="btn view block sessions_l"><b class="write_message"></b>  Escribir Mensaje</a>
	</div>
</div>

<div class="row">
	<div class="col-sm-12 divider bg"></div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="ap_single_message">
			<div class="module">
				<div class="m_header">
					<div class="row">
						<div class="col-sm-6">
							@if($conversation->to_id != $user->id)
								@if($conversation->user_to->image)
									<img src='{{url("img/users/{$conversation->user_to->image->name}")}}' height="100px">
								@else
									<img src='{{url("img/users/default.png")}}' height="100px">
								@endif
							@else
								@if($conversation->user->image)
									<img src='{{url("img/users/{$conversation->user->image->name}")}}' height="100px">
								@else
									<img src='{{url("img/users/default.png")}}' height="100px">
								@endif
							@endif
						</div>
						
					</div>
				</div>
				<!--content-->
				<div class="m_content">
					<div class="row">
						<div class="col-sm-9">
						<h2 class="title">{{$conversation->title}}</h2>
						</div>
						<div class="col-sm-3">
							<p class="right">{{$conversation->messages->count() == 1 ? $conversation->messages->count() . ' mensaje' : $conversation->messages->count() . ' mensajes' }}</p>
						</div>
						<div class="col-sm-12 divider bg"></div>
						@if($conversation->messages->count() > 0)
						<div class="row">
						    <div class="col-sm-8 col-sm-offset-2">
							@foreach($conversation->messages->sortByDesc("updated_at") as $message)
								<div class="row">
									<div class="col-sm-8 {{$message->user_id == $user->id ? 'col-sm-offset-4' : ''}}">
								    	<div class="message_box {{$message->user_id == $user->id ? 'me' : 'not_me'}}">
											<p>{{$message->message}}</p>
								    	</div>
										<p><span class="ap_date">{{$message->updated_at->diffForHumans()}}</span>
										@if($message->log)
											@if($message->log->user_id == $user->id)
											<span {!! $message->log->status == '1' ? 'class="ap_seen"' : 'class="ap_seen no"'  !!}>{{$message->log->status == '1' ? '(visto: ' . $message->log->updated_at->diffForHumans() . ')'  : '(no visto)' }}</span> 
											@endif
										@endif
										</p>
								  	</div>
								</div>
							@endforeach
						    </div>
						</div>
						@else
						<div class="row">
							<div class="col-sm-8 col-sm-offset-2">
								<p>No existen mensajes</p>
							</div>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--
<div class="row">
	<div class="col-sm-8 col-sm-offset-2 center">
		    <a href='{{ url("tablero/$program->slug/mensajes/conversacion/agregar/".encrypt($conversation->id))}}' class="btn gde"><b class="write_message"></b> Escribir Mensaje</a>
	</div>
</div>
-->
@endsection
