@extends('layouts.admin.a_master')
@section('title', 'Ver perfil de facilitador '.$facilitator->name)
@section('description', 'Ver perfil de facilitador '.$facilitator->name)
@section('body_class', 'profile')
@section('breadcrumb_type', 'profile facilitator')
@section('breadcrumb', 'layouts.facilitator.breadcrumb.b_profile')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Ver Facilitador</h1>
	</div>
</div>
<div class="box">
		<div class="row">

		<div class="col-sm-10 col-sm-offset-1 center">
			<p class="">
				@if($facilitator->image)
				<img src='{{url("img/users/{$facilitator->image->name}")}}' height="150px">
				@else
				<img src='{{url("img/users/default.png")}}' height="150px">
				@endif
			</p>
			<h2 >{{$facilitator->name}}</h2>

			<h3><strong>{{$facilitator->institution}}</strong></h3>
			<div class="divider"></div>
			<ul class="profile list row">
				<li class="col-sm-4"><span>Grado de estudios</span>{{$facilitator->FacilitatorData->degree}}</li>
				<li class="col-sm-4"><span>email</span>{{$facilitator->email}}</li>
				<li class="col-sm-4"><span>Sitio Web</span>{{$facilitator->FacilitatorData->web ? $facilitator->FacilitatorData->web : "Sin información" }}</li>

			</ul>
			<p>
			@if($facilitator->FacilitatorData->twitter)
			<a href="https://twitter.com/{{$facilitator->FacilitatorData->twitter}}" class="facilitador_i tw" target="_blank"></a>
			@endif
			@if($facilitator->FacilitatorData->facebook)
			<a href="http://{{$facilitator->FacilitatorData->facebook}}" class="facilitador_i fb"  target="_blank"></a>
			@endif
			@if($facilitator->FacilitatorData->linkedin)
			<a href="http://{{$facilitator->FacilitatorData->linkedin}}" class="facilitador_i lk"  target="_blank"></a>
			@endif
			@if($facilitator->FacilitatorData->other)
			{{$facilitator->FacilitatorData->other}}
			@endif
			</p>

			<h3>Semblanza</h3>
			<p>{{$facilitator->FacilitatorData->semblance ? $facilitator->FacilitatorData->semblance : "Sin información" }}</p>
			<div class="divider"></div>
		</div>
	</div>
</div>

@endsection
