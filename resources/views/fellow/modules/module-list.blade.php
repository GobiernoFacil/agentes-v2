@extends('layouts.admin.a_master')
@section('title', 'Módulos de aprendizaje' )
@section('description', 'Módulos de aprendizaje')
@section('body_class', 'fellow aprendizaje')
@section('breadcrumb_type', 'module list')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_modules')

@section('content')
<div class="row">
	<div class="col-sm-12">
    	<h1>Módulos de aprendizaje</h1>
	</div>
</div>

<div class="row">
	<div class = "col-sm-12">
		<ul class="timeline">
		@foreach($modules as $module)
			<li class="active">{{$module->title}}</li>
		@endforeach
		</ul>
  	</div>
</div>

<div class="box">
	<div class="row">
		@foreach($modules as $module)
		<div class = "col-sm-4">
			<div class="module">
				<div class="row">
					<div class="col-sm-9">
						<h3>{{$module->title}}</h3>
					</div>
					<div class="col-sm-3">
						<div class="hours">
						<p><b></b> {{$module->number_hours}} h</p>
						</div>
					</div>
					<div class="col-sm-12">
						<p class="description">{{$module->objective}}</p>
					</div>
				</div>
				<div class="footer">
					<div class="row">
						<div class="col-sm-3">
							<p>{{$module->number_sessions}}					</p>
						</div>
						<div class="col-sm-6">
							<p class="center">{{$module->modality}}</p>
						</div>
						<div class="col-sm-3">
							<p class="right">{{$module->public ? 'Activo' : 'Candado'}}	</p>
						</div>
					</div>
				</div>
				@if($module->public && $today >= $module->start)
				<a href='{{ url("tablero/aprendizaje/{$module->slug}") }}' class="btn view">Ir al Módulo</a></li>
				@endif
			</div>



		</div>
		@endforeach
	</div>
</div>
@endsection
