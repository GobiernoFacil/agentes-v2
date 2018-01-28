@extends('layouts.admin.fellow_master')
@section('title', 'Aplicar a convocatoria '.$notice->title )
@section('description', 'Aplicar a convocatoria '.$notice->title)
@section('body_class', 'aspirante convocatoria')
@section('breadcrumb_type', 'notice apply cv')
@section('breadcrumb', 'layouts.aspirant.breadcrumb.b_notices')

@section('content')

@include('aspirant.title_layout')

<div class="row">
	<div class="col-sm-12">
		@include('aspirant.notices.forms.apply-2')
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
var url_idioma_add      = "{{url("tablero-aspirante/idioma/agregar")}}",
    url_idioma_delete   = "{{url("tablero-aspirante/idioma/eliminar")}}",
    url_software_add    = "{{url("tablero-aspirante/programa/agregar")}}",
    url_software_delete = "{{url("tablero-aspirante/programa/eliminar")}}",
    url_experiencia_add = "{{url("tablero-aspirante/experiencia/agregar")}}",
    url_experiencia_delete = "{{url("tablero-aspirante/experiencia/eliminar")}}",
    url_estudios_add    = "{{url("tablero-aspirante/estudios/agregar")}}",
    url_estudios_delete = "{{url("tablero-aspirante/estudios/eliminar")}}";

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
    url   = url_idioma_add;

    $.post(url, {name : name, level:level, _token : "{{ csrf_token() }}"}, function(d){
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
    url = url_idioma_delete;

    $.post(url + "/" + id, {id : id, _token : "{{ csrf_token() }}"}, function(d){
      li.remove();
    }, "json");
  });

  // SOFTWARE "CRUD"
  // ADD
  $("#add-software").on("click", function(e){
    e.preventDefault();
    var name  = $("#software").val(),
    level = $("#software_level").val(),
    url   = url_software_add;

    $.post(url, {name : name, level:level, _token : "{{ csrf_token() }}"}, function(d){
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
    url = url_software_delete;

    $.post(url + "/" + id, {id : id, _token : "{{ csrf_token() }}"}, function(d){
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
      url         = url_experiencia_add;

  $.post(url, {name : name, company:company,sector:sector,from:from,to:to,city:city,state:state,description:description, _token : "{{ csrf_token() }}"}, function(d){
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
  url = url_experiencia_delete;

  $.post(url + "/" + id, {id : id, _token : "{{ csrf_token() }}"}, function(d){
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
      url         = url_estudios_add;

  $.post(url, {name : name, institution:institution,from:from,to:to,city:city, _token : "{{ csrf_token() }}"}, function(d){
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
  url = url_estudios_delete;

  $.post(url + "/" + id, {id : id, _token : "{{ csrf_token() }}"}, function(d){
    li.remove();
  }, "json");
});
});

</script>
<script>
	// Set the date we're counting down to	
	var countDownDate = new Date("{{ date('M j, Y',strtotime($notice->end)) }} 23:59:59").getTime();
</script>
<script src="{{url('js/countdown.js')}}"></script>
@endsection
