@extends('layouts.admin.a_master')
@section('title', 'Agregar actividad')
@section('description', 'Agregar nueva actividad')
@section('body_class', 'program')
@section('breadcrumb_type', 'module session add activity')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar actividad</h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.modules.activities.form.activity-add-form')
    </div>
  </div>
</div>
@endsection

@section('js-content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( document ).ready(function() {
  $('#type').change(function(){
    if(this.value==='evaluation'){
      $('#user-file').show();
      $('#end-file').show();
      $('#video').hide();
      $('#webinar').hide();
    }else if(this.value==='final'){
      $('#user-file').hide();
      $('#end-file').show();
      $('#video').hide();
      $('#webinar').hide();
    }else if(this.value==='diagnostic'){
      $('#user-file').hide();
      $('#end-file').show();
      $('#video').hide();
      $('#webinar').hide();
    }else if(this.value==='video'){
      $('#user-file').hide();
      $('#end-file').hide();
      $('#video').show();
      $('#webinar').hide();
    }else if(this.value==='webinar'){
      $('#user-file').hide();
      $('#end-file').hide();
      $('#video').hide();
      $('#user-file').hide();
      $('#webinar').show();
    }else{
      $('#webinar').hide();
      $('#user-file').hide();
      $('#end-file').hide();
      $('#video').hide();
    }
  });
});

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
