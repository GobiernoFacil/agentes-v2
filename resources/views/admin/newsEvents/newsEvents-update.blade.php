@extends('layouts.admin.a_master')
@section('title', '')
@section('description', '')
@section('body_class', '')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Actualizar {{$content->type==='news' ? 'noticia: ' : 'evento: ' }}{{$content->title}}</h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.newsEvents.form.newsEvents-update-form')
    </div>
  </div>
</div>
@endsection
@section('js-content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/tinymce/tinymce.min.js"></script>
<script>
$( document ).ready(function() {
  $('#type').change(function(){
    if(this.value==='news'){
      $('#eventData').hide();
    }else if(this.value==='event'){
      $('#eventData').show();
    }else{
      $('#eventData').hide();
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

tinymce.init({
    selector: 'textarea',
    height: 700,
    theme: 'modern',
    plugins: [
      'advlist autolink lists link image charmap preview hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars code fullscreen',
      'insertdatetime media nonbreaking save table contextmenu directionality',
      'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
    ],
    toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    toolbar2: 'preview media | forecolor backcolor  | codesample',
    image_advtab: true,
    language : 'es_MX',
    templates: [
      { title: 'Test template 1', content: 'Test 1' },
      { title: 'Test template 2', content: 'Test 2' }
    ],
    content_css: [
      '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
      '//www.tinymce.com/css/codepen.min.css'
    ]
   });
  </script>
@endsection
