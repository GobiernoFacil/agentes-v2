@extends('layouts.admin.a_master')
@section('title', 'Ver programa '. $program->title)
@section('description', 'Ver programa')
@section('body_class', 'program')
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
				<a href="#" class="current" id="about_box_btn">Acerca del programa</a>
			</li>
			<li class="col-sm-4">
				<a href="#" id="content_box_btn">Contenido</a>
			</li>
			<li class="col-sm-4">
				<a href="{{url('dashboard/programas/editar/' . $program->id)}}" class="btn view">Editar Programa</a>
			</li>
		</ul>
	</div><!-- cierra  container del master layout -->
</section><!-- cierra section del master layout -->

<section class="gray">
	<div class="container">
		
		<!-- about box -->
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
		<!--ends about box -->
		
		
		<!--content_box -->
		<div class="content_box" style="display: none">
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
		<!--ends content_box -->



		<script>
			(function(){
				var about_box       = "about_box",
				    content_box     = "content_box",
				    current         = "current",
				    about_box_btn   = "about_box_btn",
				    content_box_btn = "content_box_btn",
				    about_div       = document.querySelector("." + about_box),
				    content_div     = document.querySelector("." + content_box),
				    about_btn       = document.getElementById(about_box_btn),
				    content_btn     = document.getElementById(content_box_btn);


				about_btn.addEventListener("click", function(e){
					e.preventDefault();

					content_div.style.display = "none";
					about_div.style.display = "block";
					content_btn.classList.remove(current);
					if(!about_btn.classList.contains(current)) about_btn.classList.add(current);
				});

				content_btn.addEventListener("click", function(e){
					e.preventDefault();

					about_div.style.display = "none";
					content_div.style.display = "block";
					about_btn.classList.remove(current);
					if(!content_btn.classList.contains(current)) content_btn.classList.add(current);
				});


			})();
		</script>


@endsection