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
				<a href="#" class="current tour_1" id="about_box_btn">Acerca del programa</a>
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
<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
<script src="/js/jquery.easing.1.3.js"></script>
<script src="/js/cufon-yui.js"></script>
<script src="/js/ChunkFive_400.font.js"></script>
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




				/*****/
			$(function() {
				/*
				the json config obj.
				name: the class given to the element where you want the tooltip to appear
				bgcolor: the background color of the tooltip
				color: the color of the tooltip text
				text: the text inside the tooltip
				time: if automatic tour, then this is the time in ms for this step
				position: the position of the tip. Possible values are
					TL	top left
					TR  top right
					BL  bottom left
					BR  bottom right
					LT  left top
					LB  left bottom
					RT  right top
					RB  right bottom
					T   top
					R   right
					B   bottom
					L   left
				 */
				var config = [
					{
						"name" 		: "tour_1",
						"bgcolor"	: "black",
						"color"		: "white",
						"position"	: "B",
						"text"		: "Submenú del programa",
						"time" 		: 5000
					}/*,
					{
						"name" 		: "tour_2",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "Give a class to the points of your walkthrough",
						"position"	: "BL",
						"time" 		: 5000
					},
					{
						"name" 		: "tour_3",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "Customize the navigation buttons",
						"position"	: "BL",
						"time" 		: 5000
					},
					{
						"name" 		: "tour_4",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "You can also use the autoplay function where the user can just sit back and watch the whole tour",
						"position"	: "TL",
						"time" 		: 5000
					},
					{
						"name" 		: "tour_5",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "You can indicate the direction of the tooltip arrow for each tour point",
						"position"	: "TL",
						"time" 		: 5000
					},
					{
						"name" 		: "tour_6",
						"bgcolor"	: "#111199",
						"color"		: "white",
						"text"		: "Mark important tour points in a different color",
						"position"	: "BL",
						"time" 		: 5000
					},
					{
						"name" 		: "tour_7",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "Automatically scrolls to the right place of the website",
						"position"	: "TL",
						"time" 		: 5000
					}*/

				],
				//define if steps should change automatically
				autoplay	= false,
				//timeout for the step
				showtime,
				//current step of the tour
				step		= 0,
				//total number of steps
				total_steps	= config.length;
					
				//show the tour controls
				showControls();
				
				/*
				we can restart or stop the tour,
				and also navigate through the steps
				 */
				$('#activatetour').live('click',startTour);
				$('#canceltour').live('click',endTour);
				$('#endtour').live('click',endTour);
				$('#restarttour').live('click',restartTour);
				$('#nextstep').live('click',nextStep);
				$('#prevstep').live('click',prevStep);
				
				function startTour(){
					$('#activatetour').remove();
					$('#endtour,#restarttour').show();
					if(!autoplay && total_steps > 1)
						$('#nextstep').show();
					showOverlay();
					nextStep();
				}
				
				function nextStep(){
					if(!autoplay){
						if(step > 0)
							$('#prevstep').show();
						else
							$('#prevstep').hide();
						if(step == total_steps-1)
							$('#nextstep').hide();
						else
							$('#nextstep').show();
					}	
					if(step >= total_steps){
						//if last step then end tour
						endTour();
						return false;
					}
					++step;
					showTooltip();
				}
				
				function prevStep(){
					if(!autoplay){
						if(step > 2)
							$('#prevstep').show();
						else
							$('#prevstep').hide();
						if(step == total_steps)
							$('#nextstep').show();
					}		
					if(step <= 1)
						return false;
					--step;
					showTooltip();
				}
				
				function endTour(){
					step = 0;
					if(autoplay) clearTimeout(showtime);
					removeTooltip();
					hideControls();
					hideOverlay();
				}
				
				function restartTour(){
					step = 0;
					if(autoplay) clearTimeout(showtime);
					nextStep();
				}
				
				function showTooltip(){
					//remove current tooltip
					removeTooltip();
					
					var step_config		= config[step-1];
					var $elem			= $('.' + step_config.name);
					
					if(autoplay)
						showtime	= setTimeout(nextStep,step_config.time);
					
					var bgcolor 		= step_config.bgcolor;
					var color	 		= step_config.color;
					
					var $tooltip		= $('<div>',{
						id			: 'tour_tooltip',
						className 	: 'tooltip',
						html		: '<p>'+step_config.text+'</p><span class="tooltip_arrow"></span>'
					}).css({
						'display'			: 'none',
						'background-color'	: bgcolor,
						'color'				: color
					});
					
					//position the tooltip correctly:
					
					//the css properties the tooltip should have
					var properties		= {};
					
					var tip_position 	= step_config.position;
					
					//append the tooltip but hide it
					$('BODY').prepend($tooltip);
					
					//get some info of the element
					var e_w				= $elem.outerWidth();
					var e_h				= $elem.outerHeight();
					var e_l				= $elem.offset().left;
					var e_t				= $elem.offset().top;
					
					
					switch(tip_position){
						case 'TL'	:
							properties = {
								'left'	: e_l,
								'top'	: e_t + e_h + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_TL');
							break;
						case 'TR'	:
							properties = {
								'left'	: e_l + e_w - $tooltip.width() + 'px',
								'top'	: e_t + e_h + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_TR');
							break;
						case 'BL'	:
							properties = {
								'left'	: e_l + 'px',
								'top'	: e_t - $tooltip.height() + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_BL');
							break;
						case 'BR'	:
							properties = {
								'left'	: e_l + e_w - $tooltip.width() + 'px',
								'top'	: e_t - $tooltip.height() + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_BR');
							break;
						case 'LT'	:
							properties = {
								'left'	: e_l + e_w + 'px',
								'top'	: e_t + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_LT');
							break;
						case 'LB'	:
							properties = {
								'left'	: e_l + e_w + 'px',
								'top'	: e_t + e_h - $tooltip.height() + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_LB');
							break;
						case 'RT'	:
							properties = {
								'left'	: e_l - $tooltip.width() + 'px',
								'top'	: e_t + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RT');
							break;
						case 'RB'	:
							properties = {
								'left'	: e_l - $tooltip.width() + 'px',
								'top'	: e_t + e_h - $tooltip.height() + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RB');
							break;
						case 'T'	:
							properties = {
								'left'	: e_l + e_w/2 - $tooltip.width()/2 + 'px',
								'top'	: e_t + e_h + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_T');
							break;
						case 'R'	:
							properties = {
								'left'	: e_l - $tooltip.width() + 'px',
								'top'	: e_t + e_h/2 - $tooltip.height()/2 + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_R');
							break;
						case 'B'	:
							properties = {
								'left'	: e_l + e_w/2 - $tooltip.width()/2 + 'px',
								'top'	: e_t - $tooltip.height() + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_B');
							break;
						case 'L'	:
							properties = {
								'left'	: e_l + e_w  + 'px',
								'top'	: e_t + e_h/2 - $tooltip.height()/2 + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_L');
							break;
					}
					
					
					/*
					if the element is not in the viewport
					we scroll to it before displaying the tooltip
					 */
					var w_t	= $(window).scrollTop();
					var w_b = $(window).scrollTop() + $(window).height();
					//get the boundaries of the element + tooltip
					var b_t = parseFloat(properties.top,10);
					
					if(e_t < b_t)
						b_t = e_t;
					
					var b_b = parseFloat(properties.top,10) + $tooltip.height();
					if((e_t + e_h) > b_b)
						b_b = e_t + e_h;
						
					
					if((b_t < w_t || b_t > w_b) || (b_b < w_t || b_b > w_b)){
						$('html, body').stop()
						.animate({scrollTop: b_t}, 500, 'easeInOutExpo', function(){
							//need to reset the timeout because of the animation delay
							if(autoplay){
								clearTimeout(showtime);
								showtime = setTimeout(nextStep,step_config.time);
							}
							//show the new tooltip
							$tooltip.css(properties).show();
						});
					}
					else
					//show the new tooltip
						$tooltip.css(properties).show();
				}
				
				function removeTooltip(){
					$('#tour_tooltip').remove();
				}
				
				function showControls(){
					/*
					we can restart or stop the tour,
					and also navigate through the steps
					 */
					var $tourcontrols  = '<div id="tourcontrols" class="tourcontrols">';
					$tourcontrols += '<p>¿Es la primera vez que entras?</p>';
					$tourcontrols += '<span class="button" id="activatetour">Ve la ayuda</span>';
						if(!autoplay){
							$tourcontrols += '<div class="nav"><span class="button" id="prevstep" style="display:none;">< Anterior</span>';
							$tourcontrols += '<span class="button" id="nextstep" style="display:none;">Siguiente ></span></div>';
						}
						$tourcontrols += '<a id="restarttour" style="display:none;">muestra la ayuda</span>';
						$tourcontrols += '<a id="endtour" style="display:none;">oculta la ayuda</a>';
						$tourcontrols += '<span class="close" id="canceltour"></span>';
					$tourcontrols += '</div>';
					
					$('BODY').prepend($tourcontrols);
					$('#tourcontrols').animate({'right':'30px'},500);
				}
				
				function hideControls(){
					$('#tourcontrols').remove();
				}
				
				function showOverlay(){
					var $overlay	= '<div id="tour_overlay" class="overlay"></div>';
					$('BODY').prepend($overlay);
				}
				
				function hideOverlay(){
					$('#tour_overlay').remove();
				}
				
			});
				/******/


			})();
		</script>
@endsection