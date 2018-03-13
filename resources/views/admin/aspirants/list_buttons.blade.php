<div class="row">
	<div class="col-sm-12">
	<a class ="btn view {{ $type_list === 0 ? "active" : ''}}"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/ver")}}'>Todos <strong>({{$aspirants->count()}})</strong></a>
	<a class ="btn view {{ $type_list === 1 ? "active" : ''}}"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-sin-archivos")}}'>No válidos <strong>({{$aWp_count}})</strong></a>
	<a class ="btn view {{ $type_list === 2 ? "active" : ''}}"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-sin-archivos-validos")}}'>Comprobante no válido <strong>({{$aRp_count}})</strong></a>
	<a class ="btn view {{ $type_list === 3 ? "active" : ''}}"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-archivos-evaluados")}}'>Evaluados <strong>({{$aAe_count}})</strong></a>
	<a class ="btn view {{ $type_list === 4 ? "active" : ''}}"  href ='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-archivo-por-evaluar")}}'>Por evaluar <strong>({{$aWpE_count}})</strong></a>
	</div>
</div>

<div class="divider"></div>
@if($type_list === 0)
<h2><strong>Todos los aspirantes con correo validado</strong></h2>
@elseif($type_list === 1)
<h2><strong>Aspirantes no válidos, no cuentan con los requisitos para ver evaluados.</strong></h2>
@elseif($type_list === 2)
<h2><strong>Aspirantes evaluados con comprobante de domicilio no válido</strong></h2>
@elseif($type_list === 3)
<h2><strong>Aspirantes con comprobante de domicilio evaluado</strong></h2>
@elseif($type_list === 4)
<h2><strong>Aspirantes con comprobante de domicilio por evaluar</strong></h2>
@endif