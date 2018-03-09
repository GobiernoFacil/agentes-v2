@extends('layouts.admin.fellow_master')
@section('title', 'Aplicar a convocatoria '.$notice->title )
@section('description', 'Aplicar a convocatoria '.$notice->title)
@section('body_class', 'aspirante convocatoria')
@section('breadcrumb_type', 'notice apply comprobante')
@section('breadcrumb', 'layouts.aspirant.breadcrumb.b_notices')

@section('content')

<!-- title -->
@include('aspirant.title_layout')

<div class="row">
	<div class="col-sm-12">
		@include('aspirant.notices.forms.apply-4')
	</div>
</div>
@endsection
@section('js-content')
<script>
	// Set the date we're counting down to
	var countDownDate = new Date("{{ date('M j, Y',strtotime($notice->end)) }} 23:59:59").getTime();

</script>
<script src="{{url('js/countdown.js')}}"></script>
<script>
var update_b = document.getElementById('update_b');
update_b.addEventListener('click',function(e){
		 e.preventDefault();
		 $('#updateBoxB').hide();
		 $('#inputFile').show();
		 console.log("click");

});


</script>
@endsection
