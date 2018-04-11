@extends('layouts.admin.a_master')
@section('title', 'Mensajes')
@section('description', 'Lista de mensajes archivados')
@section('body_class', 'fellow mensajes')
@section('breadcrumb_type', 'messages list')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_messages')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Mensajes archivados</h1>
	</div>
	<!--ir a mensajes-->
	<div class="col-sm-3 center">
		<a href="{{ url('tablero/' . $program->slug .'/mensajes') }}" class="btn view block sessions_l">&lt; Regresar a mensajes</a>
	</div>
	<div class="col-sm-12">
		<div class="divider bg"></div>
	</div>
</div>

@if($user->store_conversations->count()>0)
<div class="row">
	<div class="col-sm-12">
		@foreach ($conversations as $conversation)
		<a href="{{ url('tablero/' . $program->slug .'/mensajes/ver/' . $conversation->id) }}" class="ap_message_link">
			
		    <!--mensaje con-->
		    <span class="col-sm-4">
		    	<strong>
				@if($conversation->to_id != $user->id)
				   	{{$conversation->user_to->name}}
				@else
				   {{$conversation->user->name}}
				@endif
				</strong>
		    </span>
		    <!-- subject-->
		    <span class="col-sm-5">
		     	{{$conversation->title}}
		    </span>
			 <!-- fechas-->
			 <span class="col-sm-3 right">
		        {{$conversation->last_message->first()->updated_at->diffForHumans()}}
		    </span>
			<span class="clearfix"></span>
		</a>
		@endforeach
		{{ $conversations->links() }}
	</div>
</div>
@else
<div class="row">
  <div class="col-sm-12">
	  <div class="box center">
	  	<h2>Sin mensajes archivados</h2>
	  	<a href="{{ url('tablero/mensajes') }}" class="btn ev"> Ir a Mensajes</a>
	  </div>
  </div>
</div>
@endif
@endsection
