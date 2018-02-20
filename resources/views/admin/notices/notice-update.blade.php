@extends('layouts.admin.a_master')
@section('title', 'Actualizar convocatoria')
@section('description', 'Actualizar convocatoria '.$notice->title)
@section('body_class', 'notice')
@section('breadcrumb_type', 'notice update')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_notice')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Actualizar convocatoria "{{$notice->title}}"</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
      @include('admin.notices.form.notice-update-form')
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
			selector: '.content',
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

			};

			input.click();
		},
			height: 700,
			theme: 'modern',
			plugins: [
				'advlist autolink lists link charmap preview hr anchor pagebreak',
				'searchreplace wordcount visualblocks visualchars code fullscreen',
				'insertdatetime nonbreaking save table contextmenu directionality',
				' template paste textcolor colorpicker textpattern imagetools codesample toc'
			],
			toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
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
