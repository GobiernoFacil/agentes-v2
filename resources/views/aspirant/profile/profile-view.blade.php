@extends('layouts.admin.a_master')
@section('title', 'Tu Perfil')
@section('description', 'Ver tu perfil')
@section('body_class', 'profile')
@section('breadcrumb_type', 'profile view')
@section('breadcrumb', 'layouts.aspirant.breadcrumb.b_profile')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Tu Perfil</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<ul class="profile list">
				<li class="right">
				<a href="{{ url('tablero-aspirante/perfil/editar') }}" class="btn xs view">Editar tu perfil</a></li>
			</ul>
		</div>
		<div class="col-sm-10 col-sm-offset-1 center">
			<p class="">
				@if($user->image)
				<img src='{{url("img/users/{$user->image->name}")}}' height="150px">
				@else
				<img src='{{url("img/users/default.png")}}' height="150px">
				@endif
			</p>
			<h2 >{{$user->name}}</h2>
			
			<h3><strong>{{$user->institution}}</strong></h3>
			<div class="divider"></div>
			<ul class="profile list row">
				<li class="col-sm-4"><span>Grado de estudios</span>{{$user->aspirant($user)->degree}}</li>
				<li class="col-sm-4"><span>email</span>{{$user->email}}</li>
				<li class="col-sm-4"><span>Ciudad / Estado</span>{{$user->aspirant($user)->city}}, {{$user->aspirant($user)->state}} </li>	
			
			</ul>
			
			
			<div class="divider"></div>
			<div class="row notes">
				<div class="col-sm-6">
				<p>Fecha de creación: {{ date("d-m-Y, H:i", strtotime($user->created_at)) }} hrs.</p>
				</div>
				<div class="col-sm-6">
				<p>Última actualización: {{ date("d-m-Y, H:i", strtotime($user->updated_at)) }} hrs.</p>
				</div>
			</div>
		</div>

	</div>
</div>
@endsection