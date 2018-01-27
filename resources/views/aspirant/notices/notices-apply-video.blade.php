@extends('layouts.admin.a_master')
@section('title', 'Aplicar a convocatoria '.$notice->title )
@section('description', 'Aplicar a convocatoria '.$notice->title)
@section('body_class', 'aspirante convocatoria')
@section('breadcrumb_type', 'notice apply')
@section('breadcrumb', 'layouts.aspirant.breadcrumb.b_notices')

@section('content')

<!-- title -->
<div class="row">
	<div class="col-sm-12">
    	<h3 class ="center">Aplicar a convocatoria "{{$notice->title}}""</h3>
		<h1 class="center">{{$notice->title}}</h1>
	</div>
</div>

<div class="box">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			@include('aspirant.notices.forms.apply-3')
		</div>
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
@endsection
