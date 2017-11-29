@extends('layouts.frontend.master')
@section('title', 'Aplica a la Convocatoria '.$notice->title)
@section('description', 'Aplica a la Convocatoria '.$notice->title)
@section('body_class', 'convocatoria aplicar')
@section('canonical', url("convocatoria/aplicar/$notice->slug") )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_convocatoria')

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1><strong>Aplica</strong> a la Convocatoria {{$notice->title}}</h1>
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
		<p>{{$notice->description}}</p>
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
