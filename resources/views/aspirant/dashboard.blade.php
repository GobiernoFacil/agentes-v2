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
	
	<div class="col-sm-12">
		<ul class="nav_aspira">
			<li><a class="current">1  MOTIVOS</a> </li>
			<li><a>2 CURRICULUM</a> </li>
			<li><a>3 VIDEO</a> </li>
			<li><a>4 COMPROBANTE</a></li>
			<li><a>5 AVISO</a></li>
		</ul>
	</div>
	
	<div class="col-sm-12">
		<h2>Exposición de motivos</h2>
		<p>Explica los motivos en donde manifiestes las razones por las cuales estas interesados en participar en el programa de formación.
(máximo 400 palabras).</p>
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