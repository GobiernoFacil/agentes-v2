@extends('layouts.admin.a_master')
@section('title', 'Perfil')
@section('description', 'Ver perfil')
@section('body_class', 'fellow')

@section('content')
<div class="row">
	<div class="col-sm-12">
    @if($userF->type === 'fellow')
		  <h1>Perfil de {{$userF->name." ".$userF->fellowData->surname." ".$userF->fellowData->lastname}}</h1>
    @elseif($userF->type === 'facilitator')
      <h1>Perfil de {{$userF->name." ".$userF->facilitatorData->surname." ".$userF->facilitatorData->lastname}}</h1>
    @else
      <h1>Perfil de {{$userF->name}}</h1>
    @endif
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 center">
			<p class="">
				@if($userF->image)
				<img src='{{url("img/users/{$userF->image->name}")}}' height="150px">
				@else
				<img src='{{url("img/users/default.png")}}' height="150px">
				@endif
			</p>
			<div class="divider"></div>
			<ul class="profile list row">
        @if($userF->fellowData)
				    <li class="col-sm-4"><span>Grado de estudios</span>{{$userF->fellowData->degree ?  $userF->fellowData->degree :"Sin información" }}</li>
        @elseif($userF->facilitatorData)
            <li class="col-sm-4"><span>Grado de estudios</span>{{$userF->facilitatorData->degree ? $userF->facilitatorData->degree : "Sin información"}}</li>
        @else
            <li class="col-sm-4"><span>Grado de estudios</span>Sin información</li>
        @endif
				<li class="col-sm-4"><span>email</span>{{$userF->email}}</li>
        @if($userF->fellowData)
				    <li class="col-sm-4"><span>Sitio Web</span>{{$userF->fellowData->web ? $userF->fellowData->web : "Sin información" }}</li>
        @elseif($userF->facilitatorData)
            <li class="col-sm-4"><span>Sitio Web</span>{{$userF->facilitatorData->web ? $userF->facilitatorData->web : "Sin información" }}</li>
        @else
            <li class="col-sm-4"><span>Sitio Web</span>Sin información</li>
        @endif

			</ul>
			<p>
      @if($userF->fellowData)
      			@if($userF->fellowData->twitter)
      			<a href="#" class="facilitador_i tw"></a>
      			@endif
      			@if($userF->fellowData->facebook)
      			<a href="#" class="facilitador_i fb"></a>
      			@endif
      			@if($userF->fellowData->linkedin)
      			<a href="#" class="facilitador_i lk"></a>
      			@endif
      			@if($userF->fellowData->other)
      			{{$userF->fellowData->other}}
      			@endif
            <h3>Semblanza</h3>
      			<p>{{$userF->fellowData->semblance ? $userF->fellowData->semblance : "Sin información" }}</p>
      @elseif($userF->facilitatorData)
            @if($userF->facilitatorData->twitter)
            <a href="#" class="facilitador_i tw"></a>
            @endif
            @if($userF->facilitatorData->facebook)
            <a href="#" class="facilitador_i fb"></a>
            @endif
            @if($userF->facilitatorData->linkedin)
            <a href="#" class="facilitador_i lk"></a>
            @endif
            @if($userF->facilitatorData->other)
            {{$userF->facilitatorData->other}}
            @endif
            <h3>Semblanza</h3>
      			<p>{{$userF->facilitatorData->semblance ? $userF->facilitatorData->semblance : "Sin información" }}</p>
      @endif
			</p>

			<div class="divider"></div>
		</div>

	</div>
</div>
@endsection
