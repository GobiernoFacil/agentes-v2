@extends('layouts.admin.a_master')
@section('title', 'Lista de Aspirantes')
@section('description', 'Lista de Aspirantes')
@section('body_class', 'fellows')
@section('breadcrumb_type', 'fellow ver')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_fellows')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Perfil de Fellow</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 center">
			<p class="">
				@if($fellow->image)
				<img src='{{url("img/users/{$fellow->image->name}")}}' height="150px">
				@else
				<img src='{{url("img/users/default.png")}}' height="150px">
				@endif
			</p>
			<h2>{{$fellow->name." ".$fellow->fellowData->surname." ".$fellow->fellowData->lastname}}</h2>
			<h3>Procedencia: <strong>{{$fellow->fellowData->origin ? $fellow->fellowData->origin : "Sin información"}}</strong></h3>
			<div class="divider"></div>
			<ul class="profile list row">
				<li class="col-sm-4"><span>Nivel de estudios</span>{{$fellow->fellowData->degree}}</li>
				<li class="col-sm-4"><span>Email</span>{{$fellow->email}}</li>
				<li class="col-sm-4"><span>Ciudad, Estado</span>{{$fellow->fellowData->city}}, {{$fellow->fellowData->state}}</li>

			</ul>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<h1>Calificaciones</h1>
	</div>
</div>

<div class="box session_list">
	<div class="row">
		<div class="col-sm-6  center">
			<h3 class="title">Promedio general</h3>
			<h2><span class="score_a block">{{number_format($average,2)}}</span></h2>
	   </div>
		 <!-- ver sesión-->
		 <div class="col-sm-6">
			 <a class="btn view block sessions_l"  href="{{ url('dashboard/fellows/calificaciones/ver/' . $fellow->id) }}">Ir a calificaciones</a>
		 </div>
		 <div class="col-sm-12">
			 <div class="divider b"></div>
		 </div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<h1>Participaciones</h1>
	</div>
</div>

<div class="box session_list">
	<div class="row">
		<div class="col-sm-6  center">
			<h3 class="title">Participaciones totales en foros (incluyendo foro general y de su estado)</h3>
			<h2><span class="score_a block">{{$fellow->total_participations($fellow->id)}}</span></h2>
	   </div>
		 <!-- ver sesión-->
		 <div class="col-sm-6">
			 <a class="btn view block sessions_l"  href="{{ url('dashboard/fellows/participaciones/ver/' . $fellow->id) }}">Ir a participaciones</a>
		 </div>
		 <div class="col-sm-12">
			 <div class="divider b"></div>
		 </div>
	</div>
</div>

@endsection
