@extends('layouts.frontend.master')
@section('title', 'Aplica a la Convocatoria Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Aplica a la Convocatoria Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'convocatoria aplicar')
@section('canonical', url('convocatoria/aplicar') )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_convocatoria')

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1><strong>Aplica</strong> a la Convocatoria Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</h1>
		@if(Session::has('success'))
		<div class="message success">
	      {{ Session::get('success') }}
	  	</div>
	  	@endif
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		<p>El plazo de aplicación se inicia el día <strong>13 de marzo y termina el 13 de abril de 2017 a las 15:00 horas</strong> (tiempo de la Ciudad de México). Para poder aplicar es necesario que radiques en alguna de las 5 entidades federativas participantes (<strong>Chihuahua, Morelos, Nuevo León, Oaxaca y Sonora.</strong>). Antes de aplicar, ten preparados los requisitos mencionados en las <a href="{{url('convocatoria')}}">bases de la convocatoria</a>:</p>
		<ol>
			<li>Ensayo (no mayor a cinco cuartillas).</li>
			<li>Video breve (enlace).</li>
			<li>Perfil curricular actualizado.</li>
			<li>Carta membretada.</li>
			<li>Copia de comprobante de domicilio.</li>
			<li>Descargar, leer, firmar (en caso de aceptar) y enviar el <a href="aviso-privacidad">Aviso de Privacidad</a> por medio del cual otorguen el consentimiento relativo al tratamiento de sus datos personales, disponible en <a href="{{url('archivos/ConsentimientoDatosPersonales.pdf')}}" download>{{url('archivos/ConsentimientoDatosPersonales.docx')}}</a>.</li>
		</ol>
		<h2>Paso 1 de 2</h2>
		<p>Todos los campos son obligatorios.</p>
		@include('frontend.convocatoria.forms.register')
	</div>
</div>
@endsection

@section('js-content')
<script type="text/javascript">
var state  = document.getElementById('state'),
cities = document.getElementById('city');
// [ actualiza la lista de ciudades ]
state.onchange = function(e){

  if(!this.value){
    cities.innerHTML = "";
    return;
  }

  var request = new XMLHttpRequest();
  request.open('GET', '/cities?state=' + this.value, true);

  request.onload = function(){
    if (request.status >= 200 && request.status < 400) {
      var data = JSON.parse(request.responseText);
      cities.innerHTML = "";
      data.forEach(function(city){
        var opt = document.createElement('option');
        opt.value = city.city;
        opt.innerHTML = city.city;
        cities.appendChild(opt);
      });
    }
    else{
      // nope
    }
  };

  request.onerror = function(){
    // nope
  };
  request.send();
}
</script>
@endsection
