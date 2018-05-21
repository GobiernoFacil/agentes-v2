@extends('layouts.admin.a_master')
@section('title', 'Agregar módulo a programa '.$program->title)
@section('description', 'Agregar nuevo módulo a programa '.$program->title)
@section('body_class', 'program')
@section('breadcrumb_type', 'module add')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar módulo a programa: "{{$program->title}}"</h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.modules.form.module-add-form')
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
  } );

  $('#startD').on('change',function(){
    var date = new Date($('#startD').val());
    $('#startE').datepicker('destroy');
    date.setDate(date.getDate()+6);
    if(date.getMonth()+1 < 10){
      if(date.getDate()< 10){
        $( "#startE").val(date.getFullYear()+'/0'+(date.getMonth()+1)+'/0'+date.getDate());
        $( "#startE").attr('val',date.getFullYear()+'/0'+(date.getMonth()+1)+'/0'+date.getDate());
      }else{
        $( "#startE").val(date.getFullYear()+'/0'+(date.getMonth()+1)+'/'+date.getDate());
        $( "#startE").attr('val',date.getFullYear()+'/0'+(date.getMonth()+1)+'/'+date.getDate());
      }
    }else{
      if(date.getDate()< 10){
        $( "#startE").val(date.getFullYear()+'/'+(date.getMonth()+1)+'/0'+date.getDate());
        $( "#startE").attr('val',date.getFullYear()+'/'+(date.getMonth()+1)+'/0'+date.getDate());
      }else{
        $( "#startE").val(date.getFullYear()+'/'+(date.getMonth()+1)+'/'+date.getDate());
        $( "#startE").attr('val',date.getFullYear()+'/'+(date.getMonth()+1)+'/'+date.getDate());
      }
    }
  });
  </script>
@endsection
