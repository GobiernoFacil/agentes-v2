@extends('layouts.frontend.master')
@section('title', 'Aplica a la Convocatoria '.$notice->title)
@section('description', 'Aplica a la Convocatoria '.$notice->title)
@section('body_class', 'convocatoria aplicar')
@section('canonical', url("convocatoria/aplicar/$notice->slug") )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_convocatoria')

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1><strong>Aplica</strong> a {{$notice->title}}</h1>
		@if(Session::has('success'))
		<div class="message success">
	      {{ Session::get('success') }}
	  	</div>
	  	@endif
			@if(Session::has('error'))
			<div class="message error">
		      {{ Session::get('error') }}
		  	</div>
		  	@endif
	</div>
	<div class="col-sm-8 col-sm-offset-2">
		{!! $notice->description !!}
		<h2>Paso 1 de 2</h2>
		<p>Todos los campos son obligatorios.</p>
		@include('frontend.convocatoria.forms.register')
	</div>
</div>
@endsection

@section('js-content')
<script type="text/javascript">

<?php echo 'var cities     = '.$cities.';'; ?>
var state = document.getElementById("state");
var city  = document.getElementById("city");


//selecciona un estado y agrega opciones a selector de municipios para experiencia
state.addEventListener("change", function(){
	var value = this.value.normalize('NFD').replace(/[\u0300-\u036f]/g, "").toLowerCase();
	var n_cities = cities.filter(function (el) {
	   return (el.state.normalize('NFD').replace(/[\u0300-\u036f]/g, "").toLowerCase() === value);
	});
	//agregar opciones
	var city =document.getElementById('city');
	city.options.length=0
	city.options[0] = new Option("Selecciona una opción",0,1,1);
	for (i=n_cities.length-1; i >= 0; i--){
		  city.options[city.options.length]=new Option(n_cities[i].city,n_cities[i].city);
	}
});

</script>
@endsection
