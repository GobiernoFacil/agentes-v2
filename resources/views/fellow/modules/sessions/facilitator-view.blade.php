@extends('layouts.admin.a_master')
@section('title', 'Ver facilitador' )
@section('description', '' )
@section('body_class', 'fellow aprendizaje modulos')
@section('breadcrumb_type', 'facilitator view')

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
      @if($facilitator->FacilitatorData)
			<div class="divider"></div>
			<ul class="profile list row">
				<li class="col-sm-4"><span>Grado de estudios</span>{{$facilitator->FacilitatorData->degree}}</li>
				<li class="col-sm-4"><span>email</span>{{$facilitator->email}}</li>
				<li class="col-sm-4"><span>Sitio Web</span>{{$facilitator->FacilitatorData->web ? $facilitator->FacilitatorData->web : "Sin información" }}</li>

			</ul>
			<p>
			@if($facilitator->FacilitatorData->twitter)
			<a href="#" class="facilitador_i tw"></a>
			@endif
			@if($facilitator->FacilitatorData->facebook)
			<a href="#" class="facilitador_i fb"></a>
			@endif
			@if($facilitator->FacilitatorData->linkedin)
			<a href="#" class="facilitador_i lk"></a>
			@endif
			@if($facilitator->FacilitatorData->other)
			{{$facilitator->FacilitatorData->other}}
			@endif
			</p>

			<h3>Semblanza</h3>
			<p>{{$facilitator->FacilitatorData->semblance ? $facilitator->FacilitatorData->semblance : "Sin información" }}</p>
      @endif
		</div>
	</div>
</div>
@endsection
