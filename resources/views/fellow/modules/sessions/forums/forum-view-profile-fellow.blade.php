<!--image-->
<p class="">
	@if($userF->image)
	<img src='{{url("img/users/{$userF->image->name}")}}' height="150px">
	@else
	<img src='{{url("img/users/default.png")}}' height="150px">
	@endif
</p>
<!--name-->
<h2>{{$userF->name." ".$userF->fellowData->surname." ".$userF->fellowData->lastname}}</h2>
<h3>Procedencia: {{$userF->fellowData->origin}} </h3>
<p>{{$userF->fellowData->city}}, {{$userF->fellowData->state}}</p>
<div class="divider"></div>
<!--estudios-->
<ul class="profile list row">
	<li class="col-sm-4"><span>Grado de estudios</span>{{$userF->fellowData->degree ?  $userF->fellowData->degree :"Sin información" }}</li>
	<li class="col-sm-4"><span>email</span>{{$userF->email}}</li>
	<li class="col-sm-4"><span>Sitio Web</span>{{$userF->fellowData->web ? $userF->fellowData->web : "Sin información" }}</li>
</ul>
<!--redes-->
<p>
	@if($userF->fellowData->twitter)
	<a href="{{$userF->fellowData->twitter}}" class="facilitador_i tw"></a>
	@endif
	@if($userF->fellowData->facebook)
	<a href="{{$userF->fellowData->facebook}}" class="facilitador_i fb"></a>
	@endif
	@if($userF->fellowData->linkedin)
	<a href="{{$userF->fellowData->linkedin}}" class="facilitador_i lk"></a>
	@endif
	@if($userF->fellowData->other)
	{{$userF->fellowData->other}}
	@endif
</p>
<!--semblanza-->
<h3>Semblanza</h3>
<p>{{$userF->fellowData->semblance ? $userF->fellowData->semblance : "Sin información" }}</p>
<div class="divider"></div>