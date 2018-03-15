{!! Form::open(['url' => url("dashboard/programas/$program_id/modulos/$module_id/sesiones/save"), "class" => "form-horizontal"]) !!}
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Información de la sesión</h2>
  </div>
</div>
<!-- name -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Nombre</strong> <br>
      {{Form::text('name',null, ["class" => "form-control"])}} </label>
      @if($errors->has('name'))
      <strong class="danger">{{$errors->first('name')}}</strong>
      @endif
    </p>
  </div>
</div>

<!-- modalidad -->

	<!--- oculta modalidad
  <div class="col-sm-6">
    <p>
      <label><strong>Modalidad</strong></label>
      {{Form::select('modality',[null => "Selecciona una opción", 'En línea' =>'En línea', 'Presencial'=>'Presencial'],null, ['class' => 'form-control'])}}
      @if($errors->has('modality'))
      <strong class="danger">{{$errors->first('modality')}}</strong>
      @endif
    </p>
  </div>-->
  


<!-- Sesión predecesora -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Sesión predecesora</strong></label>
      {{Form::select('parent_id',$list,0, ['class' => 'form-control'])}}
      @if($errors->has('parent_id'))
      <strong class="danger">{{$errors->first('parent_id')}}</strong>
      @endif
    </p>
  </div>
</div>




<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Guardar sesión', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
