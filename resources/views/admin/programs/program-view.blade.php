@extends('layouts.admin.a_master')
@section('title', 'Ver programa '. $program->title)
@section('description', 'Ver programa')
@section('body_class', 'program view')
@section('breadcrumb_type', 'program view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')
@section('content')

		<!-- title -->
		<div class="row">
			<div class="col-sm-12">
				<h1 class="center">{{$program->title}}</h1>
			</div>
		</div>
		
		<ul class="row sub_nav_program">
			<li class="col-sm-4">
				<a href="#" class="current">Acerca del programa</a>
			</li>
			<li class="col-sm-4">
				<a href="#">Contenido</a>
			</li>
			<li class="col-sm-4">
				<a href="{{url('dashboard/programas/editar/' . $program->id)}}" class="btn view">Editar Programa</a>
			</li>
		</ul>
	</div><!-- cierra  container del master layout -->
</section><!-- cierra section del master layout -->

<section class="gray">
	<div class="container">
		
		<!--about box--->
		<div class="about_box">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="center">Acerca del programa</h2>
					<p>{{$program->description}}</p>
				</div>
				<div class="col-sm-10 col-sm-offset-1">
					<div class="box">
						<ul class="list_line">
							<li class="row">
								<span class="col-sm-3">
								Duración
								</span>
								<span class="col-sm-9">
								{{$program->number_hours ? $program->number_hours . 'horas' : '' }} del {{date("d-m-Y", strtotime($program->start))}} al {{date('d-m-Y', strtotime($program->end))}}
								</span>
							</li>
							<li class="row">
								<span class="col-sm-3">
								Semanas
								</span>
								<span class="col-sm-9">
								{{$program->modules->count()}}
								</span>
							</li>
							<li class="row">
								<span class="col-sm-3">
								Publicado
								</span>
								<span class="col-sm-9">
									<span class="published {{$program->public ? 'view' : ''}}">{{$program->public ? 'Sí' : 'No'}}</span>
								</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!--ends about box--->
		
		
		<!--content_box--->
		<div class="content_box">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="center">Contenido</h2>
					<p class="center"><a href='{{url("dashboard/programas/$program->id/modulos/agregar")}}' class="btn xs ev">+ Agregar módulo</a></p>
					@if($program->modules->count() > 0)
						@foreach ($program->modules as $module)
							@include('admin.programs.program_layout.module_list')
						@endforeach
					@else
					<div class="box">
						<div class="row center">
							<h2>Sin módulos</h2>
							<p><a href='{{url("dashboard/programas/$program->id/modulos/agregar")}}' class="btn xs view">Agregar módulo</a></p>
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>
		<!--ends content_box--->


@endsection