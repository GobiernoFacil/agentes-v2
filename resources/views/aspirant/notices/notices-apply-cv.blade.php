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
  <?php echo 'var states     = '.$states_j.';'; ?>
	<?php echo 'var cities     = '.$cities.';'; ?>
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
    $( "#s_from" ).datepicker({changeYear:true,yearRange: "-100:+0"});
    $( "#s_to" ).datepicker({changeYear:true,yearRange: "-100:+0"});
		$( "#from" ).datepicker({changeYear:true,yearRange: "-100:+0"});
    $( "#tod" ).datepicker({changeYear:true,yearRange: "-100:+0"});
		$( "#from_open" ).datepicker({changeYear:true,yearRange: "-100:+0"});
    $( "#tod_open" ).datepicker({changeYear:true,yearRange: "-100:+0"});
		$( "#birthdate" ).datepicker({changeYear:true,yearRange: "-100:+0"});
  } );

	$('#s_from').on('change',function(){
		var date = new Date($('#s_from').val());
		$('#s_to').datepicker('destroy');
		$( "#s_to" ).datepicker({minDate:date,changeYear:true,yearRange: "-100:+0"});
	});

	$('#from').on('change',function(){
		var date = new Date($('#from').val());
		$('#tod').datepicker('destroy');
		$( "#tod" ).datepicker({minDate:date,changeYear:true,yearRange: "-100:+0"});
	});

	$('#from_open').on('change',function(){
		var date = new Date($('#from_open').val());
		$('#tod_open').datepicker('destroy');
		$( "#tod_open" ).datepicker({minDate:date,changeYear:true,yearRange: "-100:+0"});
	});



