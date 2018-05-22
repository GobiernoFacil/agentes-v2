@extends('layouts.admin.a_master')
@section('title', 'Información acerca del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Información acerca del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'info')
@section('css-custom', 'css/logos.css')
@section('content')
		<!-- title -->
		<div class="row">
			<div class="col-sm-12">
				<h1 class="center">Programa de Formación de <strong>Agentes Locales de Cambio</strong> en <strong>Gobierno Abierto</strong> y <strong>Desarrollo Sostenible</strong>.</h1>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12">
				<div class="allies">
				<h2>Impartido por:</h2>
				<div class="row">
					<a href="https://www.usaid.gov/mexico" class="usaid">USAID</a>				
					<a href="http://www.mx.undp.org/" class="pnud">PNUD</a>				
					<a href="http://inicio.ifai.org.mx/SitePages/ifai.aspx" class="inai">INAI</a>				
					<a href="http://www.gesoc.org.mx/site/" class="gesoc">GESOC</a>				
					<a href="https://gobiernofacil.com/" class="gf">Gobierno Fácil</a>
					<a href="http://www.prosociedad.org/" class="prosociedad">Prosociedad</a>
				</div>
				</div>
			</div>
		</div>
		
		<ul class="row sub_nav_program">
			<li class="col-sm-3">
				<a href="#" class="current" id="about_box_btn">Acerca del programa</a>
			</li>
			<li class="col-sm-3">
				<a href="#" id="content_box_btn">Contenido</a>
			</li>
			<li class="col-sm-3">
				<a href="#" id="how_box_btn">Cómo funciona</a>
			</li>
			<li class="col-sm-3">
				<a href="{{url('tablero')}}" class="btn view">Comenzar Programa</a>
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
					<p>El programa tiene como propósitos el fortalecimiento de capacidades, la vinculación y empoderamiento de una red de Agentes Locales que promuevan la consolidación de acciones orientadas a fortalecer prácticas de transparencia y participación ciudadana a nivel local en México.</p>
					<p>Al concluir la etapa formativa, se esperaría que los egresados se integren y participen activamente en los trabajos que se realizan en su entidad federativa en el marco de los ejercicios locales de Gobierno Abierto promovidos por el INAI.</p>
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
								Seminarios presenciales
								</span>
								<span class="col-sm-9">
								2 seminarios
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
								Compromiso
								</span>
								<span class="col-sm-9">
								6 horas semanales
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
					<h2 class="center">Contenido del Programa</h2>
					@if($program->modules->count() > 0)
						@foreach ($program->modules as $module)
							@if($module->public)
								@include('fellow.info_program.list_program')
							@endif
						@endforeach
					@else
					<div class="box">
						<div class="row center">
							<h2>Sin módulos</h2>
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>
		<!--ends content_box -->
		
		
		<!--content_box -->
		<div class="how_box" style="display: none">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="center">Cómo funciona</h2>
					
					<!---cgenearl-->
					<div class="module">
						<div class="m_header">
							<div class="row">
								<div class="col-sm-6">
									<h4>General</h4>
								</div>
							</div>
						</div>
						<!--content-->
						<div class="m_content">
							<div class="row">
								<div class="col-sm-12">
									<h3>Calificación necesaria para aprobar el programa</h3>
									<p class="ap_time">Para aprobar el programa es necesario</p>
								</div>
							</div>
						</div>
					</div>
					
					
					<!---cgenearl-->
					<div class="module">
						<div class="m_header">
							<div class="row">
								<div class="col-sm-6">
									<h4>Colaboración con fellows de mi estado</h4>
								</div>
							</div>
						</div>
						<!--content-->
						<div class="m_content">
							<div class="row">
								<div class="col-sm-12">
									<h3>Calificación necesaria para aprobar el programa</h3>
									<p class="ap_time">Para aprobar el programa es necesario</p>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<!--ends content_box -->
		
@endsection

@section('js-content')
<script>
			(function(){
				var about_box       = "about_box",
				    content_box     = "content_box",
				    how_box     	= "how_box",
				    current         = "current",
				    about_box_btn   = "about_box_btn",
				    content_box_btn = "content_box_btn",
				    how_box_btn 	= "how_box_btn",
				    about_div       = document.querySelector("." + about_box),
				    content_div     = document.querySelector("." + content_box),
				    how_div     	= document.querySelector("." + how_box),
				    about_btn       = document.getElementById(about_box_btn),
				    content_btn     = document.getElementById(content_box_btn);
				    how_btn    		= document.getElementById(how_box_btn);


				about_btn.addEventListener("click", function(e){
					e.preventDefault();

					content_div.style.display = "none";
					how_div.style.display = "none";
					about_div.style.display = "block";
					content_btn.classList.remove(current);
					how_btn.classList.remove(current);
					if(!about_btn.classList.contains(current)) about_btn.classList.add(current);
				});

				content_btn.addEventListener("click", function(e){
					e.preventDefault();

					about_div.style.display = "none";
					how_div.style.display = "none";
					content_div.style.display = "block";
					about_btn.classList.remove(current);
					how_btn.classList.remove(current);
					if(!content_btn.classList.contains(current)) content_btn.classList.add(current);
				});
				
				how_btn.addEventListener("click", function(e){
					e.preventDefault();

					about_div.style.display = "none";
					content_div.style.display = "none";
					how_div.style.display = "block";
					about_btn.classList.remove(current);
					content_btn.classList.remove(current);
					if(!how_btn.classList.contains(current)) how_btn.classList.add(current);
				});


			})();
		</script>
@endsection