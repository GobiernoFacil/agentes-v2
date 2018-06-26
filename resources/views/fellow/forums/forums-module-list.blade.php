@extends('layouts.admin.a_master')
@section('title', 'Foros' )
@section('description','Módulos con foros del Programa de Gobierno Abierto desde lo local' )
@section('body_class', 'fellow foros')
@section('breadcrumb_type', 'forum module list')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_forum')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Foros de actividades</h1>
		<p>Selecciona un módulo para ver sus foros.</p>
	</div>
</div>


@if($modules->count()>0)
<div class="box forum_list">

@if($general)
	<!--título del módulo-->
	<div class="col-sm-9">
		<h2 class ="title">{{$general->topic}}</h2>
	</div>
	<div class="col-sm-3 right">
		<p>
			<a href='{{ url("tablero/$program->slug/foros/$general->slug") }}' class="btn xs view">Ver foro</a>
		</p>
	</div>

		<!--divider-->
		<div class="col-sm-12">
			<div class="divider"></div>
		</div>
@endif


	@foreach ($modules as $module)
	<!--título del módulo-->
	<div class="col-sm-9">
		<h2 class ="title">{{$module->title}}</h2>
	</div>
	<div class="col-sm-3 right">
		<p>
			<span class="score_a block">
				{{$module->get_all_activities_with_forums()->count() === 1 ? $module->get_all_activities_with_forums()->count()." foro" : $module->get_all_activities_with_forums()->count()." foros"}}
			</span>
			<a href='{{ url("tablero/$program->slug/foros/actividades/{$module->slug}") }}' class="btn xs view">Ver módulo</a>
		</p>
	</div>


	<!--divider-->
	<div class="col-sm-12">
		<div class="divider"></div>
	</div>

	@endforeach
	{{ $modules->links() }}
</div>

@else
<div class="row">
  <div class="col-sm-12">
    <p>Sin módulos con foros.</p>
  </div>
</div>
@endif


@endsection