var CVID = {{$cv->id}};
var url_idioma_add      = "{{url("tablero-aspirante/idioma/agregar")}}",
    url_idioma_delete   = "{{url("tablero-aspirante/idioma/eliminar")}}",
    url_software_add    = "{{url("tablero-aspirante/programa/agregar")}}",
    url_software_delete = "{{url("tablero-aspirante/programa/eliminar")}}",
    url_experiencia_add = "{{url("tablero-aspirante/experiencia/agregar")}}",
    url_experiencia_delete = "{{url("tablero-aspirante/experiencia/eliminar")}}",
    url_estudios_add    = "{{url("tablero-aspirante/estudios/agregar")}}",
    url_estudios_delete = "{{url("tablero-aspirante/estudios/eliminar")}}",
		url_open_add    = "{{url("tablero-aspirante/experiencia-abierta/agregar")}}",
    url_open_delete = "{{url("tablero-aspirante/experiencia-abierta/eliminar")}}";

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
		var values = $(".language").map(function() {
			return this.value;
		}).get();
		var i = values.length,
				count = 0;
		while (i--) {
				if (values[i] === "" || values[i] === '0')
						count++;
		}

			if(count === 0){
						$('#fillLanguage').hide();

				    $.post(url, {name : name, level:level, _token : "{{ csrf_token() }}"}, function(d){
				      var el  = "<li data-id='" + d.id + "'>" +
				      d.name + " : " + d.level +
				      " <a href='#' class='remove-language'>[ x ]</a></li>";
				      $("#languages-list").append(el);
							$("#language").val("");
					    $("#language_level").val("");
				    }, "json");
			}else{
					$('#fillLanguage').show();
			}
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
		var values = $(".software").map(function() {
			return this.value;
		}).get();
		var i = values.length,
				count = 0;
		while (i--) {
				if (values[i] === "" || values[i] === '0')
						count++;
		}
		if(count === 0){
			$("#fillSoftware").hide();
	    $.post(url, {name : name, level:level, _token : "{{ csrf_token() }}"}, function(d){
	      var el  = "<li data-id='" + d.id + "'>" +
	      d.name + " : " + d.level +
	      " <a href='#' class='remove-software'>[ x ]</a></li>";
	      $("#softwares-list").append(el);
				$("#software").val("");
		    $("#software_level").val("");
	    }, "json");

		}else{
			$("#fillSoftware").show();
		}
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

	// open "CRUD"
	// ADD
	$("#add-open").on("click", function(e){
	  e.preventDefault();
	  var company     = $("#company_open").val(),
	      sector      = $("#sector_open").val(),
	      from        = $("#from_open").val(),
	      to          = $("#tod_open").val(),
	      city        = $("#open_city").val(),
	      state       = $("#open_state").val(),
	      description = $("#description_open").val(),
	      url         = url_open_add;

				var values = $(".open").map(function() {
	    		return this.value;
				}).get();
				var i = values.length,
						count = 0;
				while (i--) {
				    if (values[i] === "" || values[i] === '0')
				        count++;
				}

		if(count === 0){
			$("#fillOpen").hide();
			$.post(url, {name : name, company:company,sector:sector,from:from,to:to,city:city,state:state,description:description, _token : "{{ csrf_token() }}"}, function(d){
				if (typeof d.status !== 'undefined') {
						$("#maxExperienceOpen").show();

					}else{

						if(typeof d.words !== "undefined"){
							$("#maxWordsOpen").show();
							$("#nbwordsOpen").text(d.words);

						}else{
									$("#maxWordsOpen").hide();
									var el  = "<li data-id='" + d.id + "'>" +
									d.company + "<br>" + d.description
									" <a href='#' class='remove-experience'>[ x ]</a></li>";
									$("#experiencies-list-open").append(el);
								  $("#company_open").val("");
								  $("#sector_open").val("");
								  $("#from_open").val("");
								  $("#tod_open").val("");
								  $("#experience_city_open").val("");
								  $("#experience_state_open").val("");
								  $("#description_open").val("");
						}


					}
				}, "json");
		}else{
			$("#fillOpen").show();
		}

	});


	// open "CRUD"
	// REMOVE
	$("#experiencies-list-open").on("click", ".remove-experience-open", function(e){
	  e.preventDefault();
	  var li = $(e.currentTarget).parent(),
	  id = li.attr("data-id"),
	  url = url_open_delete;

	  $.post(url + "/" + id, {id : id, _token : "{{ csrf_token() }}"}, function(d){
			$("#maxExperienceOpen").hide();
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

			var values = $(".experience").map(function() {
    		return this.value;
			}).get();
			var i = values.length,
					count = 0;
			while (i--) {
			    if (values[i] === "" || values[i] === '0')
			        count++;
			}

	if(count === 0){
		$("#fillExperience").hide();
		$.post(url, {name : name, company:company,sector:sector,from:from,to:to,city:city,state:state,description:description, _token : "{{ csrf_token() }}"}, function(d){
			if (typeof d.status !== 'undefined') {
					$("#maxExperience").show();

				}else{

					if(typeof d.words !== "undefined"){
						$("#maxWords").show();
						$("#nbwords").text(d.words);

					}else{
								$("#maxWords").hide();
								var el  = "<li data-id='" + d.id + "'>" +
								d.name + " : " + d.company + "<br>" + d.description
								" <a href='#' class='remove-experience'>[ x ]</a></li>";
								$("#experiencies-list").append(el);
								$("#experience").val("");
							  $("#company").val("");
							  $("#sector").val("");
							  $("#from").val("");
							  $("#tod").val("");
							  $("#experience_city").val("");
							  $("#experience_state").val("");
							  $("#experience_description").val("");
					}


				}
			}, "json");
	}else{
		$("#fillExperience").show();
	}

});

// experience "CRUD"
// REMOVE
$("#experiencies-list").on("click", ".remove-experience", function(e){
  e.preventDefault();
  var li = $(e.currentTarget).parent(),
  id = li.attr("data-id"),
  url = url_experiencia_delete;

  $.post(url + "/" + id, {id : id, _token : "{{ csrf_token() }}"}, function(d){
		$("#maxExperience").hide();
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
			state       = $("#study_state").val(),
      url         = url_estudios_add;

			var values = $(".study").map(function() {
				return this.value;
			}).get();
			var i = values.length,
					count = 0;
			while (i--) {
					if (values[i] === "" || values[i] === '0')
							count++;
			}

		if(count === 0){
			$("#fillStudy").hide();
			$.post(url, {name : name, institution:institution,from:from,to:to,city:city,state:state, _token : "{{ csrf_token() }}"}, function(d){
				if (typeof d.status !== 'undefined') {
						$("#maxStudy").show();

					}else{

						    var from = d.from.split("-"),
						        to   = d.to.split("-"),
						        el  = "<li data-id='" + d.id + "'>" +
						    d.name + " : " + d.institution + "<br>" + from[1] + "/" + from[0] + " - " + to[1] + "/" + to[0] +
						    " <a href='#' class='remove-study'>[ x ]</a></li>";
						    $("#studies-list").append(el);
								$("#study").val("");
							  $("#institution").val("");
							  $("#s_from").val("");
							  $("#s_to").val("");
							  $("#study_city").val("");
								$("#study_state").val("");
					}
		  }, "json");
		}else{
			$("#fillStudy").show();
		}

});

// experience "CRUD"
// REMOVE
$("#studies-list").on("click", ".remove-study", function(e){
  e.preventDefault();
  var li = $(e.currentTarget).parent(),
  id = li.attr("data-id"),
  url = url_estudios_delete;

  $.post(url + "/" + id, {id : id, _token : "{{ csrf_token() }}"}, function(d){
		$("#maxStudy").hide();
    li.remove();
  }, "json");
});
});

var state_experience = document.getElementById("experience_state");
var city_experience  = document.getElementById("experience_city");


//selecciona un estado y agrega opciones a selector de municipios para experiencia
state_experience.addEventListener("change", function(){
	var value = this.value;
	//filtro de municipios
	var value = this.value;
	var n_cities = cities.filter(function (el) {
	   return (el.state === value);
	});
	//agregar opciones
	var city_experience =document.getElementById('experience_city');
	city_experience.options.length=0
	city_experience.options[0] = new Option("Selecciona una opción","",1,1);
	for (i=n_cities.length-1; i >= 0; i--){
		  city_experience.options[city_experience.options.length]=new Option(n_cities[i].city,n_cities[i].city);
	}
});

var state_study = document.getElementById("study_state");
var city_study  = document.getElementById("study_city");


//selecciona un estado y agrega opciones a selector de municipios para estudio
state_study.addEventListener("change", function(){
	var value = this.value;
	//filtro de municipios
	var value = this.value;
	var n_cities = cities.filter(function (el) {
	   return (el.state === value);
	});
	//agregar opciones
	var city_study =document.getElementById('study_city');
	city_study.options.length=0
	city_study.options[0] = new Option("Selecciona una opción","",1,1);
	for (i=n_cities.length-1; i >= 0; i--){
		  city_study.options[city_study.options.length]=new Option(n_cities[i].city,n_cities[i].city);
	}
});

var state_open = document.getElementById("open_state");
var city_open  = document.getElementById("open_city");


//selecciona un estado y agrega opciones a selector de municipios para estudio
state_open.addEventListener("change", function(){
	var value = this.value;
	//filtro de municipios
	var value = this.value;
	var n_cities = cities.filter(function (el) {
	   return (el.state === value);
	});
	//agregar opciones
	var city_open =document.getElementById('open_city');
	city_open.options.length=0
	city_open.options[0] = new Option("Selecciona una opción","",1,1);
	for (i=n_cities.length-1; i >= 0; i--){
		  city_open.options[city_open.options.length]=new Option(n_cities[i].city,n_cities[i].city);
	}
});

</script>
<script>
	// Set the date we're counting down to
	var countDownDate = new Date("{{ date('M j, Y',strtotime($notice->end)) }} 23:59:59").getTime();
</script>
<script src="{{url('js/countdown.js')}}"></script>
@endsection
