@if($type_list === 0)
<div class="row">
	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-sin-archivos")}}'>Aspirantes <span class= "strong" >no</span> válidos ({{$aWp_count}})</a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-sin-archivos-validos")}}'>Aspirantes <span class= "strong">con comprobante no válido ({{$aRp_count}})</span></a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-archivos-evaluados")}}'>Aspirantes <span class= "strong">evaluados ({{$aAe_count}})</span></a>
	</div>
	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-archivo-por-evaluar")}}'>Aspirantes por <span class= "strong" >evaluar ({{$aWpE_count}})</span></a>
	</div>
</div>
<p><strong>Todos los aspirantes con correo validado</strong></p>
@elseif($type_list === 1)
<div class="row">
	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/ver")}}'>Todos los  <span class= "strong" >aspirantes</span> ({{$aspirants->count()}})</a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-sin-archivos-validos")}}'>Aspirantes <span class= "strong">con comprobante no válido ({{$aRp_count}})</span></a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-archivos-evaluados")}}'>Aspirantes <span class= "strong">evaluados ({{$aAe_count}})</span></a>
	</div>
	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-archivo-por-evaluar")}}'>Aspirantes por <span class= "strong" >evaluar ({{$aWpE_count}})</span></a>
	</div>
</div>
<p><strong>Aspirantes no válidos, no cuentan con los requisitos para ver evaluados.</strong></p>
@elseif($type_list === 2)
<div class="row">
	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/ver")}}'>Todos los  <span class= "strong" >aspirantes</span> ({{$aspirants->count()}})</a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-sin-archivos")}}'>Aspirantes <span class= "strong" >no</span> válidos ({{$aWp_count}})</a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-archivos-evaluados")}}'>Aspirantes <span class= "strong">evaluados ({{$aAe_count}})</span></a>
	</div>
	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-archivo-por-evaluar")}}'>Aspirantes por <span class= "strong" >evaluar ({{$aWpE_count}})</span></a>
	</div>
</div>
<p><strong>Aspirantes evaluados con comprobante de domicilio no válido</strong></p>
@elseif($type_list === 3)
<div class="row">
	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/ver")}}'>Todos los  <span class= "strong" >aspirantes</span> ({{$aspirants->count()}})</a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-sin-archivos")}}'>Aspirantes <span class= "strong" >no</span> válidos ({{$aWp_count}})</a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-sin-archivos-validos")}}'>Aspirantes <span class= "strong">con comprobante no válido ({{$aRp_count}})</span></a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-archivo-por-evaluar")}}'>Aspirantes por <span class= "strong" >evaluar ({{$aWpE_count}})</span></a>
	</div>
</div>
<p><strong>Aspirantes con comprobante de domicilio evaluado</strong></p>
@elseif($type_list === 4)
<div class="row">
	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/ver")}}'>Todos los  <span class= "strong" >aspirantes</span> ({{$aspirants->count()}})</a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-sin-archivos")}}'>Aspirantes <span class= "strong" >no</span> válidos ({{$aWp_count}})</a>
	</div>

	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-sin-archivos-validos")}}'>Aspirantes <span class= "strong">con comprobante no válido ({{$aRp_count}})</span></a>
	</div>


	<div class="col-sm-3">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-archivos-evaluados")}}'>Aspirantes <span class= "strong">evaluados ({{$aAe_count}})</span></a>
	</div>

</div>
<p><strong>Aspirantes con comprobante de domicilio por evaluar</strong></p>
@endif
