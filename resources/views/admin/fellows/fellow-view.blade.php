@extends('layouts.admin.a_master')
@section('title', 'Ver fellow '. $fellow->name)
@section('description', 'Ver fellow '. $fellow->name." ".$fellow->fellowData->surname." ".$fellow->fellowData->lastname)
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
		<h1>Calificaciones en el programa "{{$program->title}}"</h1>
	</div>
</div>

<div class="box session_list">
	<div class="row">
		<div class="col-sm-6  center">
			<h3 class="title">Promedio general</h3>
			<h2><span class="score_a block">{{$fellow->total_average($program->id) ? number_format($fellow->total_average($program->id)->average,2)*10 : 'Sin promedio'}}</span></h2>
	   </div>
		 <!-- ver sesión-->
		 <div class="col-sm-6">
			 <a class="btn view block sessions_l"  href='{{url("dashboard/fellows/programa/$program->id/ver-calificaciones/$fellow->id")}}'>Ir a calificaciones</a>
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
			<h2><span class="score_a block">{{$fellow->total_participations($program->id)}}</span></h2>
	   </div>
		 <!-- ver sesión-->
		 <div class="col-sm-6">
			 <a class="btn view block sessions_l"  href='{{url("dashboard/fellows/programa/$program->id/ver-participaciones/$fellow->id")}}'>Ir a participaciones</a>
		 </div>
		 <div class="col-sm-12">
			 <div class="divider b"></div>
		 </div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<h1>Progreso en el "{{$program->title}}"</h1>
	</div>
</div>
<div class="box session_list">
	<div class="row">
		<div class="col-sm-6  center">
			<h3 class="title">Módulos completados</h3>
			<h2><span class="score_a block">{{$fellow->complete_modules($program->id)->count()}}</span></h2>
	   </div>
		 <!-- ver sesión-->
		 <div class="col-sm-6">
			 <a class="btn view block sessions_l"  href='{{url("dashboard/fellows/programa/$program->id/ver-progreso/$fellow->id")}}'>Ir a progreso</a>
		 </div>
		 <div class="col-sm-12">
			 <div class="divider b"></div>
		 </div>
	</div>
</div>

@endsection
