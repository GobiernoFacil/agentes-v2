<div class="row">
	<div class="col-sm-4">
		<a class="btn view gde {{ $type_list === 1 ? "active" : ''}}"  href='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-aplicacion-por-evaluar")}}'>Tus aspirantes por evaluar <strong>({{$asToE_count}})</strong></a>
	</div>
	<div class="col-sm-4">
		<a class="btn view gde {{ $type_list === 2 ? "active" : ''}}"  href='{{url("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-aplicacion-evaluada")}}'>Tus aspirantes evaluados <strong>({{$aIaE_count}})</strong></a>
	</div>
	<div class="col-sm-4">
		<a class="btn view gde {{ $type_list === 0 ? "active" : ''}}"  href='{{url("dashboard/aspirantes/convocatoria/$notice->id/todos-los-aspirantes-con-aplicacion-evaluada")}}'>Todos los aspirantes evaluados <strong>({{$aAe_count}})</strong></a>
	</div>
</div>


<div class="divider"></div>

@if($type_list === 0)
<h2><strong>Todos los aspirantes</strong></h2>
{{Form::select('state',$states,null, ['class' => 'form-control','id'=>'state'])}}
@elseif($type_list === 1)
<h2><strong>Tus aspirantes por evaluar</strong></h2>
@elseif($type_list === 2)
<h2><strong>Tus aspirantes evaluados</strong></h2>
@endif
