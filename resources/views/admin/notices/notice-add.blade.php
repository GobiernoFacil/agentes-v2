@extends('layouts.admin.a_master')
@section('title', 'Agregar convocatoria')
@section('description', 'Agregar convocatoria a la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'notice')
@section('breadcrumb_type', 'notice add')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_notice')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Agregar convocatoria</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
      @include('admin.notices.form.notice-add-form')
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
    $( "#startD" ).datepicker({minDate: new Date()});
    $( "#startE" ).datepicker({minDate: new Date()});
  } );

  $('#startD').on('change',function(){
    var date = new Date($('#startD').val());
    $('#startE').datepicker('destroy');
    $( "#startE" ).datepicker({minDate:date});
  });
  </script>
@endsection
