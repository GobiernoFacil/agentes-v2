@extends('layouts.admin.a_master')
@section('title', 'Aplicar a convocatoria '.$notice->title )
@section('description', 'Aplicar a convocatoria '.$notice->title)
@section('body_class', 'aspirante convocatoria')
@section('breadcrumb_type', 'notice apply')
@section('breadcrumb', 'layouts.aspirant.breadcrumb.b_notices')

@section('content')

<!-- title -->
<div class="row">
	<div class="col-sm-12">
    	<h3 class ="center">Aplicar a convocatoria "{{$notice->title}}""</h3>
		<h1 class="center">{{$notice->title}}</h1>
	</div>
</div>

<div class="box">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			@include('aspirant.notices.forms.apply-2')
		</div>
	</div>
</div>
@endsection

@section('js-content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

$.datepicker.regional['es'] = {
closeText: 'Cerrar',
prevText: '< Ant',
nextText: 'Sig >',
currentText: 'Hoy',
monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
weekHeader: 'Sm',
dateFormat: 'yy/mm/dd',
firstDay: 1,
isRTL: false,
showMonthAfterYear: false,
yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['es']);
  $( function() {
    $( "#s_from" ).datepicker({minDate: new Date()});
    $( "#s_to" ).datepicker({minDate: new Date()});
  } );

  $( function() {
    $( "#from" ).datepicker({minDate: new Date()});
    $( "#tod" ).datepicker({minDate: new Date()});
  } );


var CVID = {{$cv->id}};
// Laravel.csrfToken
$(function(){

  // PREVENT SUBMIT
  $("#extra-stuff").on("submit", function(e){
    return false;
  });

  // LANGUAGE "CRUD"
  // ADD
  $("#add-language").on("click", function(e){
    e.preventDefault();
    var name  = $("#language").val(),
    level = $("#language_level").val(),
    url   = "{{url("tablero-estudiante/idioma/agregar")}}";

    $.post(url, {name : name, level:level, _token : Laravel.csrfToken}, function(d){
      console.log(d);
      var el  = "<li data-id='" + d.id + "'>" +
      d.name + " : " + d.level +
      " <a href='#' class='remove-language'>[ x ]</a></li>";
      $("#languages-list").append(el);
    }, "json");
  });

  // LANGUAGE "CRUD"
  // REMOVE
  $("#languages-list").on("click", ".remove-language", function(e){
    e.preventDefault();
    var li = $(e.currentTarget).parent(),
    id = li.attr("data-id"),
    url = "{{url("tablero-estudiante/idioma/eliminar")}}";

    $.post(url + "/" + id, {id : id, _token : Laravel.csrfToken}, function(d){
      li.remove();
    }, "json");
  });

  // SOFTWARE "CRUD"
  // ADD
  $("#add-software").on("click", function(e){
    e.preventDefault();
    var name  = $("#software").val(),
    level = $("#software_level").val(),
    url   = "{{url("tablero-estudiante/programa/agregar")}}";

    $.post(url, {name : name, level:level, _token : Laravel.csrfToken}, function(d){
      console.log(d);
      var el  = "<li data-id='" + d.id + "'>" +
      d.name + " : " + d.level +
      " <a href='#' class='remove-software'>[ x ]</a></li>";
      $("#softwares-list").append(el);
    }, "json");
  });

  // SOFTWARE "CRUD"
  // REMOVE
  $("#softwares-list").on("click", ".remove-software", function(e){
    e.preventDefault();
    var li = $(e.currentTarget).parent(),
    id = li.attr("data-id"),
    url = "{{url("tablero-estudiante/programa/eliminar")}}";

    $.post(url + "/" + id, {id : id, _token : Laravel.csrfToken}, function(d){
      li.remove();
    }, "json");
  });

// Experiences "CRUD"
// ADD
$("#add-experience").on("click", function(e){
  e.preventDefault();
  var name        = $("#experience").val(),
      company     = $("#company").val(),
      sector      = $("#sector").val(),
      from        = $("#from").val(),
      to          = $("#tod").val(),
      city        = $("#experience_city").val(),
      state       = $("#experience_state").val(),
      description = $("#experience_description").val(),
      url         = "{{url("tablero-estudiante/experiencia/agregar")}}";

  $.post(url, {name : name, company:company,sector:sector,from:from,to:to,city:city,state:state,description:description, _token : Laravel.csrfToken}, function(d){
    var el  = "<li data-id='" + d.id + "'>" +
    d.name + " : " + d.company + "<br>" + d.description
    " <a href='#' class='remove-experience'>[ x ]</a></li>";
    $("#experiencies-list").append(el);
  }, "json");
});

// experience "CRUD"
// REMOVE
$("#experiencies-list").on("click", ".remove-experience", function(e){
  e.preventDefault();
  var li = $(e.currentTarget).parent(),
  id = li.attr("data-id"),
  url = "{{url("tablero-estudiante/experiencia/eliminar")}}";

  $.post(url + "/" + id, {id : id, _token : Laravel.csrfToken}, function(d){
    li.remove();
  }, "json");
});

// Studies "CRUD"
// ADD
$("#add-study").on("click", function(e){
  e.preventDefault();
  var name        = $("#study").val(),
      institution = $("#institution").val(),
      from        = $("#s_from").val(),
      to          = $("#s_to").val(),
      city        = $("#study_city").val(),
      url         = "{{url("tablero-estudiante/estudios/agregar")}}";

  $.post(url, {name : name, institution:institution,from:from,to:to,city:city, _token : Laravel.csrfToken}, function(d){
    var from = d.from.split("-"),
        to   = d.to.split("-"),
        el  = "<li data-id='" + d.id + "'>" +
    d.name + " : " + d.institution + "<br>" + from[1] + "/" + from[0] + " - " + to[1] + "/" + to[0] +
    " <a href='#' class='remove-study'>[ x ]</a></li>";
    $("#studies-list").append(el);
  }, "json");
});

// experience "CRUD"
// REMOVE
$("#studies-list").on("click", ".remove-study", function(e){
  e.preventDefault();
  var li = $(e.currentTarget).parent(),
  id = li.attr("data-id"),
  url = "{{url("tablero-estudiante/estudios/eliminar")}}";

  $.post(url + "/" + id, {id : id, _token : Laravel.csrfToken}, function(d){
    li.remove();
  }, "json");
});
});


</script>
@endsection
