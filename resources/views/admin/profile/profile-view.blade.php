@extends('layouts.admin.a_master')
@section('title', 'Perfil')
@section('description', 'Ver perfil')
@section('body_class', 'profile')
@section('breadcrumb_type', 'profile view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_profile')

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
				<a href="{{ url('dashboard/perfil/editar') }}" class="btn xs view">Editar tu perfil</a></li>
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

			<div class="divider"></div>
			<ul class="profile list row">
				<li class="col-sm-4"><span>Grado de estudios</span>{{$user->FacilitatorData->degree}}</li>
				<li class="col-sm-4"><span>email</span>{{$user->email}}</li>
				<li class="col-sm-4"><span>Sitio Web</span>{{$user->FacilitatorData->web ? $user->FacilitatorData->web : "Sin información" }}</li>

			</ul>
			<p>
			@if($user->FacilitatorData->twitter)
			<a href="#" class="facilitador_i tw"></a>
			@endif
			@if($user->FacilitatorData->facebook)
			<a href="#" class="facilitador_i fb"></a>
			@endif
			@if($user->FacilitatorData->linkedin)
			<a href="#" class="facilitador_i lk"></a>
			@endif
			@if($user->FacilitatorData->other)
			{{$user->FacilitatorData->other}}
			@endif
			</p>

			<h3>Semblanza</h3>
			<p>{{$user->FacilitatorData->semblance ? $user->FacilitatorData->semblance : "Sin información" }}</p>
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
