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
<h3 data-data="{{$userF}}">{{ $userF->institution }}</h3>
<div class="divider"></div>
<!--estudios-->
<ul class="profile list row">
	<li class="col-sm-4"><span>email</span>{{$userF->email}}</li>
</ul>

<div class="divider"></div>