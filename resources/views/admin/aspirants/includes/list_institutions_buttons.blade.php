<div class="row">
	<div class="col-sm-4">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-aplicacion-por-evaluar")}}'>Tus aspirantes por <span class= "strong" > evaluar</span> ({{$asToE_count}})</a>
	</div>
	<div class="col-sm-4">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-aplicacion-evaluada")}}'>Tus aspirantes <span class= "strong">evaluados ({{$aIaE_count}})</span></a>
	</div>
	<div class="col-sm-4">
		<a class ="btn view gde"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/todos-los-aspirantes-con-aplicacion-evaluada")}}'>Todos los aspirantes<span class= "strong" > evaluados</span> ({{$aAe_count}})</a>
	</div>
</div>


<div class="divider"></div>

@if($type_list === 0)
<h2><strong>Todos los aspirantes</strong></h2>
@elseif($type_list === 1)
<h2><strong>Tus aspirantes por evaluar</strong></h2>
@elseif($type_list === 2)
<h2><strong>Tus aspirantes evaluados</strong></h2>
@endif