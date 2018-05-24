@extends('layouts.admin.fellow_master')
@section('title', 'Tablero de Control')
@section('description', 'Tablero de control de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'dashboard fellow')

@section('content')
@if($program)
	<div class="row">
		<div class="col-sm-12">
			<h1 class="center">Programa de Formación de <strong>Agentes Locales de Cambio</strong> en <strong>Gobierno Abierto y Desarrollo Sostenible</strong>. <span class="minimum">(<a href="{{url('tablero/informacion')}}">info del curso</a>)</span></h1>
		</div>

		@if(Session::has('message'))
			<div class="col-sm-12 message success">
					{{ Session::get('message') }}
			</div>
		@endif


		<div class="col-sm-1">
			<button id="ap-back" class="ap-advancer" type="button">
				<svg class="ap-timelineicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 551 1024"><path d="M445.44 38.183L-2.53 512l447.97 473.817 85.857-81.173-409.6-433.23v81.172l409.6-433.23L445.44 38.18z"/></svg>
			</button>
		</div>
		<div class="col-sm-10">
			<div class="timeline_box">
				<ul class="timeline" style="overflow: hidden;">
				@foreach($program->fellow_modules as $module)
				<li class="{{ $module->public && $today >= $module->start ? 'active' : 'disabled'}}">{{\Illuminate\Support\Str::words($module->title,2,'…')}}</li>
				@endforeach
				</ul>
			</div>
		</div>
		<div class="col-sm-1 right">
			<button id="ap-next" class="ap-advancer" type="button">
				<svg class="ap-timelineicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 551 1024"><path d="M105.56 985.817L553.53 512 105.56 38.183l-85.857 81.173 409.6 433.23v-81.172l-409.6 433.23 85.856 81.174z"/></svg>
			</button>
		</div>


		@if($user->log()->where('program_id',$program->id)->where('type','!=','first')->count()>0)
			<div class="col-sm-12">
				@if($session)
					@include('fellow.session-dash-view')
				@elseif($activity)
					@include('fellow.activity-dash-view')
				@elseif($module_last)
					@include('fellow.module-dash-view')
				@endif
			</div>
		@else
			<div class="box session_list">
				<div class="row">
					<div class="col-sm-12">
						@if($module->start > date('Y-m-d'))
							<p><strong>Aún no es tiempo para iniciar tu curso.</strong></p>
						@else
							<p><strong>Aún no cuentas con actividad, inicia tu curso.</strong></p>
						@endif
					</div>
					@include('fellow.module-first-dash-view')
				</div>
			</div>
		@endif
	</div>

	<div class="row">
		<div class = "col-sm-12">
			<?php $counter = 0;?>
			@foreach($program->fellow_modules as $module)
			<?php ++$counter;?>
				@include('fellow.dashboard_layout.dash_module')
			@endforeach
		</div>
	</div>
@else
<div class="row">
	<div class="col-sm-12">
		<h1 class="center">Programa de Formación de <strong>Agentes Locales de Cambio</strong> en <strong>Gobierno Abierto y Desarrollo Sostenible</strong>.</h1>
		<p>No existen programas que mostrar. Esto se debe a que no se te ha asignado uno o la fecha de inicio aún no esta próxima.</p>
	</div>
</div>
@endif

@endsection
@section('js-content')
<script src="{{url('js/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script>
(function(){
	var open_class = "ap-show",
	    close_class = "ap-close",
	    buttons = document.querySelectorAll("button"),
	    i;

	for(i = 0; i < buttons.length; i++){
		buttons[i].addEventListener("click", function(e){
			e.preventDefault();
			var _id       = this.getAttribute("data-div"),
			    content   = document.getElementById(_id),
			    is_hidden = content.style.display == "none";


			if(is_hidden){
				content.style.display = "block";
				this.classList.remove(open_class);
				this.classList.add(close_class);
			}
			else{
				content.style.display = "none";
				this.classList.add(open_class);
				this.classList.remove(close_class);
			}
		});
	}


	var backBtn   = document.getElementById("ap-back"),
	    nextBtn   = document.getElementById("ap-next"),
	    container = document.querySelector(".timeline"),
	    rail      = document.querySelector(".timeline_box"),
	    width     = container.offsetWidth,
	    _width    = rail.offsetWidth,
	    step      = 200,
	    magicNum  = 100,
	    current   = 0;



	nextBtn.addEventListener("click", function(e){
		var currentPos = Number(container.style.marginLeft.replace("px", ""));
		if(width + currentPos - magicNum > _width ){
			$(container).animate({marginLeft :  currentPos - step + "px"}, 300, function(){
			});
		}

	});

	backBtn.addEventListener("click", function(e){
		var currentPos = Number(container.style.marginLeft.replace("px", ""));

		if( currentPos < 0 ){
			$(container).animate({marginLeft :  currentPos + step + "px"}, 300, function(){
			});

		}
	});

})();
</script>
@endsection
