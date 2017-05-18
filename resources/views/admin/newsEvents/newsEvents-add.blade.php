@extends('layouts.admin.a_master')
@section('title', 'Agregar noticia')
@section('description', 'Agregar nueva noticia')
@section('body_class', '')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar Noticia o Evento</h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.newsEvents.form.newsEvents-add-form')
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
    relative_urls : false,
    remove_script_host : false,
    convert_urls : true,
    file_picker_callback: function(cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    // Note: In modern browsers input[type="file"] is functional without
    // even adding it to the DOM, but that might not be the case in some older
    // or quirky browsers like IE, so you might want to add it to the DOM
    // just in case, and visually hide it. And do not forget do remove it
    // once you do not need it anymore.

    input.onchange = function() {
      var file = this.files[0];

      var reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = function () {
        // Note: Now we need to register the blob in TinyMCEs image blob
        // registry. In the next release this part hopefully won't be
        // necessary, as we are looking to handle it internally.
        var id = 'blobid' + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var blobInfo = blobCache.create(id, file, reader.result);
        blobCache.add(blobInfo);

        // call the callback and populate the Title field with the file name
        cb(blobInfo.blobUri(), { title: file.name });
      };
    };

    input.click();
  },
  images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '{{url("noticias-eventos/update/image")}}');
            var token = '{{ csrf_token() }}';
            xhr.setRequestHeader("X-CSRF-Token", token);
            xhr.onload = function() {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                success(json.location);
            };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        },
    height: 700,
    theme: 'modern',
    plugins: [
      'advlist autolink lists link image charmap preview hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars code fullscreen',
      'insertdatetime nonbreaking save table contextmenu directionality',
      ' template paste textcolor colorpicker textpattern imagetools codesample toc'
    ],
    toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    toolbar2: 'preview  | forecolor backcolor  | codesample',
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
