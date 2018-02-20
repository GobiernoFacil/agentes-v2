@extends('layouts.admin.fellow_master')
@section('title', 'Aplicar a convocatoria '.$notice->title )
@section('description', 'Aplicar a convocatoria '.$notice->title)
@section('body_class', 'aspirante convocatoria')
@section('breadcrumb_type', 'notice apply video')
@section('breadcrumb', 'layouts.aspirant.breadcrumb.b_notices')

@section('content')

<!-- title -->
@include('aspirant.title_layout')

<div class="row">
	<div class="col-sm-12">
	   @include('aspirant.notices.forms.apply-3')
	</div>
</div>
@endsection

@section('js-content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

$('#filesForm').submit(function() {
	  $("#urlError").hide();
		var url = $('#video').val();
		if(isYoutube(url)){
			return true;
		}else{
			$("#urlError").show();
			return false; // return false to cancel form action
		}
});

function isYoutube(getURL){
	if(typeof getURL!=='string') return false;
	var newA = document.createElement('A');
	newA.href = getURL;
	var host = newA.hostname;
	var srch = newA.search;
	var path = newA.pathname;

	if(host.search(/youtube\.com|youtu\.be/)===-1) return false;
	if(host.search(/youtu\.be/)!==-1) return true;
	if(path.search(/embed/)!==-1) return true;
	var getId = /v=([A-z0-9]+)(\&|$)/.exec(srch);
	if(host.search(/youtube\.com/)!==-1) return true;
}
</script>

<script>
	// Set the date we're counting down to	
	var countDownDate = new Date("{{ date('M j, Y',strtotime($notice->end)) }} 23:59:59").getTime();
</script>
<script src="{{url('js/countdown.js')}}"></script>
@endsection
