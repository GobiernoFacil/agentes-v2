@extends('layouts.admin.fellow_master')
@section('title', 'Tablero de Control')
@section('description', 'Tablero de control de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'dashboard')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1 class="center">Convocatoria 2018. Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible. </h1>
		<p class="center">Para aplicar a la convocatoria es necesario que cumplas con los siguientes requisitos.<br>
			Recuerda que podrás actualizar la información hasta antes del <strong>05 de marzo de 2018</strong>.</p>
		<div class="divider"></div>
		<h5 class="center">Tienes:</h5>
	</div>
	<div id="as_coutdown" class="as_coutdown">
	<div class="col-sm-2 col-sm-offset-2">
		<h3 class="center"><span id="days">--</span> <span class="legend">días</span></h3>
	</div>						    
	<div class="col-sm-2">		    
		<h3 class="center"><span id="hours">--</span> <span class="legend">horas</span></h3>
	</div>						    
	<div class="col-sm-2">		    
		<h3 class="center"><span id="minutes">--</span> <span class="legend">minutos</span></h3>
	</div>						    
	<div class="col-sm-2">		    
		<h3 class="center"><span id="seconds">--</span> <span class="legend">segundos</span></h3>
	</div>
	</div>
	<div class="col-sm-12">
		<div class="divider"></div>
	</div>
</div>

<div class="row">
	
	<div class="col-sm-9">
		<div class="row">
			<!--convocatorias-->
			<div class="col-sm-12">
				<div class="box news">
					<h3 class="sa_title">Convocatorias</h3>
					<p></p>
					@if($notices->count()>0)
					<ul class="list line">
						@foreach($notices as $single)
							<div class="box session_list">
									<div class="row">
								<!--icono-->
								<div class="col-sm-1 right">
								  <b class="icon_h session list_s"></b>
								</div>
								<div class="col-sm-8">
								  <h2><a href='{{url("tablero-aspirante/convocatorias/{$single->notice->slug}")}}'>{{$single->notice->title}}</a></h2>
								  <div class="divider"></div>
								    <div class="row">
								      <div class="col-sm-9">
								        <p>{{$single->notice->description}}</p>
								      </div>
								    </div>
								  </div>
								  <!-- ver sesión-->
								  <div class="col-sm-3">
								    <a class="btn view block sessions_l" href='{{url("tablero-aspirante/convocatorias/{$single->notice->slug}")}}'>Ver convocatoria</a>
								  </div>
								          <!-- footnote-->
								  <div class="footnote">
								    <div class="row">
								      <div class="col-sm-4">
								        <p><b class="icon_h time"></b> Cierra:	<?php $stop_date = date('Y-m-d H:i:s', strtotime($single->notice->end . ' +1 day'));?>
					     				 <strong><span>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($stop_date))->diffForHumans()}}</span></strong></p>
								      </div>
								    </div>
								  </div>
									</div>
								</div>
						@endforeach
					</ul>
					<div class="row">
						<div class="col-sm-12">
							<div class="divider"></div>
						</div>
						<div class="col-sm-8 col-sm-offset-2 center">
							<p><a href="{{url('tablero-aspirante/convocatorias')}}" class="btn view gde ">Ver todas las convocatorias</a></p>
						</div>
					@else
					<p>Aún no existen convocatorias.</p>
					@endif
				</div>
			</div>
		</div>
	</div>
	

</div>
@endsection
@section('js-content')
<script>
// Set the date we're counting down to
var countDownDate = new Date("Jan 30, 2018 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();

  // Find the distance between now an the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  
  // Display the result in the elements with id
   document.getElementById("days").innerHTML = days;
   document.getElementById("hours").innerHTML = hours;
   document.getElementById("minutes").innerHTML = minutes;
   document.getElementById("seconds").innerHTML = seconds;

  // If the count down is finished, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("as_coutdown").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
@endsection