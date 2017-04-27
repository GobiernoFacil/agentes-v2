{!! Form::open(['url' => url("dashboard/sesiones/save/$module_id"), "class" => "form-horizontal"]) !!}
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
<!-- Fechas -->
<div class="row">
  <div class="col-sm-6">
    <p>
      <label><strong>Fecha inicio</strong> <br>
      {{Form::text('start',null, ["class" => "form-control", 'id'=>'startD'])}} </label>
      @if($errors->has('start'))
      <strong class="danger">{{$errors->first('start')}}</strong>
      @endif
    </p>
  </div>
  <div class="col-sm-6">
    <p>
      <label><strong>Fecha final</strong> <br>
      {{Form::text('end',null, ["class" => "form-control",'id'=>'startE'])}} </label>
      @if($errors->has('end'))
      <strong class="danger">{{$errors->first('end')}}</strong>
      @endif
    </p>
  </div>
</div>
<!-- horas y # sesión

  <div class="col-sm-6">
    <p>
      <label><strong>Número de sesión</strong> <br>
      {{Form::text('order',null, ["class" => "form-control"])}} </label>
      @if($errors->has('order'))
      <strong class="danger">{{$errors->first('order')}}</strong>
      @endif
    </p>
  </div>
-->
<!-- modalidad -->
<div class="row">
  <div class="col-sm-6">
    <p>
      <label><strong>Modalidad</strong></label>
      {{Form::select('modality',[null => "Selecciona una opción", 'En línea' =>'En línea', 'Presencial'=>'Presencial'],null, ['class' => 'form-control'])}}
      @if($errors->has('modality'))
      <strong class="danger">{{$errors->first('modality')}}</strong>
      @endif
    </p>
  </div>
  <div class="col-sm-6">
    <p>
      <label><strong>Total de horas</strong> <br>
      {{Form::text('hours', null, ["class" => "form-control",'id'=>'startE'])}} </label>
      @if($errors->has('hours'))
      <strong class="danger">{{$errors->first('hours')}}</strong>
      @endif
    </p>
  </div>
</div>

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



<!-- objectivo  -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Objetivo</strong> <br>
      {{Form::textarea('objective',null, ["class" => "form-control"])}} </label>
      @if($errors->has('objective'))
      <strong class="danger">{{$errors->first('objective')}}</strong>
      @endif
    </p>
  </div>
</div>
<!-- comentarios  -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Comentarios</strong> <br>
      {{Form::textarea('comments',null, ["class" => "form-control"])}} </label>
      @if($errors->has('comments'))
      <strong class="danger">{{$errors->first('comments')}}</strong>
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
