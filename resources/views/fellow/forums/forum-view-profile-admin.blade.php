<!--image-->
<p class="">
	@if($userF->image)
	<img src='{{url("img/users/{$userF->image->name}")}}' height="150px">
	@else
	<img src='{{url("img/users/default.png")}}' height="150px">
	@endif
</p>
<!--name-->
<h2>{{ $userF->name }}</h2>
<h3 >{{ $userF->institution }}</h3>
<div class="divider"></div>
<!--estudios-->
<!--estudios-->
<ul class="profile list row">
	<li class="col-sm-4"><span>Grado de estudios</span>{{$userF->facilitatorData->degree ?  $userF->facilitatorData->degree :"Sin información" }}</li>
	<li class="col-sm-4"><span>email</span>{{$userF->email}}</li>
	<li class="col-sm-4"><span>Sitio Web</span>{!! $userF->facilitatorData->web ? '<a href="'. $userF->facilitatorData->web .'">' . $userF->facilitatorData->web.'</a>' : "Sin información" !!}</li>
</ul>

<!--redes-->
<p>
	@if($userF->facilitatorData->twitter)
	<a href="{{$userF->facilitatorData->twitter}}" class="facilitador_i tw"></a>
	@endif
	@if($userF->facilitatorData->facebook)
	<a href="{{$userF->facilitatorData->facebook}}" class="facilitador_i fb"></a>
	@endif
	@if($userF->facilitatorData->linkedin)
	<a href="{{$userF->facilitatorData->linkedin}}" class="facilitador_i lk"></a>
	@endif
	@if($userF->facilitatorData->other)
	{{$userF->facilitatorData->other}}
	@endif
</p>
<!--semblanza-->
<h3>Semblanza</h3>
<p>{{$userF->facilitatorData->semblance ? $userF->facilitatorData->semblance : "Sin información" }}</p>


<div class="divider"></div>