@extends('layouts.admin.a_master')
@section('title', 'Fin de sesión '. $session->title )
@section('description', 'Fin de sesión '. $session->title )
@section('body_class', 'fellow aprendizaje modulos')
@section('breadcrumb_type', 'activity end')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_modules')
@section('subnav', 1)
@section('subnav_week', 1)

@section('content')

<?php $today = date("Y-m-d");?>
<div class="row">
	<div class="col-sm-12">
		@if(Session::has('success'))
		<div class="message success">
	      {{ Session::get('success') }}
	  	</div>
	  	@endif

			@if(Session::has('error'))
			<div class="message error">
		      {{ Session::get('error') }}
		  	</div>
		  	@endif
		<!--- session name-->
		<h4>{{$session->name}}</h4>
		<!--- activity title-->
		<div class="divider b"></div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
    @if($complete)
    <p>Sesión completada</p>
    @else
    <p>Sesión sin completar</p>
    @endif
	</div>
</div>



@endsection


@section('js-content')
<script>
	var module     = {!! json_encode($session->module) !!},
	    sessions   = {!! json_encode($session->module->sessions) !!},
	    activities = [];

	    @foreach($session->module->sessions as $session)
	    activities.push({!! json_encode($session->activities) !!});
	    @endforeach
</script>

<script src="{{url('js/app-display-week-menu.js')}}"></script>
@endsection
