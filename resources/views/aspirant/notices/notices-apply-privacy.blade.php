@extends('layouts.admin.fellow_master')
@section('title', 'Aplicar a convocatoria '.$notice->title )
@section('description', 'Aplicar a convocatoria '.$notice->title)
@section('body_class', 'aspirante convocatoria')
@section('breadcrumb_type', 'notice apply aviso')
@section('breadcrumb', 'layouts.aspirant.breadcrumb.b_notices')

@section('content')

<!-- title -->
@include('aspirant.title_layout')

<div class="row">
	<div class="col-sm-12">
		<h2>AVISO DE PRIVACIDAD DE LA CONVOCATORIA DEL PROGRAMA DE FORMACIÓN DE AGENTES LOCALES DE CAMBIO EN GOBIERNO ABIERTO Y DESARROLLO SOSTENIBLE. <span>{{$notice->title}}</span></h2>
		<h3>Del responsable de tratar sus datos personales</h3>
		<p>El Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales (INAI), con domicilio en Av. Insurgentes Sur, No. 3211, Col. Insurgentes Cuicuilco, Coyoacán, C.P. 04530, Ciudad de México, es el responsable del tratamiento de los datos personales que nos proporcione, los cuales serán protegidos conforme a lo dispuesto en la Ley General de Protección de Datos Personales en Posesión de Sujetos Obligados, y demás normatividad que resulte aplicable. </p>

		
		<div class="divider"></div>
		@include('aspirant.notices.forms.apply-5')
	</div>
</div>
@endsection
@section('js-content')
<script>
	// Set the date we're counting down to
	var countDownDate = new Date("{{ date('M j, Y',strtotime($notice->end)) }} 23:59:59").getTime();
</script>
<script src="{{url('js/countdown.js')}}"></script>
@endsection
