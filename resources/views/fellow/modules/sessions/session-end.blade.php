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
	<div class="col-sm-4 col-sm-offset-4">
    @if($complete)
    	<div class="center ap_udidit">
			
			
			<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 237 237" style="enable-background:new 0 0 237 237;" xml:space="preserve">

<g>
	<path class="st0" d="M118.5,0.4c-65.1,0-118,52.9-118,118c0,65.1,52.9,118,118,118c65.1,0,118-52.9,118-118
		C236.5,53.3,183.5,0.4,118.5,0.4L118.5,0.4z M118.5,223.6c-28.9,0-55.1-11.7-74.2-30.6c-7.6-7.6-14.1-16.3-19.1-25.8
		c-7.7-14.6-12-31.2-12-48.7c0-58,47.2-105.2,105.2-105.2c27.5,0,52.6,10.6,71.4,28c9.7,9,17.8,19.8,23.6,31.9
		c6.6,13.7,10.3,29.1,10.3,45.4C223.7,176.4,176.5,223.6,118.5,223.6L118.5,223.6z M118.5,223.6"/>
	<path class="st0" d="M78.1,91.6c6.9,0,12.4,5.3,12.4,12.4h12.8c0-14.3-11.3-25.2-25.2-25.2c-13.9,0-25.2,10.8-25.2,25.2h12.8
		C65.7,96.9,71.3,91.6,78.1,91.6L78.1,91.6z M78.1,91.6"/>
	<path class="st0" d="M158.8,91.6c6.9,0,12.4,5.3,12.4,12.4H184c0-14.3-11.3-25.2-25.2-25.2c-13.9,0-25.2,10.8-25.2,25.2h12.8
		C146.4,96.9,151.9,91.6,158.8,91.6L158.8,91.6z M158.8,91.6"/>
	<path class="st0" d="M118.2,183.8c24.7,0,48.3-12.6,61.9-33.6l-10.7-6.9c-12.4,19.2-35.2,30-58,27.4c-17.7-2-34.2-12.3-43.9-27.4
		l-10.7,6.9c11.8,18.3,31.7,30.6,53.2,33.1C112.7,183.6,115.5,183.8,118.2,183.8L118.2,183.8z M118.2,183.8"/>
</g>
<g>
	<path class="st0" d="M118.5,0.4c-65.1,0-118,52.9-118,118c0,65.1,52.9,118,118,118c65.1,0,118-52.9,118-118
		C236.5,53.3,183.5,0.4,118.5,0.4L118.5,0.4z M118.5,223.6c-28.9,0-55.1-11.7-74.2-30.6c-7.6-7.6-14.1-16.3-19.1-25.8
		c-7.7-14.6-12-31.2-12-48.7c0-58,47.2-105.2,105.2-105.2c27.5,0,52.6,10.6,71.4,28c9.7,9,17.8,19.8,23.6,31.9
		c6.6,13.7,10.3,29.1,10.3,45.4C223.7,176.4,176.5,223.6,118.5,223.6L118.5,223.6z M118.5,223.6"/>
	<path class="st0" d="M78.1,91.6c6.9,0,12.4,5.3,12.4,12.4h12.8c0-14.3-11.3-25.2-25.2-25.2c-13.9,0-25.2,10.8-25.2,25.2h12.8
		C65.7,96.9,71.3,91.6,78.1,91.6L78.1,91.6z M78.1,91.6"/>
	<path class="st0" d="M158.8,91.6c6.9,0,12.4,5.3,12.4,12.4H184c0-14.3-11.3-25.2-25.2-25.2c-13.9,0-25.2,10.8-25.2,25.2h12.8
		C146.4,96.9,151.9,91.6,158.8,91.6L158.8,91.6z M158.8,91.6"/>
	<path class="st0" d="M118.2,183.8c24.7,0,48.3-12.6,61.9-33.6l-10.7-6.9c-12.4,19.2-35.2,30-58,27.4c-17.7-2-34.2-12.3-43.9-27.4
		l-10.7,6.9c11.8,18.3,31.7,30.6,53.2,33.1C112.7,183.6,115.5,183.8,118.2,183.8L118.2,183.8z M118.2,183.8"/>
</g>
</svg>
		<h1>Semana completada</h1>
		<p><a class="btn view block sessions_l" href="{{ url('tablero')}}">Regresar al programa</a></p>
	</div>
    @else
    	<div class="center ap_udidit">
			<h1>Semana sin completar</h1>
    	</div>
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
